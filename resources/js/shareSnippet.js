/*
  Share Snippet — Quote card generator using <canvas>

  UX:
  - User highlights text in the article body → a small “Bagikan Kutipan” bubble appears near the selection.
  - User can also click the quote button (always available) to open the modal.
  - Modal renders a share-ready image (quote card) using Canvas API, with:
      gradient background, quote text, article title, short URL.
  - Provides Download + Share (Web Share API) + Copy Link.

  Requirements:
  - Add the modal markup + buttons in the Blade (see artikel_detail.blade.php patch).
  - Optional: add /api/shorten + /s/{code} backend for short URLs.
*/

(() => {
  const FORMATS = {
    square: { w: 1080, h: 1080, label: "1:1" },
    portrait: { w: 1080, h: 1350, label: "4:5" },
    landscape: { w: 1200, h: 628, label: "1.91:1" },
  };

  const SELECT_MIN_CHARS = 20;
  const SELECT_MAX_CHARS = 320;
  const DEFAULT_MAX_CHARS = 320;

  const $ = (sel) => document.querySelector(sel);

  const toast = (title, text, icon = "success") => {
    if (window.Swal?.fire) {
      window.Swal.fire({
        title,
        text,
        icon,
        timer: 1800,
        showConfirmButton: false,
      });
      return;
    }
    // very small fallback
    console.log(`[${icon}] ${title}: ${text}`);
  };

  function normalizeText(raw) {
    if (!raw) return "";
    return raw
      .replace(/\s+/g, " ")
      .replace(/\u00A0/g, " ")
      .trim();
  }

  function clampText(raw, maxChars = DEFAULT_MAX_CHARS) {
    const t = normalizeText(raw);
    if (t.length <= maxChars) return t;
    return t.slice(0, maxChars - 1).trimEnd() + "…";
  }

  function safeFileName(text) {
    return normalizeText(text)
      .toLowerCase()
      .replace(/[^a-z0-9]+/g, "-")
      .replace(/(^-|-$)/g, "")
      .slice(0, 60);
  }

  function shortenForDisplay(url) {
    try {
      const u = new URL(url);
      const host = u.host.replace(/^www\./, "");
      const path = u.pathname.replace(/\/$/, "");
      const compact = host + path;
      return compact.length > 34 ? compact.slice(0, 31) + "…" : compact;
    } catch {
      return url.length > 34 ? url.slice(0, 31) + "…" : url;
    }
  }

  function isSelectionInside(container, selection) {
    if (!container || !selection || selection.rangeCount === 0) return false;
    const range = selection.getRangeAt(0);
    const common = range.commonAncestorContainer;
    return container.contains(common.nodeType === 1 ? common : common.parentElement);
  }

  function getSelectionText() {
    const sel = window.getSelection?.();
    if (!sel || sel.rangeCount === 0) return "";
    return sel.toString();
  }

  function getSelectionRect() {
    const sel = window.getSelection?.();
    if (!sel || sel.rangeCount === 0) return null;
    const range = sel.getRangeAt(0);
    const rect = range.getBoundingClientRect();
    if (!rect || (rect.width === 0 && rect.height === 0)) return null;
    return rect;
  }

  function wrapText(ctx, text, maxWidth) {
    // Preserve explicit line breaks, but still wrap long lines.
    const paragraphs = String(text).split(/\n+/g);
    const lines = [];

    for (const para of paragraphs) {
      const words = para.split(/\s+/g).filter(Boolean);
      if (words.length === 0) {
        lines.push("");
        continue;
      }
      let line = words[0];
      for (let i = 1; i < words.length; i++) {
        const test = line + " " + words[i];
        if (ctx.measureText(test).width <= maxWidth) {
          line = test;
        } else {
          lines.push(line);
          line = words[i];
        }
      }
      lines.push(line);
    }
    return lines;
  }

  async function ensureFontsReady() {
    // Best-effort: ensure fonts used by canvas have been loaded.
    try {
      if (!document.fonts?.load) return;
      await Promise.all([
        document.fonts.load('700 64px "Plus Jakarta Sans"'),
        document.fonts.load('600 32px "Plus Jakarta Sans"'),
        document.fonts.load('700 28px "Instrument Sans"'),
      ]);
    } catch {
      // ignore
    }
  }

  function drawRoundedRect(ctx, x, y, w, h, r) {
    const radius = Math.min(r, w / 2, h / 2);
    ctx.beginPath();
    ctx.moveTo(x + radius, y);
    ctx.arcTo(x + w, y, x + w, y + h, radius);
    ctx.arcTo(x + w, y + h, x, y + h, radius);
    ctx.arcTo(x, y + h, x, y, radius);
    ctx.arcTo(x, y, x + w, y, radius);
    ctx.closePath();
  }

  function canvasToBlob(canvas, type = "image/png", quality) {
    return new Promise((resolve) => {
      canvas.toBlob((b) => resolve(b), type, quality);
    });
  }

  async function renderQuoteCard({
    canvas,
    quote,
    title,
    url,
    brand,
    format,
    logoUrl,
  }) {
    const fmt = FORMATS[format] ?? FORMATS.square;
    const dpr = Math.max(1, Math.min(3, window.devicePixelRatio || 1));
    canvas.width = fmt.w * dpr;
    canvas.height = fmt.h * dpr;

    const ctx = canvas.getContext("2d");
    if (!ctx) throw new Error("Canvas 2D context tidak tersedia");

    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    ctx.clearRect(0, 0, fmt.w, fmt.h);

    // Background gradient (brand-ish)
    const grad = ctx.createLinearGradient(0, 0, fmt.w, fmt.h);
    grad.addColorStop(0, "#064e3b"); // emerald-900-ish
    grad.addColorStop(0.55, "#008362");
    grad.addColorStop(1, "#0f172a"); // slate-900-ish
    ctx.fillStyle = grad;
    ctx.fillRect(0, 0, fmt.w, fmt.h);

    // Soft glass overlay shapes
    ctx.save();
    ctx.globalAlpha = 0.18;
    ctx.fillStyle = "#ffffff";
    ctx.beginPath();
    ctx.arc(fmt.w * 0.85, fmt.h * 0.2, fmt.w * 0.25, 0, Math.PI * 2);
    ctx.fill();
    ctx.globalAlpha = 0.12;
    ctx.beginPath();
    ctx.arc(fmt.w * 0.15, fmt.h * 0.85, fmt.w * 0.32, 0, Math.PI * 2);
    ctx.fill();
    ctx.restore();

    const padding = Math.round(fmt.w * 0.08);
    const footerH = Math.round(fmt.h * 0.16);
    const contentW = fmt.w - padding * 2;
    const contentH = fmt.h - padding * 2 - footerH;

    // Quote container
    ctx.save();
    ctx.globalAlpha = 0.18;
    ctx.fillStyle = "#ffffff";
    drawRoundedRect(ctx, padding, padding, contentW, contentH, 28);
    ctx.fill();
    ctx.restore();

    // Quote mark
    ctx.save();
    ctx.globalAlpha = 0.22;
    ctx.fillStyle = "#ffffff";
    ctx.font = `700 ${Math.round(fmt.w * 0.12)}px "Plus Jakarta Sans", system-ui, -apple-system, Segoe UI, sans-serif`;
    ctx.fillText("“", padding + 10, padding + Math.round(fmt.w * 0.12));
    ctx.restore();

    // Quote text (auto fit)
    const quoteBoxX = padding;
    const quoteBoxY = padding;
    const quoteBoxW = contentW;
    const quoteBoxH = contentH;
    const maxTextW = quoteBoxW - Math.round(fmt.w * 0.10);
    const maxTextH = quoteBoxH - Math.round(fmt.h * 0.18);
    const quoteText = clampText(quote, DEFAULT_MAX_CHARS);

    let fontSize = Math.round(fmt.w * 0.056); // ~60px on 1080
    const minSize = Math.round(fmt.w * 0.034);
    let lines = [];
    let lineH = 0;
    while (fontSize >= minSize) {
      ctx.font = `700 ${fontSize}px "Plus Jakarta Sans", system-ui, -apple-system, Segoe UI, sans-serif`;
      lines = wrapText(ctx, quoteText, maxTextW);
      lineH = Math.round(fontSize * 1.22);
      const totalH = lines.length * lineH;
      if (totalH <= maxTextH && lines.length <= 10) break;
      fontSize -= 2;
    }

    ctx.save();
    ctx.fillStyle = "#ffffff";
    ctx.textAlign = "left";
    ctx.textBaseline = "top";

    const textStartX = quoteBoxX + Math.round(fmt.w * 0.065);
    const totalTextH = lines.length * lineH;
    const textStartY = quoteBoxY + Math.round((quoteBoxH - totalTextH) * 0.52);

    ctx.font = `700 ${fontSize}px "Plus Jakarta Sans", system-ui, -apple-system, Segoe UI, sans-serif`;
    for (let i = 0; i < lines.length; i++) {
      ctx.fillText(lines[i], textStartX, textStartY + i * lineH);
    }
    ctx.restore();

    // Footer bar
    ctx.save();
    ctx.globalAlpha = 0.22;
    ctx.fillStyle = "#000000";
    drawRoundedRect(ctx, padding, fmt.h - padding - footerH, contentW, footerH, 22);
    ctx.fill();
    ctx.restore();

    // Footer text
    const footerX = padding;
    const footerY = fmt.h - padding - footerH;
    const innerPad = Math.round(fmt.w * 0.045);
    const titleText = clampText(title || "", 90);
    const urlText = url ? shortenForDisplay(url) : "";
    const brandText = brand ? clampText(brand, 40) : "";

    // Optional logo
    let logoW = 0;
    let logoH = 0;
    if (logoUrl) {
      try {
        const img = await new Promise((resolve, reject) => {
          const i = new Image();
          i.onload = () => resolve(i);
          i.onerror = reject;
          i.src = logoUrl;
        });
        logoH = Math.round(footerH * 0.55);
        logoW = Math.round((img.width / img.height) * logoH);
        ctx.save();
        ctx.globalAlpha = 0.95;
        ctx.drawImage(img, footerX + innerPad, footerY + Math.round((footerH - logoH) / 2), logoW, logoH);
        ctx.restore();
      } catch {
        // ignore logo load issues
      }
    }

    const footerMid = footerY + Math.round(footerH / 2);
    const textLeft = footerX + innerPad + (logoW ? logoW + 16 : 0);

    // URL (right) - Render this first to know its width
    ctx.save();
    ctx.textAlign = "right";
    ctx.font = `600 ${Math.round(fmt.w * 0.024)}px "Plus Jakarta Sans", system-ui, -apple-system, Segoe UI, sans-serif`;
    ctx.globalAlpha = 0.9;
    const urlWidth = ctx.measureText(urlText).width;
    ctx.fillText(urlText, footerX + contentW - innerPad, footerMid + Math.round(fmt.h * 0.020));
    ctx.restore();

    // Article title (left, with wrapping)
    ctx.save();
    ctx.fillStyle = "#ffffff";
    ctx.textBaseline = "middle";
    ctx.textAlign = "left";
    const maxTitleW = (footerX + contentW - innerPad) - textLeft - urlWidth - 30; // 30px gap
    
    let titleFontSize = Math.round(fmt.w * 0.030);
    ctx.font = `700 ${titleFontSize}px "Instrument Sans", system-ui, -apple-system, Segoe UI, sans-serif`;
    
    // Wrap title
    let titleLines = wrapText(ctx, titleText, maxTitleW);
    if (titleLines.length > 2) {
        titleLines = titleLines.slice(0, 2);
        titleLines[1] = titleLines[1].slice(0, -1) + "…";
    }

    ctx.globalAlpha = 0.98;
    const titleLineH = Math.round(titleFontSize * 1.15);
    const titleTotalH = titleLines.length * titleLineH;
    const titleStartY = footerMid - (brandText ? Math.round(fmt.h * 0.015) : 0) - (titleTotalH / 2) + (titleLineH / 2);

    for (let i = 0; i < titleLines.length; i++) {
        ctx.fillText(titleLines[i], textLeft, titleStartY + i * titleLineH);
    }

    // Brand (left, smaller)
    if (brandText) {
      ctx.font = `600 ${Math.round(fmt.w * 0.024)}px "Plus Jakarta Sans", system-ui, -apple-system, Segoe UI, sans-serif`;
      ctx.globalAlpha = 0.82;
      const brandY = footerMid + Math.round(fmt.h * 0.018) + (titleLines.length > 1 ? 5 : 0);
      ctx.fillText(brandText, textLeft, brandY);
    }
    ctx.restore();
  }

  async function init() {
    const articleContent = document.getElementById("articleContent");
    // One or more triggers can open the modal (desktop floating button, mobile inline button, etc.)
    const openBtnEls = new Set(Array.from(document.querySelectorAll("[data-ss-open]")));
    const legacyOpenBtn = document.getElementById("ssOpenBtn");
    if (legacyOpenBtn) openBtnEls.add(legacyOpenBtn);
    const openBtns = Array.from(openBtnEls);
    const modal = document.getElementById("shareSnippetModal");
    const selectionBtn = document.getElementById("ssSelectionBtn");

    if (!modal || !articleContent || openBtns.length === 0 || !selectionBtn) return;

    const quoteInput = document.getElementById("ssQuoteInput");
    const formatSelect = document.getElementById("ssFormat");
    const canvas = document.getElementById("ssCanvas");
    const btnRender = document.getElementById("ssRenderBtn");
    const btnDownload = document.getElementById("ssDownloadBtn");
    const btnShare = document.getElementById("ssShareBtn");
    const btnCopyLink = document.getElementById("ssCopyLinkBtn");
    const urlEl = document.getElementById("ssUrlText");
    const counterEl = document.getElementById("ssCounter");

    if (!quoteInput || !formatSelect || !canvas || !btnRender || !btnDownload || !btnShare || !btnCopyLink) {
      return;
    }

    const articleTitle = articleContent.dataset.ssTitle || document.title || "";
    const canonicalUrl = articleContent.dataset.ssUrl || window.location.href;
    const brand = articleContent.dataset.ssBrand || "";
    const logoUrl = articleContent.dataset.ssLogo || "";

    // Populate format options if empty
    if (formatSelect.options.length === 0) {
      Object.entries(FORMATS).forEach(([key, v]) => {
        const opt = document.createElement("option");
        opt.value = key;
        opt.textContent = `${v.label}`;
        formatSelect.appendChild(opt);
      });
    }

    let cachedShortUrl = null;
    let isShortUrlLoading = false;

    const openModal = async (initialQuote = "") => {
      modal.classList.remove("hidden");
      modal.setAttribute("aria-hidden", "false");

      // Pre-fill
      const q = clampText(initialQuote, DEFAULT_MAX_CHARS);
      quoteInput.value = q;
      if (counterEl) counterEl.textContent = `${q.length}/${DEFAULT_MAX_CHARS}`;

      // Default short URL fallback
      if (urlEl) urlEl.textContent = shortenForDisplay(canonicalUrl);

      await ensureFontsReady();

      // Render quickly with fallback URL first
      await renderQuoteCard({
        canvas,
        quote: q,
        title: articleTitle,
        url: cachedShortUrl || canonicalUrl,
        brand,
        format: formatSelect.value,
        logoUrl,
      });

      // Try fetch short URL (optional backend)
      if (!cachedShortUrl && !isShortUrlLoading) {
        isShortUrlLoading = true;
        try {
          const res = await window.axios?.post?.("/api/shorten", { url: canonicalUrl });
          const shortUrl = res?.data?.short_url;
          if (shortUrl) {
            cachedShortUrl = shortUrl;
            if (urlEl) urlEl.textContent = shortenForDisplay(shortUrl);
            await renderQuoteCard({
              canvas,
              quote: clampText(quoteInput.value),
              title: articleTitle,
              url: cachedShortUrl,
              brand,
              format: formatSelect.value,
              logoUrl,
            });
          }
        } catch {
          // Ignore if endpoint not available
        } finally {
          isShortUrlLoading = false;
        }
      }

      // focus
      quoteInput.focus();
      quoteInput.setSelectionRange(quoteInput.value.length, quoteInput.value.length);
    };

    const closeModal = () => {
      modal.classList.add("hidden");
      modal.setAttribute("aria-hidden", "true");
    };

    // Close modal by clicking overlay or close buttons
    modal.addEventListener("click", (e) => {
      const target = e.target;
      if (target && target.matches("[data-ss-close]")) {
        closeModal();
      }
    });

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && !modal.classList.contains("hidden")) {
        closeModal();
      }
    });

    // Always-available open button(s)
    openBtns.forEach((btn) =>
      btn.addEventListener("click", async () => {
      const q = getSelectionText();
      const prepared = clampText(q || "", DEFAULT_MAX_CHARS);
      if (!prepared) {
        toast("Tip", "Highlight dulu teks yang ingin dibagikan (atau ketik kutipan di modal).", "info");
      }
      await openModal(prepared);
      })
    );

    // Floating selection bubble
    const maybeShowSelectionBtn = () => {
      if (modal && !modal.classList.contains("hidden")) return; // don’t show while modal open
      const sel = window.getSelection?.();
      if (!sel || sel.rangeCount === 0) return hideSelectionBtn();
      if (!isSelectionInside(articleContent, sel)) return hideSelectionBtn();

      const txt = clampText(sel.toString(), SELECT_MAX_CHARS);
      if (txt.length < SELECT_MIN_CHARS) return hideSelectionBtn();

      const rect = getSelectionRect();
      if (!rect) return hideSelectionBtn();

      const pad = 10;
      const btnW = 160;
      const left = Math.min(window.innerWidth - btnW - pad, Math.max(pad, rect.left + rect.width / 2 - btnW / 2));
      const top = Math.min(window.innerHeight - 56, Math.max(pad, rect.bottom + 10));

      selectionBtn.style.left = `${left}px`;
      selectionBtn.style.top = `${top}px`;
      selectionBtn.classList.remove("hidden");
    };

    const hideSelectionBtn = () => {
      selectionBtn.classList.add("hidden");
    };

    articleContent.addEventListener("mouseup", () => {
      // slight delay to allow selection rect to settle
      window.setTimeout(maybeShowSelectionBtn, 10);
    });
    articleContent.addEventListener("touchend", () => {
      window.setTimeout(maybeShowSelectionBtn, 50);
    });

    window.addEventListener("scroll", hideSelectionBtn, { passive: true });
    window.addEventListener("resize", hideSelectionBtn);

    selectionBtn.addEventListener("click", async () => {
      const q = clampText(getSelectionText(), DEFAULT_MAX_CHARS);
      hideSelectionBtn();
      await openModal(q);
    });

    // Live char counter
    quoteInput.addEventListener("input", async () => {
      const v = clampText(quoteInput.value, DEFAULT_MAX_CHARS);
      if (v !== quoteInput.value) quoteInput.value = v;
      if (counterEl) counterEl.textContent = `${quoteInput.value.length}/${DEFAULT_MAX_CHARS}`;
    });

    // Re-render
    const rerender = async () => {
      const q = clampText(quoteInput.value, DEFAULT_MAX_CHARS);
      await ensureFontsReady();
      await renderQuoteCard({
        canvas,
        quote: q,
        title: articleTitle,
        url: cachedShortUrl || canonicalUrl,
        brand,
        format: formatSelect.value,
        logoUrl,
      });
    };
    btnRender.addEventListener("click", rerender);
    formatSelect.addEventListener("change", rerender);

    // Download
    btnDownload.addEventListener("click", async () => {
      try {
        const blob = await canvasToBlob(canvas);
        if (!blob) throw new Error("Gagal membuat gambar");
        const a = document.createElement("a");
        a.href = URL.createObjectURL(blob);
        const base = safeFileName(articleTitle) || "quote";
        a.download = `${base}-${formatSelect.value}.png`;
        document.body.appendChild(a);
        a.click();
        a.remove();
        URL.revokeObjectURL(a.href);
      } catch {
        toast("Gagal", "Tidak bisa download gambar.", "error");
      }
    });

    // Share (Web Share API)
    btnShare.addEventListener("click", async () => {
      try {
        const blob = await canvasToBlob(canvas);
        if (!blob) throw new Error("Gagal membuat gambar");
        const file = new File([blob], `quote.png`, { type: blob.type || "image/png" });

        const shareText = `${articleTitle}\n${cachedShortUrl || canonicalUrl}`;
        const shareData = { files: [file], text: shareText, title: articleTitle };

        if (navigator.share && (!navigator.canShare || navigator.canShare(shareData))) {
          await navigator.share(shareData);
          return;
        }

        // fallback: copy image to clipboard if supported
        if (navigator.clipboard?.write && window.ClipboardItem) {
          await navigator.clipboard.write([new ClipboardItem({ [blob.type]: blob })]);
          toast("Berhasil", "Gambar disalin ke clipboard. Tempel di aplikasi chat.");
          return;
        }

        toast("Info", "Browser tidak mendukung share gambar. Gunakan Download lalu share manual.", "info");
      } catch {
        toast("Gagal", "Tidak bisa membagikan gambar.", "error");
      }
    });

    // Copy link
    btnCopyLink.addEventListener("click", async () => {
      const link = cachedShortUrl || canonicalUrl;
      try {
        if (navigator.clipboard?.writeText) {
          await navigator.clipboard.writeText(link);
          toast("Tersalin!", "Link berhasil disalin.");
          return;
        }
      } catch {
        // ignore
      }
      // fallback
      const ta = document.createElement("textarea");
      ta.value = link;
      ta.style.position = "fixed";
      ta.style.left = "-999999px";
      document.body.appendChild(ta);
      ta.select();
      try {
        document.execCommand("copy");
        toast("Tersalin!", "Link berhasil disalin.");
      } catch {
        toast("Gagal", "Silakan salin link secara manual.", "error");
      }
      ta.remove();
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
