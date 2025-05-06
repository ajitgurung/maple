<?php

namespace App\Filament\Pages;

use App\Filament\Resources\AutomotiveResource;
use Filament\Resources\Pages\Page;
use Filament\Forms;
use App\Models\Automotive;

class Dashboard extends Page
{
    protected static string $resource = AutomotiveResource::class;

    protected static string $view = 'filament.resources.automotive-resource.pages.dashboard';

    public ?string $make = null;
    public ?string $model = null;
    public ?int $year = null;
    public ?string $priceNote = null;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('make')
                ->label('Make')
                ->options(Automotive::query()->distinct()->pluck('make', 'make'))
                ->reactive()
                ->afterStateUpdated(fn () => $this->model = null),

            Forms\Components\Select::make('model')
                ->label('Model')
                ->options(fn () => $this->make ? Automotive::where('make', $this->make)->distinct()->pluck('model', 'model') : [])
                ->reactive()
                ->afterStateUpdated(fn () => $this->year = null),

            Forms\Components\Select::make('year')
                ->label('Year')
                ->options(fn () => $this->model ? Automotive::where('make', $this->make)->where('model', $this->model)->distinct()->pluck('year', 'year') : [])
                ->reactive()
                ->afterStateUpdated(function () {
                    $this->fetchPriceNote();
                }),
        ];
    }

    public function fetchPriceNote()
    {
        $record = Automotive::where('make', $this->make)
            ->where('model', $this->model)
            ->where('year', $this->year)
            ->first();

        $this->priceNote = $record?->price_note ?? 'Not found';
    }
}
