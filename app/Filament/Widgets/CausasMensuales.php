<?php

namespace App\Filament\Widgets;

use App\Models\Causas;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class CausasMensuales extends ChartWidget
{
    protected static ?string $heading = 'Cantidad de causas registradas por mes.';

    protected function getData(): array
    {
        $data = $this->getCausasMensual();

        return [
            'datasets'  => [
                [
                    'label' =>'Causas registrados.',
                    'data'=> $data['causasMensual']
                ]
            ],
            'labels' =>$data['Meses']
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getCausasMensual(): array
    {
        $now = Carbon::now();
        $causasMensual = [];
        
        $meses = collect(range(start: 1, end: 12))->map(function ($month) use ($now, &$causasMensual) {
            $count = Causas::whereMonth('created_at', Carbon::parse($now->month($month)->format('Y-m')))->count();
            $causasMensual[] = $count;
            return $now->month($month)->format('M');
        })->toArray();

        return [
            'causasMensual' => $causasMensual,
            'Meses' => $meses
        ];
    }
}


