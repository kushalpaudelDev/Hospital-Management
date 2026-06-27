<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Patients', Patient::count())
                ->description('Registered patients')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            Stat::make('Total Doctors', Doctor::where('is_available', true)->count())
                ->description('Available doctors')
                ->descriptionIcon('heroicon-m-user')
                ->color('info'),

            Stat::make('Today\'s Appointments', Appointment::whereDate('appointment_date', today())->count())
                ->description('Scheduled for today')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('warning'),

            Stat::make('Pending Appointments', Appointment::where('status', 'scheduled')->count())
                ->description('Awaiting confirmation')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger'),
        ];
    }
}
