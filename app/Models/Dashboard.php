<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    public function getTodayBookingsCount()
    {
        return Booked::whereDate('created_at', Carbon::today())->count();
    }

    public function getThisMonthBookingsCount()
    {
        return Booked::whereMonth('created_at', Carbon::now()->month)->count();
    }

    public function getThisYearBookingsCount()
    {
        return Booked::whereYear('created_at', Carbon::now()->year)->count();
    }
}
