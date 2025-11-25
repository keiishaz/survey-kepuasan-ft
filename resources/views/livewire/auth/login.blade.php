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
                placeholder="email@ft.unib.ac.id"
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
                placeholder="{{ __('Enter your password') }}"
                class="form-input"
            />
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input
                    wire:model="remember"
                    id="remember"
                    type="checkbox"
                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                />
                <label for="remember" class="ml-2 block text-sm text-gray-700">
                    {{ __('Remember me') }}
                </label>
            </div>
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
</div>
