<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Lupa Kata Sandi</h2>
        <p class="text-slate-500 text-sm mt-1">
            Lupa kata sandi Anda? Tidak masalah. Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk menyetel ulang kata sandi Anda.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="email@contoh.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center">
            Kirim Tautan Reset Sandi
        </x-primary-button>

        <p class="text-center text-sm text-slate-600 mt-4">
            Kembali ke
            <a href="{{ route('login') }}" class="text-red-600 hover:text-red-700 font-semibold">Halaman Masuk</a>
        </p>
    </form>
</x-guest-layout>
