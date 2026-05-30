<?php

namespace App\Filament\Resources\AboutStats;

use App\Filament\Resources\AboutStats\Pages\CreateAboutStat;
use App\Filament\Resources\AboutStats\Pages\EditAboutStat;
use App\Filament\Resources\AboutStats\Pages\ListAboutStats;
use App\Filament\Resources\AboutStats\Schemas\AboutStatForm;
use App\Filament\Resources\AboutStats\Tables\AboutStatsTable;
use App\Models\AboutStat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AboutStatResource extends Resource
{
    protected static ?string $model = AboutStat::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'label';

    protected static ?string $navigationLabel = 'Statistik Perusahaan';
    protected static ?string $pluralModelLabel = 'Statistik Perusahaan';
    protected static ?string $modelLabel = 'Statistik Perusahaan';

    public static function form(Schema $schema): Schema
    {
        return AboutStatForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AboutStatsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAboutStats::route('/'),
            'create' => CreateAboutStat::route('/create'),
            'edit' => EditAboutStat::route('/{record}/edit'),
        ];
    }
}
