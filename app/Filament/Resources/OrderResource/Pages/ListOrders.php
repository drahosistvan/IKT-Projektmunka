<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    use ExposesTableToWidgets;
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return OrderResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('Összes'),
            'new' => Tab::make('Új')->query(fn ($query) => $query->where('status', 'new')),
            'processing' => Tab::make('Feldolgozás alatt')->query(fn ($query) => $query->where('status', 'processing')),
            'shipped' => Tab::make('Kiszállítva')->query(fn ($query) => $query->where('status', 'shipped')),
            'delivered' => Tab::make('Kézbesítve')->query(fn ($query) => $query->where('status', 'delivered')),
            'cancelled' => Tab::make('Törölt')->query(fn ($query) => $query->where('status', 'cancelled')),
        ];
    }
}
