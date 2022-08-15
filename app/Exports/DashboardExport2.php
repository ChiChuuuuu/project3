<?php

namespace App\Exports;

use App\Models\BBookModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DashboardExport2 implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($year)
    {
        //Neu flag = true tai xuong sample.xlsx
        $this->year = $year;
    }

    public function collection()
    {
        return BBookModel::join('book','book.idBook','borrowed_book.idBook')
        ->join('student','student.idStudent','borrowed_book.idStudent')
        ->join('staff','staff.id','borrowed_book.id')
        ->join('author','author.idAuthor','book.author')
        ->whereYear('fromDate','=',$this->year)
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
        ];
        return $data;
    }

    public function headings(): array
    {
        return [
            'Thẻ thư viện', 'Họ tên', 'SDT', 'Tên sách', 'Tác giả', 'Ngày mượn', 'Ngày trả dự kiến', 'Ngày trả'
        ];
    }
}
