<?php
// app/Exports/BookingsExport.php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Booking::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Vehicle Name',
            'User Name',
            'Approver Name',
            'Status',
            'Created At',
            'Updated At',
        ];
    }
}

