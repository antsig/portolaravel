<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    public function mount(): void
    {
        $user = auth()->user();
        if ($user) {
            redirect(static::getResource()::getUrl('edit', ['record' => $user]));
            return;
        }

        parent::mount();
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
