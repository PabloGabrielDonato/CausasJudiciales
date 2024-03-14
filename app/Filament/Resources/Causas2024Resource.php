<?php

namespace App\Filament\Resources;

use Filament\Tables\Actions\Action;
use App\Filament\Resources\Causas2024Resource\Pages;
use App\Filament\Resources\Causas2024Resource\RelationManagers;
use Filament\Tables\Columns\TextColumn;
use App\Models\Causas2024;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\Filter;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;


class Causas2024Resource extends Resource
{
    protected static ?string $model = Causas2024::class;
    protected static ?string $label = 'Causas 2024';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Mis causas';


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('numero_expediente')
                ->label('N° de expediente')
                ->required(),
            Forms\Components\TextInput::make('caratula')
                ->label('Carátula')
                ->required(),
                Forms\Components\DatePicker::make('fecha_remision')
                ->label('Fecha de remisión'),
                Forms\Components\Select::make('estado_administrativo')
                ->label('Estado administrativo')
                ->options([
                    'Archivada' => 'Archivada',
                    'En trámite' => 'En trámite',
                    'SPP/CONDENA' => 'SPP/CONDENA',
                    'UIT' => 'UIT',
                    'Apelada' => 'Apelada',
                    'DEB' => 'DEB',
                    'Falta' => 'Falta',
                    'Sorteo' => 'Sorteo',
                ]),
                Forms\Components\DatePicker::make('vencimiento_condena')
                ->label('Vencimiento de la condena'),
                Forms\Components\DatePicker::make('vencimiento_vista')
                ->label('Vencimiento de la vista'),
            Forms\Components\DatePicker::make('fecha_condena')
                ->label('Fecha de condena'),
            Forms\Components\Select::make('tipo')
                ->label('Tipo')
                ->options([
                    'FALTA' => 'FALTA',
                    'CONTRAVENCIÓN' => 'CONTRAVENCIÓN',
                    'PENAL' => 'PENAL',
                ])
                ->required(),
            Forms\Components\TextInput::make('partes')
                ->label('Partes'),
            
                Forms\Components\DatePicker::make('fecha_ingreso')
                ->label('Fecha de ingreso'),

                Forms\Components\TextInput::make('secretario')
                ->label('Secretaria'),

                

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([

            Tables\Columns\TextColumn::make('numero_expediente')
                ->label('N° de expediente')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('caratula')
                ->label('Carátula')
                ->searchable()
                ->sortable(),
                
            Tables\Columns\TextColumn::make('fecha_condena')
                ->label('Fecha de condena/SPP')
                ->dateTime('d-m-Y')
                ->searchable()
                ->sortable(),
                
            Tables\Columns\TextColumn::make('fecha_remision')
                ->label('Fecha de remisión')
                ->dateTime('d-m-Y')
                ->searchable()
                ->sortable(),
            
            Tables\Columns\SelectColumn::make('estado_administrativo')
                ->label('Estado administrativo')
                ->options([
                'Archivada' => 'Archivada',
                'En trámite' => 'En trámite',
                'SPP/CONDENA' => 'SPP/CONDENA',
                'UIT' => 'UIT',
                'Apelada' => 'Apelada',
                'DEB' => 'DEB',
                'Falta' => 'Falta',
                'Sorteo' => 'Sorteo',
                ])
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('vencimiento_condena')
                ->label('Vencimiento de condena')
                ->dateTime('d-m-Y')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('vencimiento_vista')
                ->label('Vencimiento de vista')
                ->dateTime('d-m-Y')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('partes')
                ->label('Partes')
                ->searchable()
                ->sortable(),


            Tables\Columns\TextColumn::make('fecha_ingreso')
                ->label('Fecha de ingreso')
                ->dateTime('d-m-Y')
                ->searchable()
                ->sortable(),
            
            Tables\Columns\TextColumn::make('secretario')
                ->label('Secretaria')
                ->searchable()
                ->sortable(),
            
        ])->defaultSort('vencimiento_vista', 'asc')
        ->filters([
            // Ocultar archivadas
            Filter::make('estado_administrativo')
                ->label('Ocultar archivadas')
                ->checkbox()
                ->default()
                ->default(true)
                ->query(fn (Builder $query) => $query->where('estado_administrativo', '<>', 'Archivada'))
        ])
            ->actions([                
                Tables\Actions\ViewAction::make()
                ->label('Detalle'),
                Tables\Actions\EditAction::make()
                ->label('editar'),
                Tables\Actions\DeleteAction::make()
                ->label('Eliminar causa') // Cambiar la etiqueta de la acción de eliminación
                        ->successNotificationTitle('Causa eliminada correctamente')
                        ->modalDescription('¿Estás segura? Esta acción es irreversible.')
                        ->modalHeading('Eliminar causa')
                        ->modalCancelActionLabel('Cancelar')
                        ->modalSubmitActionLabel('Si, eliminar')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Eliminar causa') // Cambiar la etiqueta de la acción de eliminación
                        ->successNotificationTitle('Causa eliminado correctamente')
                        ->modalDescription('¿Estás segura? Esta acción es irreversible.')
                        ->modalHeading('Eliminar causa')
                        ->modalCancelActionLabel('Cancelar')
                        ->modalSubmitActionLabel('Si, eliminar')
                ])->label('Acciones'),
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
            'index' => Pages\ListCausas2024s::route('/'),
            'create' => Pages\CreateCausas2024::route('/create'),
            'edit' => Pages\EditCausas2024::route('/{record}/edit'),
        ];
    }


    //Contador en barra lateral.
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
