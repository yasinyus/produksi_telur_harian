<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-bold mb-4">Grafik Produksi Telur Harian</h2>

        {{-- Load ChartJS --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        {!! $chart->container() !!}

        @push('scripts')
            {!! $chart->script() !!}
        @endpush
    </x-filament::card>
</x-filament::widget>
