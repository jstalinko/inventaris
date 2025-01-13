<x-filament-widgets::widget>

    @if ($alert)
        <x-filament::section>
            <div class="flex">
                <div class="flex-shrink-0">
                    <x-heroicon-o-exclamation-circle class="h-5 w-5 fi-color-success" />
                </div>
                <div class="ml-3">
                    <p class="warning">
                        {{$alert}}
                         
                        @if($button)
                            <a href="/absen-keluar"><x-filament::button
                            >Absen Pulang</x-filament::button></a>
                        @endif
                                            </p>
                </div>
            </div>

        </x-filament::section>
    @endif
</x-filament-widgets::widget>
