<?php

namespace App\Filament\Resources\AutomotiveResource\Pages;

use App\Filament\Resources\AutomotiveResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAutomotive extends EditRecord
{
    protected static string $resource = AutomotiveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
