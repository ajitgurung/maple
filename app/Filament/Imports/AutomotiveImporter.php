<?php

namespace App\Filament\Imports;

use App\Models\Automotive;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Log;

class AutomotiveImporter extends Importer
{
    protected static ?string $model = Automotive::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('make')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('model')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('year')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('type')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('price_note')
                ->requiredMapping(),
        ];
    }

    public function resolveRecord(): ?Automotive
    {
        return Automotive::firstOrNew([
            'make' => $this->data['make'],
            'model' => $this->data['model'],
            'year' => $this->data['year'],
            'type' => $this->data['type'],
        ]);

        if (!$automotive->exists) {
            Log::info('Duplicate found and skipped: ', $this->data);
        }
    
        return $automotive;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your automotive import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
