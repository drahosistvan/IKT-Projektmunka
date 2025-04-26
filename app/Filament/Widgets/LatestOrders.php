<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;
    protected static ?string $heading = 'Legutóbbi megrendelések';

    public function table(Table $table): Table
    {
        return $table
            ->query(\App\Filament\Resources\OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(25)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dátum')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('billing_name')
                    ->label('Vásárló')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Státusz')
                    ->badge(),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Összesen')
                    ->searchable()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('Megtekintés')
                    ->url(fn (Order $record): string => OrderResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
