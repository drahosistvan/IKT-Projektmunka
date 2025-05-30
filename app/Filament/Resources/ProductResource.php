<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $label = 'Termék';
    protected static ?string $pluralLabel = 'Termékek';

    protected static ?string $navigationGroup = 'CMS';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Név')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                        if ($operation !== 'create') {
                                            return;
                                        }

                                        $set('slug', Str::slug($state));
                                    }),

                                Forms\Components\TextInput::make('slug')
                                    ->label('URL')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Product::class, 'slug', ignoreRecord: true),

                                Forms\Components\RichEditor::make('description')
                                    ->label('Leírás')
                                    ->columnSpan('full'),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Images')
                            ->description('Képek feltöltése')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('media')
                                    ->collection('product-images')
                                    ->multiple()
                                    ->maxFiles(5)
                                    ->hiddenLabel(),
                            ])
                            ->collapsible(),

                        Forms\Components\Section::make('Pricing')
                            ->description('Árak és készlet')
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->label('Ár')
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->required(),

                                Forms\Components\TextInput::make('old_price')
                                    ->label('Régi ár')
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->required(),

                                Forms\Components\TextInput::make('cost')
                                    ->label('Bekerülési költség')
                                    ->helperText('A termék beszerzési ára')
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->required(),
                            ])
                            ->columns(2),
                        Forms\Components\Section::make('Inventory')
                            ->schema([
                                Forms\Components\TextInput::make('sku')
                                    ->label('SKU (Cikkszám)')
                                    ->unique(Product::class, 'sku', ignoreRecord: true)
                                    ->maxLength(255)
                                    ->required(),

                                Forms\Components\TextInput::make('barcode')
                                    ->label('Vonalkód')
                                    ->unique(Product::class, 'barcode', ignoreRecord: true)
                                    ->maxLength(255)
                                    ->required(),

                                Forms\Components\TextInput::make('qty')
                                    ->label('Darab')
                                    ->numeric()
                                    ->rules(['integer', 'min:0'])
                                    ->required(),

                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status')
                            ->description('Termék státusza')
                            ->schema([
                                Forms\Components\Toggle::make('is_visible')
                                    ->label('Láthatóság')
                                    ->default(true),

                                Forms\Components\Toggle::make('featured')
                                    ->label('Kiemelt')
                                    ->helperText('Főoldalon megjelenik, ha kiemelt')
                                    ->default(false),

                                Forms\Components\DatePicker::make('published_at')
                                    ->label('Megjelenés dátuma')
                                    ->default(now())
                                    ->required(),
                            ]),

                        Forms\Components\Section::make('Kategória')
                            ->schema([
                                Forms\Components\Select::make('category')
                                    ->label('Kategória')
                                    ->relationship('category', 'name')
                                    ->required(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('product-image')
                    ->label('Kép')
                    ->collection('product-images'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Név')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Láthatóság')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('featured')
                    ->label('Kiemelt')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Ár')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('qty')
                    ->label('Készlet')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Megjelenés dátuma')
                    ->date()
                    ->sortable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
            ])
            ->filters([
                Tables\Filters\QueryBuilder::make()
                    ->constraints([
                        Tables\Filters\QueryBuilder\Constraints\TextConstraint::make('name'),
                        Tables\Filters\QueryBuilder\Constraints\TextConstraint::make('slug'),
                        Tables\Filters\QueryBuilder\Constraints\TextConstraint::make('sku')->label('Cikkszám'),
                        Tables\Filters\QueryBuilder\Constraints\TextConstraint::make('barcode')->label('Vonalkód'),
                        Tables\Filters\QueryBuilder\Constraints\TextConstraint::make('description'),
                        Tables\Filters\QueryBuilder\Constraints\NumberConstraint::make('old_price')->label('Régi ár')->icon('heroicon-m-currency-dollar'),
                        Tables\Filters\QueryBuilder\Constraints\NumberConstraint::make('price')->icon('heroicon-m-currency-dollar'),
                        Tables\Filters\QueryBuilder\Constraints\NumberConstraint::make('cost')->label('Bekerülési költség')->icon('heroicon-m-currency-dollar'),
                        Tables\Filters\QueryBuilder\Constraints\NumberConstraint::make('qty')->label('Készlet mennyisége'),
                        Tables\Filters\QueryBuilder\Constraints\BooleanConstraint::make('is_visible')->label('Láthatóság'),
                        Tables\Filters\QueryBuilder\Constraints\BooleanConstraint::make('featured'),
                        Tables\Filters\QueryBuilder\Constraints\DateConstraint::make('published_at'),
                    ])
                    ->constraintPickerColumns(2),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make(),
                ])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
