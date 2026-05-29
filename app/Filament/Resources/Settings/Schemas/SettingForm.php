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
        // Safely resolve the current setting record
        $record = null;
        if (method_exists($schema, 'getRecord')) {
            $record = $schema->getRecord();
        }

        if (!$record) {
            $routeRecord = request()->route('record');
            if ($routeRecord instanceof \App\Models\Setting) {
                $record = $routeRecord;
            } elseif ($routeRecord) {
                $record = \App\Models\Setting::find($routeRecord);
            }
        }

        $key = $record?->key;
        $isImage = in_array($key, ['hero_image', 'site_logo_image', 'developer_image', 'company_logo']);

        // Dynamically choose between FileUpload and Textarea to prevent Livewire state overriding conflicts
        $valueComponent = $isImage
            ? FileUpload::make('value')
                ->image()
                ->directory('settings')
                ->columnSpanFull()
            : Textarea::make('value')
                ->columnSpanFull();

        return $schema
            ->components([
                TextInput::make('key')
                    ->required()
                    ->disabled(fn ($record) => $record !== null),
                
                $valueComponent,
            ]);
    }
}
