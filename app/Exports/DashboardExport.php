<?php

namespace App\Exports;

use App\Models\BBookModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DashboardExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($month)
    {
        //Neu flag = true tai xuong sample.xlsx
        $this->month = $month;
    }

    public function collection()
    {
        $now = Carbon::now();

        return BBookModel::join('book', 'book.idBook', 'borrowed_book.idBook')
            ->join('student', 'student.idStudent', 'borrowed_book.idStudent')
            ->join('staff', 'staff.id', 'borrowed_book.id')
            ->join('author', 'author.idAuthor', 'book.author')
            ->whereMonth('fromDate', '=', $this->month)
            ->whereYear('fromDate', '=', $now)
            ->get();
    }

    public function map($student): array
    {
        $date = str_replace("/", "-", $student->fromDate);
        $date2 = str_replace("/", "-", $student->toDate);
        $date3 = str_replace("/", "-", $student->actualDate);
        $data = [
            $student->idStudent,
            $student->name,
            $student->phone,
            $student->bookTitle,
            $student->nameAuthor,
            date("d-m-Y", strtotime($date)),
            date("d-m-Y", strtotime($date2)),
            date("d-m-Y", strtotime($date3)),
            $student->username,
        ];
        return $data;
    }

    public function headings(): array
    {
        return [
            'Thẻ thư viện', 'Họ tên', 'SDT', 'Tên sách', 'Tác giả', 'Ngày mượn', 'Ngày trả dự kiến', 'Ngày trả', 'Người cho mượn'
        ];
    }
}
