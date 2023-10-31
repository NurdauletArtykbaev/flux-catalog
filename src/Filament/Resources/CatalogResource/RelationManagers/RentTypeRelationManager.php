<?php

namespace Nurdaulet\FluxCatalog\Filament\Resources\CatalogResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class RentTypeRelationManager extends RelationManager
{

    protected static string $relationship = 'rentTypes';
    protected static ?string $modelLabel = 'тип период аренды';
    protected static ?string $pluralModelLabel = 'Типы период аренды';

    protected static ?string $recordTitleAttribute = 'rent_type';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('rent_type_id')
                    ->options(config('flux-catalog.models.rent_type')::get()->pluck('name','id'))
                    ->preload()
                    ->label(trans('admin.rent_type')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SelectColumn::make('rent_type_id')
                    ->options(config('flux-catalog.models.rent_type')::get()->pluck('name','id'))
                    ->label(trans('admin.rent_types')),
            ])
            ->filters([
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
