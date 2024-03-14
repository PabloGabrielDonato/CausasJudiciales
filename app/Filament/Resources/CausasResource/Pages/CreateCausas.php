<?php

namespace App\Filament\Resources\CausasResource\Pages;

use App\Filament\Resources\CausasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCausas extends CreateRecord
{
    protected static string $resource = CausasResource::class;


    protected function getCreatedNotificationTitle(): ?String
    {   
        return 'Causa creada correctamente';
    }

    protected function getRedirectUrl(): string
    {
        
        return $this->getResource()::getUrl('index');
    }




}
