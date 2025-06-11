<x-filament::page>
    <form wire:submit.prevent="callMountedAction('refresh')">
        {{ $this->form }}
        <x-filament::button type="submit" class="mt-4">Tampilkan Data</x-filament::button>
    </form>

    <div class="mt-6">
        {{ $this->table }}
    </div>
</x-filament::page>
