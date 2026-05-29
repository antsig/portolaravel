<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->required()
                    ->disabled(fn ($record) => $record !== null),
                
                // Dynamic FileUpload for image settings
                FileUpload::make('value')
                    ->image()
                    ->directory('settings')
                    ->visible(fn ($get) => in_array($get('key'), ['hero_image', 'site_logo_image']))
                    ->columnSpanFull(),

                // Standard Textarea for general text settings
                Textarea::make('value')
                    ->default(null)
                    ->hidden(fn ($get) => in_array($get('key'), ['hero_image', 'site_logo_image']))
                    ->columnSpanFull(),
            ]);
    }
}
