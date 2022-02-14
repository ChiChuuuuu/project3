<?php

namespace App\Exports;

use App\Models\BookModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookExport implements WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'Tên sách', 'Thể loại', 'Tác giả',    'Ngày phát hành',    'Ngôn ngữ',    'Số lượng',    'Kệ sách'
        ];
    }
}
