<?php

namespace App\Filament\Resources\AboutStats\Pages;

use App\Filament\Resources\AboutStats\AboutStatResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAboutStat extends EditRecord
{
    protected static string $resource = AboutStatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
