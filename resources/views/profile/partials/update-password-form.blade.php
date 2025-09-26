<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="w-full">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input 
                id="update_password_current_password" 
                name="current_password" 
                type="password" 
                class="mt-1 block w-full" 
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="w-full">
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input 
                id="update_password_password" 
                name="password" 
                type="password" 
                class="mt-1 block w-full" 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="w-full">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="mt-1 block w-full" 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            {{-- Tombol Save dengan warna biru muda --}}
            <x-primary-button class="py-3 px-6 text-lg btn-lightblue">
                <i class="fas fa-save me-2"></i> {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

{{-- Tambahkan CSS custom --}}
<style>
    /* Styling tombol Save Anda */
    .btn-lightblue {
        background-color: #4aa3f0 !important; /* biru muda */
        border-color: #4aa3f0 !important;
        color: #fff !important;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-lightblue:hover {
        background-color: #3498db !important; /* lebih gelap saat hover */
        border-color: #3498db !important;
    }
</style>