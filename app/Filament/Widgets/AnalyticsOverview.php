<?php

namespace App\Filament\Widgets;

use App\Models\Analytics;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AnalyticsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalVisits = Analytics::where('key', 'page_visit')->count();
        $visitsToday = Analytics::where('key', 'page_visit')->whereDate('created_at', today())->count();

        $totalDownloads = Analytics::where('key', 'cv_download')->count();
        $downloadsToday = Analytics::where('key', 'cv_download')->whereDate('created_at', today())->count();

        return [
            Stat::make('Total Kunjungan Situs', $totalVisits)
                ->description($visitsToday . ' kunjungan hari ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('indigo'),
            
            Stat::make('Total Unduh CV', $totalDownloads)
                ->description($downloadsToday . ' unduhan hari ini')
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color('emerald'),
        ];
    }
}
