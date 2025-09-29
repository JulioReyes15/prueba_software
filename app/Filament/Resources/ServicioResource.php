<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicioResource\Pages;
use App\Filament\Resources\ServicioResource\RelationManagers;
use App\Models\Servicio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class ServicioResource extends Resource
{
    protected static ?string $model = Servicio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
           Forms\Components\Select::make('id_equipo')
                     ->label('Equipo')
                     ->relationship('equipo', 'modelo')
                     ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->modelo} – {$record->marca->marca} – {$record->cliente->nombre} {$record->cliente->apellido}")
                     ->required(),

            Forms\Components\Select::make('id_tecnico')
                     ->label('Técnico')
                     ->relationship('tecnico', 'nombre')
                     ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->nombre} – {$record->especialidad}")
                     ->required(),

                Forms\Components\DatePicker::make('fecha_recepcion')
                    ->required(),

                Forms\Components\Textarea::make('problema_reportado')
                    ->required(),

                Forms\Components\Select::make('estado')
                    ->options([
                        'recibido' => 'Recibido',
                        'reparando' => 'Reparando',
                        'finalizado' => 'Finalizado',
                        'entregado' => 'Entregado',
                    ])
                    ->default('recibido')
                    ->required(),

                Forms\Components\Textarea::make('diagnostico')->nullable(),

                Forms\Components\Textarea::make('solucion')->nullable(),

                Forms\Components\DatePicker::make('fecha_entrega')->nullable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('equipo.modelo')
             ->label('Equipo')
             ->formatStateUsing(fn ($state, $record) => "{$record->equipo->cliente->nombre} {$record->equipo->cliente->apellido} – {$record->equipo->marca->marca} – {$record->equipo->modelo}")
             ->sortable()
             ->searchable(),


                Tables\Columns\TextColumn::make('tecnico.nombre')
            ->label('Técnico')
            ->formatStateUsing(fn ($state, $record) => "{$record->tecnico->nombre} - {$record->tecnico->especialidad}")
            ->sortable()
            ->searchable(),
                Tables\Columns\TextColumn::make('fecha_recepcion')->date(),
                Tables\Columns\TextColumn::make('problema_reportado')->limit(30),
                Tables\Columns\TextColumn::make('estado')->badge(),
                Tables\Columns\TextColumn::make('fecha_entrega')->date()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListServicios::route('/'),
            'create' => Pages\CreateServicio::route('/create'),
            'edit' => Pages\EditServicio::route('/{record}/edit'),
        ];
    }
}
