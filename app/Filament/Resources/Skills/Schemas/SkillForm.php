<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SkillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                \Filament\Forms\Components\FileUpload::make('icon')
                    ->image()
                    ->default(null),
                \Filament\Forms\Components\ColorPicker::make('color')
                    ->default(null),
                TextInput::make('proficiency')
                    ->required()
                    ->numeric()
                    ->default(100),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
