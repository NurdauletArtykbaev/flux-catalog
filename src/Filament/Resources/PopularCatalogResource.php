<?php

namespace Nurdaulet\FluxCatalog\Filament\Resources;

use Nurdaulet\FluxCatalog\Repositories\CatalogRepository;
use Nurdaulet\FluxCatalog\Filament\Resources\PopularCatalogResource\Pages;
use Nurdaulet\FluxCatalog\Models\PopularCatalog;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PopularCatalogResource extends Resource
{
    protected static ?string $model = PopularCatalog::class;

    protected static ?string $modelLabel = 'Популярные категории';
    protected static ?string $pluralModelLabel = 'Популярные категории';
    protected static ?string $navigationIcon = 'heroicon-o-menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('catalog_id')
                    ->relationship('catalog', 'name')
                    ->searchable()
                    ->optionsLimit(1000)
                    ->options((new CatalogRepository())->getCatalogForAdminPanel())
                    ->preload()
                    ->label(trans('admin.catalogs')),
                Forms\Components\Toggle::make('is_active')
                    ->label(trans('admin.is_active'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('catalog.name')
                    ->label(trans('admin.catalog')),
                Tables\Columns\BooleanColumn::make('is_active')->label(trans('admin.is_active')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->reorderable('lft')
            ->defaultSort('lft');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePopularCatalogs::route('/'),
        ];
    }
}
