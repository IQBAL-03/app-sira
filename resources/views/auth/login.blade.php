<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-800">Selamat Datang</h2>
        <p class="text-slate-500 text-sm mt-1">Masuk ke akun SIRA Anda</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                <span class="ms-2 text-sm text-slate-600">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-red-600 hover:text-red-700 font-medium" href="{{ route('password.request') }}">
                    Lupa sandi?
                </a>
            @endif
        </div>

        <x-primary-button class="w-full justify-center mt-2">
            Masuk
        </x-primary-button>

        <p class="text-center text-sm text-slate-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-red-600 hover:text-red-700 font-semibold">Daftar Sekarang</a>
        </p>
    </form>
</x-guest-layout>
