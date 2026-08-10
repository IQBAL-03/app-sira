<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Daftar Akun Warga</h2>
        <p class="text-slate-500 text-sm mt-1">Isi data lengkap Anda. Akun akan aktif setelah diverifikasi admin RT.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Lengkap" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="nik" :value="__('NIK (16 digit)')" />
                <x-text-input id="nik" class="block mt-1 w-full" type="text" name="nik" :value="old('nik')" required maxlength="16" placeholder="16 digit NIK" />
                <x-input-error :messages="$errors->get('nik')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="email@contoh.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Nomor Telepon')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required placeholder="08xxxxxxxxxx" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="address" :value="__('Alamat Lengkap')" />
            <textarea id="address" name="address" rows="2" required
                class="block mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 text-sm resize-none"
                placeholder="Jl. Contoh No. 1, RT 01/RW 02...">{{ old('address') }}</textarea>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" :value="__('Kata Sandi')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Sandi')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="bg-amber-50 border border-amber-200 rounded-lg p-3 flex gap-2">
            <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-amber-700 text-xs">Akun Anda akan menunggu verifikasi dari Pengurus RT sebelum dapat digunakan.</p>
        </div>

        <x-primary-button class="w-full justify-center">
            Daftar Sekarang
        </x-primary-button>

        <p class="text-center text-sm text-slate-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-red-600 hover:text-red-700 font-semibold">Masuk</a>
        </p>
    </form>
</x-guest-layout>
