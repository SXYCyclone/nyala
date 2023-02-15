<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}').defer }">
        <div
            class="relative z-0 mt-1 cursor-pointer rounded-lg border border-gray-200 dark:border-gray-700 bg-white shadow-sm">
            @foreach ($getOptions() as $value => $label)
                <button type="button"
                        class="{{ $value > 0 ? 'border-t border-gray-200 dark:border-gray-700 focus:border-none rounded-t-none' : '' }} {{ !$loop->last ? 'rounded-b-none' : '' }} focus:border-primary-500 focus:ring-primary-500 dark:focus:border-primary-600 dark:focus:ring-primary-600 relative inline-flex w-full rounded-lg px-4 py-3 focus:z-10 focus:outline-none focus:ring-2"
                        @click="state = '{{ $value }}'">
                    <div
                        :class="state !== '{{ $value }}' ? 'opacity-50' : ''"
                    >

                        <div class="flex items-center">
                            <div
                                :class="{ 'font-semibold': state === '{{ $value }}' }"
                                class="text-sm text-gray-600 dark:text-gray-400">
                                {{ $label }}
                            </div>

                            <template x-if="state === '{{ $value }}'">
                                <svg class="text-primary-500 ml-2 h-5 w-5"
                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </template>
                        </div>

                        @if($hasDescription($value))
                            <div class="mt-2 text-left text-xs text-gray-600 dark:text-gray-400">
                                {{ $getDescription($value) }}
                            </div>
                        @endif
                    </div>
                </button>
            @endforeach
        </div>
    </div>
</x-dynamic-component>
