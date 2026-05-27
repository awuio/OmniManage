<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Page Title -->
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-zinc-900">{{ __('Sign in') }}</h1>
        <p class="text-sm text-zinc-500 mt-1">{{ __('Enter your credentials to access your account') }}</p>
    </div>

    <form method="POST" action="{{ route('login') }}" novalidate x-data="{ isSubmitting: false }"
        @submit="isSubmitting = true" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div class="space-y-1.5">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="space-y-1.5" x-data="{ show: false }">
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-zinc-500 hover:text-zinc-900 underline-offset-4 hover:underline transition-colors"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <div class="relative">
                <x-text-input id="password" class="w-full pr-10" x-bind:type="show ? 'text' : 'password'"
                    name="password" required autocomplete="current-password" placeholder="••••••••" />

                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-zinc-400 hover:text-zinc-600 focus:outline-none">
                    <svg x-show="show" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center gap-2">
            <input id="remember_me" type="checkbox"
                class="h-4 w-4 rounded border-zinc-300 text-zinc-900 shadow-sm focus:ring-zinc-400"
                name="remember">
            <label for="remember_me" class="text-sm text-zinc-600">{{ __('Remember me') }}</label>
        </div>

        <!-- Submit -->
        <x-primary-button class="w-full justify-center" x-bind:disabled="isSubmitting"
            x-bind:class="{ 'opacity-75 cursor-wait': isSubmitting }">
            <svg x-show="isSubmitting" style="display: none;" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                    stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            <span x-show="!isSubmitting">{{ __('Sign in') }}</span>
            <span x-show="isSubmitting" style="display: none;">{{ __('Signing in...') }}</span>
        </x-primary-button>
    </form>
</x-guest-layout>
