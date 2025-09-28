<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EquipoResource\Pages;
use App\Filament\Resources\EquipoResource\RelationManagers;
use App\Models\Equipo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class EquipoResource extends Resource
{
    protected static ?string $model = Equipo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_cliente')
                    ->relationship('cliente', 'nombre')
                    ->required(),

                Forms\Components\Select::make('id_marca')
                    ->relationship('marca', 'marca')
                    ->required(),

                Forms\Components\TextInput::make('tipo_equipo')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('modelo')
                    ->required()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cliente.nombre')->label('Cliente'),
                Tables\Columns\TextColumn::make('marca.marca')->label('Marca'),
                Tables\Columns\TextColumn::make('tipo_equipo'),
                Tables\Columns\TextColumn::make('modelo'),
                Tables\Columns\TextColumn::make('created_at')->date(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListEquipos::route('/'),
            'create' => Pages\CreateEquipo::route('/create'),
            'edit' => Pages\EditEquipo::route('/{record}/edit'),
        ];
    }
}
