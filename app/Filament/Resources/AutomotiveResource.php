<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AutomotiveResource\Pages;
use App\Filament\Resources\AutomotiveResource\RelationManagers;
use App\Imports\DataImport;
use App\Models\Automotive;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Navigation\NavigationItem;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Maatwebsite\Excel\Facades\Excel;

class AutomotiveResource extends Resource
{
    protected static ?string $model = Automotive::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    // protected static string $view = 'filament.resources.automotive-resource.pages.dashboard';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('make')->required()
                ->datalist(
                    Automotive::query()
                        ->select('make')
                        ->distinct()
                        ->orderBy('make')
                        ->pluck('make')
                        ->toArray())->reactive(),
                Forms\Components\TextInput::make('model')->required()
                ->datalist(fn(callable $get) =>
                    Automotive::query()
                        ->where('make', $get('make'))
                        ->select('model')
                        ->distinct()
                        ->orderBy('model')
                        ->pluck('model')
                        ->toArray())->reactive(),
                Forms\Components\TextInput::make('year')->required()->rule('numeric'),
                Forms\Components\TextInput::make('type')->required(),
                Forms\Components\TextArea::make('price_note')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('make')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('model')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('year')->sortable(),
                Tables\Columns\TextColumn::make('type')->sortable(),
                Tables\Columns\TextColumn::make('price_note'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'list' => Pages\ListAutomotives::route('/list'),
            'index' => Pages\Dashboard::route('/'),
            'create' => Pages\CreateAutomotive::route('/create'),
            'edit' => Pages\EditAutomotive::route('/{record}/edit'),
        ];
    }

    public static function getNavigation(): array
    {
        return [
            NavigationItem::make('Dashboard') // Name of the link
                ->url(route('filament.resources.automotives.dashboard')) // URL of the dashboard
                ->icon('heroicon-o-dashboard') // Optional: Add an icon for the link
                ->active(fn () => request()->routeIs('filament.resources.automotives.dashboard')), // This makes sure the link is active when on the dashboard page
        ];
    }
}
