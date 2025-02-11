<?php

namespace App\Filament\Actions;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Action;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Database\Eloquent\Model;

class ResetPasswordAction extends Action
{
    use CanCustomizeProcess;
    
    public static function getDefaultName(): ?string
    {
        return 'reset-password';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Send new password');
        
        $this->modalHeading('Reset password');
        $this->modalIcon(FilamentIcon::resolve('actions::delete-action.modal') ?? 'heroicon-o-trash');

        $this->icon('heroicon-m-key');
        $this->requiresConfirmation();

        $this->action(function (): void {
            $result = $this->process(static function (Model $record) {
                $record->resetPassword();
            });

            if (! $result) {
                $this->failure();
                return;
            }

            $this->success();
        });
    }
}