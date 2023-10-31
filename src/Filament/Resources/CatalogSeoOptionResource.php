<?php

namespace Nurdaulet\FluxCatalog\Filament\Resources;

use Nurdaulet\FluxCatalog\Helpers\CatalogSeoOptionHelper;
use Nurdaulet\FluxCatalog\Models\CatalogSeoOption;
use Nurdaulet\FluxCatalog\Repositories\CatalogRepository;
use Nurdaulet\FluxCatalog\Filament\Resources\CatalogSeoOptionResource\Pages;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class CatalogSeoOptionResource extends Resource
{

   protected static ?string $model = CatalogSeoOption::class;

    protected static ?string $modelLabel = 'SEO Категоии';
    protected static ?string $pluralModelLabel = 'SEO Категоии';
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
                Select::make('sort')
                    ->options(CatalogSeoOptionHelper::getSortOptions())
                    ->searchable()
                    ->label(trans('admin.catalog_seo.sort')),
                Select::make('additional')
                    ->options(CatalogSeoOptionHelper::getAdditionalOptions())
                    ->searchable()
                    ->label(trans('admin.catalog_seo.additional')),
                Forms\Components\TextInput::make('price')
                    ->label(trans('admin.catalog_seo.price')),
                Forms\Components\Textarea::make('text')
                    ->label(trans('admin.catalog_seo.text')),
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
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCatalogSeoOptions::route('/'),
        ];
    }
}
