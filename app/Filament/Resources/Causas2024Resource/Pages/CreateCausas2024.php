<?php

namespace App\Filament\Resources\Causas2024Resource\Pages;

use App\Filament\Resources\Causas2024Resource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCausas2024 extends CreateRecord
{
    protected static string $resource = Causas2024Resource::class;


    protected function getCreatedNotificationTitle(): ?String
    {   
        return 'Causa creada correctamente';
    }

    protected function getRedirectUrl(): string
    {
        
        return $this->getResource()::getUrl('index');
    }
}
