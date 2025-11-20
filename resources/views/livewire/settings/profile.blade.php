<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit.prevent="updateProfileInformation" class="my-6 w-full space-y-6">

            {{-- Profile Picture --}}
            <div class="flex flex-col items-center mb-4">
                <div class="w-24 h-24 rounded-full overflow-hidden border border-gray-300">
                    @if ($photoPreview)
                        <img src="{{ $photoPreview }}" alt="Profile Photo" class="w-full h-full object-cover">
                    @else
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="Profile Photo" class="w-full h-full object-cover">
                    @endif
                </div>
                <label class="mt-2 cursor-pointer text-sm text-blue-600 hover:underline">
                    Change Photo
                    <input type="file" wire:model="photo" class="hidden">
                </label>
                @error('photo') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Name --}}
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            {{-- Position --}}
             <flux:input wire:model="position" :label="__('Position')" type="text" required autofocus autocomplete="position" />
            {{-- Email --}}
            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
