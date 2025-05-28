<?php

namespace App\Filament\Resources\PlatformResource\Pages;

use App\Filament\Resources\PlatformResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlatform extends EditRecord
{
    protected static string $resource = PlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
