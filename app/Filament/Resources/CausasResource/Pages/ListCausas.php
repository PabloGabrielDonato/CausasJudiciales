<?php

namespace App\Filament\Resources\CausasResource\Pages;

use App\Filament\Resources\CausasResource;
use Filament\Actions;
use Filament\Support\Colors\Color;
use Filament\Resources\Pages\ListRecords;

class ListCausas extends ListRecords
{
    protected static string $resource = CausasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nueva Causa')
                ->color(Color::Emerald)
                ->successNotificationTitle('Causa creado correctamente')
        ];
    }
}
