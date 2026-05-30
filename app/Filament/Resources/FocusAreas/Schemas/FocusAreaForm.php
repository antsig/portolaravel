<?php

namespace App\Filament\Resources\FocusAreas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FocusAreaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Fokus')
                    ->required(),
                Select::make('icon')
                    ->label('Ikon Preset')
                    ->options([
                        'code' => 'Code / Developer',
                        'lightbulb' => 'Lightbulb / Innovation',
                        'rocket' => 'Rocket / Launch',
                        'cpu' => 'CPU / System / Technology',
                        'globe' => 'Globe / Website',
                        'users' => 'Users / Team / Clients',
                    ])
                    ->default('code')
                    ->required(),
                Textarea::make('description')
                    ->label('Deskripsi Singkat')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
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
