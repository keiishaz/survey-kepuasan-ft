<div class="space-y-6">
    <!-- Session Status -->
    <x-auth-session-status class="text-center text-gray-700" :status="session('status')" />

    <form method="POST" wire:submit="login" class="space-y-5">
        <!-- Email Address -->
        <div>
            <label for="email" class="form-label">Email</label>
            <input
                wire:model="email"
                id="email"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="Masukkan email di sini.."
                class="form-input"
            />
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input
                wire:model="password"
                id="password"
                type="password"
                required
                autocomplete="current-password"
                placeholder="{{ __('Masukkan kata sandi..') }}"
                class="form-input"
            />
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <button
                type="submit"
                class="btn-primary"
            >
                {{ __('Sign In') }}
            </button>
        </div>
    </form>

    @include('partials.confirmation-modal')
</div>
