<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Administrator;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class CreateOrder extends CreateRecord
{
    use HasWizard;

    protected static string $resource = OrderResource::class;

    public function form(Form $form): Form
    {
        return parent::form($form)
            ->schema([
                Wizard::make($this->getSteps())
                    ->startOnStep($this->getStartStep())
                    ->cancelAction($this->getCancelFormAction())
                    ->submitAction($this->getSubmitFormAction())
                    ->skippable($this->hasSkippableSteps())
                    ->contained(false),
            ])
            ->columns(null);
    }


    protected function afterCreate(): void
    {
        /** @var Order\ $order */
        $order = $this->record;

        /** @var Administrator $user */
        $user = auth('admin')->user();

        Notification::make()
            ->title('New order')
            ->icon('heroicon-o-shopping-bag')
            ->body("**{$order->customer?->name} ordered {$order->items->count()} products.**")
            ->actions([
                Action::make('View')
                    ->url(\App\Filament\Resources\OrderResource::getUrl('edit', ['record' => $order])),
            ])
            ->sendToDatabase($user);
    }
    protected function getSteps(): array
    {
        return [
            Step::make('Order Details')
                ->schema([
                    Section::make()->schema(OrderResource::getDetailsFormSchema())->columns(),
                ]),

            Step::make('Order Items')
                ->schema([
                    Section::make()->schema([
                        OrderResource::getItemsRepeater(),
                    ]),
                ]),
        ];
    }
}
