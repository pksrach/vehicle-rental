<?php

namespace App\Exports;

use App\Models\Booked;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Exception;

class SaleServiceExport implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    public function title(): string
    {
        return 'Sales Service Report';
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        // Get all booked records along with their booked details, customer, staff, and payment method
        $bookedRecords = Booked::with(['booked_details', 'customer', 'staff', 'paymentMethod'])->get();

        // Initialize the total sum
        $totalSum = 0;

        // Transform the data to replace the customer and staff IDs with their names
        $transformedData = $bookedRecords->map(function ($booked) use (&$totalSum) {
            $amountAfterDiscount = $booked->booked_details->map(function ($detail) {
                return $detail->service_price * (1 - $detail->discount / 100);
            })->first();

            // Add the amount after discount to the total sum
            $totalSum += $amountAfterDiscount;

            return [
                'Status' => ucwords($booked->status),
                'Pickup Date' => Carbon::parse($booked->pickup_date)->format('d/m/Y'),
                'Complete Date' => Carbon::parse($booked->complete_date)->format('d/m/Y'),
                'Amount' => '$' . number_format($booked->amount, 2),
                'Customer' => $booked->customer->displayName(),
                'Payment Method' => $booked->paymentMethod->displayName(),
                'Staff' => $booked->staff->displayName(),
                'Details' => implode(', ', [
                    'Vehicle' => $booked->booked_details->first()->vehicle->name,
                    'Service' => '$' . number_format($booked->booked_details->first()->service_price, 2),
                    'Discount' => $booked->booked_details->first()->discount . '%',
                    'Amount After Discount' => '$' . number_format($amountAfterDiscount, 2),
                ]),
            ];
        });

        // Add a new row with the total sum
        $transformedData->push([
            'Status' => '',
            'Pickup Date' => '',
            'Complete Date' => '',
            'Amount' => '',
            'Customer' => '',
            'Payment Method' => '',
            'Staff' => '',
            'Details' => 'Total Amount After Discount: $' . number_format($totalSum, 2),
        ]);

        return $transformedData;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Status',
            'Pickup Date',
            'Complete Date',
            'Amount',
            'Customer',
            'Payment Method',
            'Staff',
            'Details',
        ];
    }

    /**
     * @throws Exception
     */
    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet): void
    {
        $boldArray = [
            'font' => [
                'bold' => true,
            ],
        ];

        // Merge cells from A1 to H1
        $sheet->mergeCells('A1:H1');

        // Set the value of the merged cell to your desired title
        $sheet->setCellValue('A1', 'Sales Service Report');

        // Apply bold style to the first row
        $sheet->getStyle('A1:H1')->applyFromArray($boldArray);

        // Set the headers in the second row
        $sheet->setCellValue('A2', 'Status');
        $sheet->setCellValue('B2', 'Pickup Date');
        $sheet->setCellValue('C2', 'Complete Date');
        $sheet->setCellValue('D2', 'Amount');
        $sheet->setCellValue('E2', 'Customer');
        $sheet->setCellValue('F2', 'Payment Method');
        $sheet->setCellValue('G2', 'Staff');
        $sheet->setCellValue('H2', 'Details');

        // Apply bold style to the second row
        $sheet->getStyle('A2:H2')->applyFromArray($boldArray);

        // Apply all border style to the second row
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A2:H2')->applyFromArray($styleArray);

        // Apply bold style to the last row
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A' . $lastRow . ':' . 'H' . $lastRow)->applyFromArray($boldArray);
    }
}
