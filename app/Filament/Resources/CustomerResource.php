<?php

namespace App\Filament\Resources;

use App\Filament\Actions\ResetPasswordAction;
use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Squire\Models\Country;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $label = 'Vásárló';
    protected static ?string $pluralLabel = 'Vásárlók';

    protected static ?string $navigationGroup = 'Felhasználók';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Section::make('Kapcsolattartási adatok')->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Név')
                                ->maxLength(255)
                                ->required(),

                            Forms\Components\TextInput::make('email')
                                ->label('E-mail cím')
                                ->required()
                                ->email()
                                ->maxLength(255)
                                ->unique(ignoreRecord: true),

                            Forms\Components\TextInput::make('phone')
                                ->label('Telefonszám')
                                ->maxLength(255),
                        ])->columns(3),
                        Forms\Components\Section::make('Számlázási cím')->schema([
                            Forms\Components\TextInput::make('billing_street')
                                ->label('Utca, házszám')
                                ->maxLength(255),

                            Forms\Components\TextInput::make('billing_zip')
                                ->label('Irányítószám')
                                ->maxLength(255),

                            Forms\Components\TextInput::make('billing_city')
                                ->label('Város')
                                ->maxLength(255),

                            Forms\Components\Select::make('billing_country')
                                ->label('Ország')
                                ->options(Country::pluck('name', 'id')->toArray())
                                ->nullable(),
                        ])->columns(2),
                        Forms\Components\Section::make('Szállítási cím')->schema([
                            Forms\Components\TextInput::make('shipping_street')
                                ->label('Utca, házszám')
                                ->maxLength(255),

                            Forms\Components\TextInput::make('shipping_city')
                                ->label('Város')
                                ->maxLength(255),

                            Forms\Components\TextInput::make('shipping_zip')
                                ->label('Irányítószám')
                                ->maxLength(255),

                            Forms\Components\Select::make('shipping_country')
                                ->label('Ország')
                                ->options(Country::pluck('name', 'id')->toArray())
                                ->nullable(),
                        ])->columns(2),


                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => fn (?Customer $record) => $record === null ? 3 : 2]),

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Létrehozva')
                            ->content(fn (Customer $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Utolsó módosítás')
                            ->content(fn (Customer $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Customer $record) => $record === null),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Név')
                    ->searchable(isIndividual: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail cím')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Létrehozva')
                    ->date('Y-m-d H:i:s')
                    ->toggleable()
                    ->sortable(),
            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->slideOver(),
                Tables\Actions\ActionGroup::make([
                    ResetPasswordAction::make(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
