<?php

namespace App\Filament\Resources\Causas2024Resource\Pages;

use App\Filament\Resources\Causas2024Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCausas2024 extends EditRecord
{
    protected static string $resource = Causas2024Resource::class;

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
