<?php

namespace App\Filament\Resources\AutomotiveResource\Pages;

use App\Filament\Imports\AutomotiveImporter;
use Filament\Actions\ImportAction;
use App\Filament\Resources\AutomotiveResource;
use Filament\Actions;
use Illuminate\Support\Facades\Auth;

use Filament\Resources\Pages\ListRecords;

class ListAutomotives extends ListRecords
{
    protected static string $resource = AutomotiveResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [
            Actions\CreateAction::make(),
            Actions\Action::make('lookup')
                ->label('Lookup')
                ->url(route('filament.admin.resources.automotives.index')),
        ];
    
        if (Auth::user()?->role === 'admin') {
            $actions[] = ImportAction::make()
                ->importer(AutomotiveImporter::class);
        }
    
        return $actions;
    }
}
