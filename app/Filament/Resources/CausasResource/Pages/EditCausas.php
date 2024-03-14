<?php

namespace App\Filament\Resources\CausasResource\Pages;

use App\Filament\Resources\CausasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCausas extends EditRecord
{
    protected static string $resource = CausasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
            ->label('Ver detalle'),
            Actions\DeleteAction::make()
            ->label('Eliminar'),
        ];


        
    }


    protected function getRedirectUrl(): string
    {
        
        return $this->getResource()::getUrl('index');
    }
}
