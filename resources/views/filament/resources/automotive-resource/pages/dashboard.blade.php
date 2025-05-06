<x-filament::page>
    <div class="space-y-6">
        <form wire:submit.prevent="fetchPriceNote" class="space-y-4">
            <div class="grid grid-cols-4 md:grid-cols-3 gap-4">
                {{ $this->form }}
            </div>

            <x-filament::button type="submit">
                Lookup Price
            </x-filament::button>
        </form>

        @if ($priceNote)
            <div class="p-4 bg-success-100 text-success-800 rounded-lg shadow">
                <strong>Price:</strong> {{ $priceNote }}
            </div>
        @elseif ($make && $model && $year)
            <div class="p-4 bg-danger-100 text-danger-800 rounded-lg shadow">
                No Price Note found for the selected Make, Model, and Year.
            </div>
        @endif
    </div>
</x-filament::page>
