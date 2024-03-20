<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;
use App\Models\Causas;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(label:'Total', value: Causas::where('estado_administrativo', 'Archivada')->count())
            ->description('Cantidad de causas archivadas en el sistema')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
        ];        
    }
}
