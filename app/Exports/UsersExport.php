<?php

namespace App\Exports;

use App\Models\User as ModelsUser;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromQuery, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return ModelsUser::select('name', 'email', 'phone', 'address', 'city')->where('is_admin', '!=', 1);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone number',
            'Address',
            'City'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 16
                ]
            ],
        ];
    }
}
