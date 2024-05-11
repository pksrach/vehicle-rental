<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booked;
use App\Models\BookedDetail;
use App\Models\Customer;
use App\Models\Dashboard;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function getReportData(Request $request): \Illuminate\Http\JsonResponse
    {
        $period = $request->get('period');

        switch ($period) {
            case 'today':
                $startDate = Carbon::today();
                break;
            case 'this month':
                $startDate = Carbon::now()->startOfMonth();
                break;
            case 'this year':
                $startDate = Carbon::now()->startOfYear();
                break;
            default:
                $startDate = Carbon::now()->subDays(7);
                break;
        }

        $revenueData = Booked::join('booked_details', 'bookeds.id', '=', 'booked_details.booked_id')
            ->whereDate('bookeds.created_at', '>=', $startDate)
            ->selectRaw('ROUND(SUM(booked_details.service_price - (booked_details.service_price * (booked_details.discount / 100))), 2) as amount_after_discount')
            ->groupBy('bookeds.created_at')
            ->orderBy('bookeds.created_at', 'desc')
            ->pluck('amount_after_discount')
            ->map(function ($value) {
                return (float)$value;
            })
            ->all();

        $salesData = Booked::whereDate('created_at', '>=', $startDate)
            ->selectRaw('COUNT(*) as sales_count')
            ->groupBy('created_at')
            ->orderBy('created_at', 'desc')
            ->pluck('sales_count')
            ->map(function ($value) {
                return (int)$value;
            })
            ->all();

        $customerData = Customer::whereDate('created_at', '>=', $startDate)
            ->selectRaw('COUNT(*) as customer_count')
            ->groupBy('created_at')
            ->orderBy('created_at', 'desc')
            ->pluck('customer_count')
            ->map(function ($value) {
                return (int)$value;
            })
            ->all();

        // Fetch the dates
        $categories = Booked::whereDate('created_at', '>=', $startDate)
            ->groupBy('created_at')
            ->orderBy('created_at', 'desc')
            ->pluck('created_at')
            ->map(function ($date) {
                return $date->format('Y-m-d\TH:i:s.u\Z'); // Format the date in ISO 8601 format
            })
            ->all();

        return response()->json([
            'sales' => $salesData,
            'revenue' => $revenueData,
            'customers' => $customerData,
            'categories' => $categories, // Include the categories in the response
        ]);
    }


    private function fetchTopVehicleRentData($startDate = null, $endDate = null)
    {
        $query = BookedDetail::select('vehicle_id', DB::raw('count(*) as value'))
            ->with('vehicle') // eager load the vehicle data
            ->groupBy('vehicle_id')
            ->orderByRaw('count(*) DESC')
            ->take(10);

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]); // filter data for the specified date range
        }

        return $query->get()
            ->map(function ($item) {
                return [
                    'name' => $item->vehicle->display(), // get the vehicle name from the vehicle relationship
                    'value' => $item->value
                ];
            })
            ->toArray();
    }

    public function topVehicleRent(): \Illuminate\Http\JsonResponse
    {
        // Fetch the top vehicle rent data from your database
        $topVehicleRentData = $this->fetchTopVehicleRentData();

        // Return the data as a JSON response
        return response()->json($topVehicleRentData);
    }

    public function topVehicleRentExportPdf(): void
    {
        // Get the start and end dates of the current month
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();

        // Fetch the top vehicle rent data from your database
        $topVehicleRentData = $this->fetchTopVehicleRentData($startOfMonth, $endOfMonth);

        // Load the view and pass the data
        $html = view('backend.report.export.top-rent-pdf', ['data' => $topVehicleRentData, 'from_date' => $startOfMonth, 'to_date' => $endOfMonth]);

        // Instantiate Dompdf with our settings
        $dompdf = new Dompdf();

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Set up the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
