<?php

namespace Nurdaulet\FluxCatalog\Filament\Resources;

use Nurdaulet\FluxCatalog\Filament\Resources\CatalogResource\Pages;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Nurdaulet\FluxCatalog\Filament\Resources\CatalogResource\RelationManagers\RentTypeRelationManager;
use Nurdaulet\FluxCatalog\Helpers\CatalogHelper;
use Nurdaulet\FluxCatalog\Models\Catalog;

class CatalogResource extends Resource
{
    use Translatable;

    protected static ?string $model = Catalog::class;

    protected static ?string $modelLabel = 'категорию';
    protected static ?string $pluralModelLabel = 'Категории';

    protected static ?string $navigationIcon = 'heroicon-o-menu';

    public static function getTranslatableLocales(): array
    {
        return config('flux-catalog.languages');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('parent_id')
                    ->relationship('parent', 'name')
                    ->label(trans('admin.parent_catalog')),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk(config('flux-catalog.options.storage_disk'))
                    ->visibility('public')
                    ->directory('catalogs')
                    ->label(trans('admin.image')),
                Forms\Components\Textarea::make('name')
                    ->required()
                    ->label(trans('admin.name')),

                Forms\Components\Textarea::make('seo_title')
                    ->label(trans('admin.seo_title')),
                RichEditor::make('seo_text')
                    ->disableToolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'codeBlock',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'strike',
                    ])
                    ->hint('Translatable')
                    ->hintIcon('heroicon-s-translate'),
                Forms\Components\Select::make('type')
                    ->options(CatalogHelper::getTypes()),
                Forms\Components\Toggle::make('is_first_place')
                    ->required()
                    ->maxWidth(1000)
                    ->label(trans('admin.is_first_place'))
                    ->inline(),

                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->label(trans('admin.is_active'))
                    ->inline(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->width(150)
                    ->height(150)
                    ->disk(config('flux-catalog.options.storage_disk'))
                    ->label(trans('admin.image')),
                Tables\Columns\TextColumn::make('name')->label(trans('admin.name'))->searchable(),
                Tables\Columns\TextColumn::make('parent.name')
                    ->label(trans('admin.parent_catalog'))->searchable(),
                Tables\Columns\BooleanColumn::make('is_first_place')->label(trans('admin.is_first_place')),
                Tables\Columns\BooleanColumn::make('is_active')->label(trans('admin.status')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()->label(trans('admin.created_at')),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->reorderable('lft')
            ->defaultSort('lft');
    }

    public static function getRelations(): array
    {
        return [
            RentTypeRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCatalogs::route('/'),
            'create' => Pages\CreateCatalog::route('/create'),
            'edit' => Pages\EditCatalog::route('/{record}/edit'),
        ];
    }
}
