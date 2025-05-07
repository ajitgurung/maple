<?php

namespace App\Filament\Resources\AutomotiveResource\Pages;

use App\Filament\Resources\AutomotiveResource;
use App\Models\Automotive;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateAutomotive extends CreateRecord
{
    protected static string $resource = AutomotiveResource::class;

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     // Check for duplicate make, model, and year
    //     $exists = Automotive::where('make', $data['make'])
    //         ->where('model', $data['model'])
    //         ->where('year', $data['year'])
    //         ->where('type', $data['type'])
    //         ->exists();

    //     if ($exists) {
    //         Notification::make()
    //             ->title('Duplicate Entry')
    //             ->body('An automotive entry with this make, model, and year already exists.')
    //             ->danger()
    //             ->send();

    //         // Stop the creation by throwing an exception
    //         throw new \Exception('Duplicate entry.');
    //     }

    //     return $data;
    // }
}
