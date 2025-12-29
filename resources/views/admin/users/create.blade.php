<x-app-layout>
    <x-slot name="header">
        <div class="rounded-xl shadow-lg" style="background: linear-gradient(93deg, #64748b, #06b6d4)">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">{{ __('Tambah User Baru') }}</h2>
                <p class="text-emerald-100 mt-2">Tambahkan user baru di website pesantren!</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 max-w-xl mx-auto p-6 mt-8 mb-8">

                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autocomplete="username" />
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Role (pilih minimal 1)</label>
                            <div class="space-y-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="roles[]" value="admin"
                                        class="rounded border-gray-300 text-cyan-600 shadow-sm focus:ring-cyan-500"
                                        {{ in_array('admin', old('roles', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700">Admin</span>
                                </label>
                                <br>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="roles[]" value="penulis"
                                        class="rounded border-gray-300 text-cyan-600 shadow-sm focus:ring-cyan-500"
                                        {{ in_array('penulis', old('roles', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700">Penulis</span>
                                </label>
                                <br>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="roles[]" value="selasanan_manager"
                                        class="rounded border-gray-300 text-cyan-600 shadow-sm focus:ring-cyan-500"
                                        {{ in_array('selasanan_manager', old('roles', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700">Pengurus Selasanan</span>
                                </label>
                            </div>
                            @error('roles')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.users.index') }}"
                                class="underline text-sm text-gray-600 hover:text-gray-900">Batal</a>

                            <x-primary-button class="ms-4">
                                {{ __('Simpan User') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
