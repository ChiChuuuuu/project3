<?php

namespace App\Exports;

use App\Models\StudentModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'Họ và tên',    'Ngày sinh',    'Giới tính',    'Chủ thể',    'Số điện thoại', 'Ngày hết hạn'
        ];
    }
}
