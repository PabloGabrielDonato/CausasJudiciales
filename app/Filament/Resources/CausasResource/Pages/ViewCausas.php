<?php

namespace App\Filament\Resources\CausasResource\Pages;

use App\Filament\Resources\CausasResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCausas extends ViewRecord
{
    protected static string $resource = CausasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
            ->label('Editar'),
        ];
    }
}
