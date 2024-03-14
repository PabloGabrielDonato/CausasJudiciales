<?php

namespace App\Filament\Resources\Causas2024Resource\Pages;

use App\Filament\Resources\Causas2024Resource;
use Filament\Actions;
use Filament\Support\Colors\Color;

use Filament\Resources\Pages\ListRecords;

class ListCausas2024s extends ListRecords
{
    protected static string $resource = Causas2024Resource::class;

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
