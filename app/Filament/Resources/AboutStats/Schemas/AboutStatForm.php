<?php

namespace App\Filament\Resources\AboutStats\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AboutStatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('number')
                    ->label('Angka / Persentase')
                    ->placeholder('e.g. 50+, 99.9%, 10M+')
                    ->required(),
                TextInput::make('label')
                    ->label('Keterangan Statistik')
                    ->placeholder('e.g. Proyek Selesai, Uptime Sistem')
                    ->required(),
                TextInput::make('order')
                    ->label('Urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_published')
                    ->label('Diterbitkan')
                    ->required()
                    ->default(true),
            ]);
    }
}
