<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function getLabel(string $key): string
    {
        $labels = [
            'site_name' => 'Nama Situs / Brand',
            'site_description' => 'Deskripsi Metadata Situs',
            'contact_email' => 'Email Kontak Pengembang',
            'hero_subtitle' => 'Sub-judul Hero (Badge Atas)',
            'hero_title' => 'Judul Hero (Animasi Mengetik)',
            'hero_description' => 'Deskripsi Singkat Hero',
            'hero_image' => 'Gambar Visual Hero (Bulat)',
            'site_logo_image' => 'Logo Utama Situs (Gambar Navbar)',
            'site_logo_text' => 'Logo Utama Situs (Teks Fallback)',
            'developer_image' => 'Foto Profil Pengembang / Owner (Avatar)',
            'company_logo' => 'Logo Perusahaan (About Section)',
            'company_name' => 'Nama Perusahaan',
            'company_tagline' => 'Tagline Perusahaan (About)',
            'company_description' => 'Deskripsi Perusahaan (About)',
            'company_address' => 'Alamat Lengkap Perusahaan',
            'developer_name' => 'Nama Lengkap Pengembang / Owner',
            'developer_bio' => 'Biografi Singkat Pengembang',
            'github_url' => 'Tautan GitHub',
            'linkedin_url' => 'Tautan LinkedIn',
            'twitter_url' => 'Tautan Twitter / X',
            'instagram_url' => 'Tautan Instagram',
            'footer_text' => 'Teks Footer Hak Cipta',
            'developer_cv' => 'Curriculum Vitae (CV) PDF Pengembang',
        ];

        return $labels[$key] ?? ucwords(str_replace('_', ' ', $key));
    }

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

        // Dynamically choose between FileUpload for images/PDFs, and Textarea
        if ($isImage) {
            $valueComponent = FileUpload::make('value')
                ->label('Unggah Gambar')
                ->image()
                ->directory('settings')
                ->columnSpanFull();
        } elseif ($key === 'developer_cv') {
            $valueComponent = FileUpload::make('value')
                ->label('Unggah Curriculum Vitae (CV) PDF')
                ->acceptedFileTypes(['application/pdf'])
                ->directory('cvs')
                ->columnSpanFull();
        } else {
            $valueComponent = Textarea::make('value')
                ->label('Nilai Pengaturan')
                ->columnSpanFull();
        }

        return $schema
            ->components([
                // Beautiful human-readable UI label for existing settings
                Placeholder::make('key_display')
                    ->label('Nama Pengaturan')
                    ->content(fn () => $key ? static::getLabel($key) : '-')
                    ->visible(fn () => $record !== null),

                // Hidden key field when editing, visible input only when creating new
                TextInput::make('key')
                    ->label('Key Pengaturan')
                    ->required()
                    ->hidden(fn () => $record !== null),
                
                $valueComponent,
            ]);
    }
}
