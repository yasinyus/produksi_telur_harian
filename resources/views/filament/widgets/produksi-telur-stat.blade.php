<x-filament::widget>
    <x-filament::card>
        <form wire:submit.prevent="$refresh">
            {{ $this->form }}
            <x-filament::button type="submit">Filter</x-filament::button>
        </form>

        <hr class="my-4" />

        @php
            $summary = $this->getSummary();
        @endphp

        <div class="grid grid-cols-2 gap-4">
            <div>Total Telur (Butir): {{ number_format($summary['butir']) }}</div>
            <div>Total Telur (Kg): {{ number_format($summary['kg'], 2) }} kg</div>
            <div>Telur Retak: {{ number_format($summary['retak']) }}</div>
            <div>Telur Kotor: {{ number_format($summary['kotor']) }}</div>
        </div>
    </x-filament::card>
</x-filament::widget>
