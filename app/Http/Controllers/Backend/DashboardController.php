<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booked;
use App\Models\Customer;
use App\Models\Dashboard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('backend.dashboard.index');
    }

    public function getSumOfAmountAfterDiscount($period)
    {
        switch ($period) {
            case 'today':
                return Booked::join('booked_details', 'bookeds.id', '=', 'booked_details.booked_id')
                    ->whereDate('bookeds.created_at', Carbon::today())
                    ->selectRaw('ROUND(SUM(booked_details.service_price - (booked_details.service_price * (booked_details.discount / 100))), 2) as amount_after_discount')
                    ->value('amount_after_discount');
            case 'this month':
                return Booked::join('booked_details', 'bookeds.id', '=', 'booked_details.booked_id')
                    ->whereMonth('bookeds.created_at', Carbon::now()->month)
                    ->selectRaw('ROUND(SUM(booked_details.service_price - (booked_details.service_price * (booked_details.discount / 100))), 2) as amount_after_discount')
                    ->value('amount_after_discount');
            case 'this year':
                return Booked::join('booked_details', 'bookeds.id', '=', 'booked_details.booked_id')
                    ->whereYear('bookeds.created_at', Carbon::now()->year)
                    ->selectRaw('ROUND(SUM(booked_details.service_price - (booked_details.service_price * (booked_details.discount / 100))), 2) as amount_after_discount')
                    ->value('amount_after_discount');
            default:
                return 0;
        }
    }

    public function getBookingCounts(Request $request): \Illuminate\Http\JsonResponse
    {
        $dashboard = new Dashboard();
        $period = $request->get('period');
        $count = 0;
        $previousCount = 0; // You need to determine how to get the previous count

        switch ($period) {
            case 'today':
                $count = $dashboard->getTodayBookingsCount();
                break;
            case 'this month':
                $count = $dashboard->getThisMonthBookingsCount();
                break;
            case 'this year':
                $count = $dashboard->getThisYearBookingsCount();
                break;
        }

        $percentage = 0;
        if ($previousCount > 0) {
            $percentage = (($count - $previousCount) / $previousCount) * 100;
        }

        $sum = $this->getSumOfAmountAfterDiscount($period);

        return response()->json([
            'count' => $count,
            'percentage' => $percentage,
            'sum' => $sum,
        ]);
    }

    public function getCustomerCounts(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'count' => Customer::count(),
        ]);
    }

    public function getReportData(): \Illuminate\Http\JsonResponse
    {
        // Fetch the data from your database
        // This is just an example, replace it with your actual logic
        $salesData = [31, 40, 28, 51, 42, 82, 56];
        $revenueData = [11, 32, 45, 32, 34, 52, 41];
        $customerData = [15, 11, 32, 18, 9, 24, 11];

        return response()->json([
            'sales' => $salesData,
            'revenue' => $revenueData,
            'customers' => $customerData,
        ]);
    }
}
