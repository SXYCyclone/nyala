<x-filament-companies::grid-section class="mt-8">
    <x-slot name="title">
        {{ __('nyala.profile.export_personal_data.grid_section_title') }}
    </x-slot>

    <x-slot name="description">
        {{ __('nyala.profile.export_personal_data.grid_section_description') }}
    </x-slot>


    <x-filament::card class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('nyala.profile.export_personal_data.subheading') }}
        </div>

        <x-slot name="footer">
            <div class="text-left">
                <x-filament::button color="primary" wire:click="confirmPersonalDataExport" wire:loading.attr="disabled">

                    {{ __('nyala.profile.export_personal_data.button') }}
                </x-filament::button>
            </div>
        </x-slot>

        <!-- Confirmation Modal -->
        <x-filament-companies::dialog-modal wire:model="confirmingPersonalDataExport" maxWidth="md"
                                            class="flex items-center justify-center space-x-2 rtl:space-x-reverse">

            <x-slot name="title">
                {{ __('nyala.profile.export_personal_data.modal_title') }}
            </x-slot>

            <x-slot name="content">
                {{ __('nyala.profile.export_personal_data.modal_description') }}
                <div class="mt-4" x-data="{}"
                     x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">

                    <x-filament-companies::input type="password" class="mt-1 block w-3/4"
                                                 placeholder="{{ __('filament-companies::default.fields.password') }}"
                                                 x-ref="password"
                                                 wire:model.defer="password" wire:keydown.enter="exportPersonalData"/>

                    <x-filament-companies::input-error for="password" class="mt-2"/>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-filament::button color="gray" class="mr-3" wire:click="$toggle('confirmingPersonalDataExport')"
                                    wire:loading.attr="disabled">
                    {{ __('filament-companies::default.buttons.cancel') }}

                </x-filament::button>

                <x-filament::button color="primary" class="ml-3" wire:click="exportPersonalData" wire:loading.attr="disabled">
                    {{ __('nyala.profile.export_personal_data.button') }}

                </x-filament::button>
            </x-slot>
        </x-filament-companies::dialog-modal>
    </x-filament::card>
</x-filament-companies::grid-section>
