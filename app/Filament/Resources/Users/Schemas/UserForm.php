<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email Login')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                
                // Password Saat Ini (Wajib diisi jika ingin mengganti password)
                TextInput::make('current_password')
                    ->label('Password Saat Ini (Wajib jika mengganti password)')
                    ->password()
                    ->rule('current_password')
                    ->required(fn ($get) => filled($get('password')))
                    ->visible(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord)
                    ->dehydrated(false)
                    ->helperText('Masukkan kata sandi aktif saat ini untuk memverifikasi kepemilikan akun Anda.'),
                
                // Password Baru
                TextInput::make('password')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                    ->rule(Password::min(8)->letters()->numbers()->symbols())
                    ->maxLength(255)
                    ->label(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord ? 'Password Baru' : 'Password Baru (Kosongkan jika tidak ingin diubah)')
                    ->helperText('Minimal 8 karakter, wajib mengandung kombinasi huruf, angka, dan simbol.'),
            ]);
    }
}
