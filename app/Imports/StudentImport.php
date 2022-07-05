<?php

namespace App\Imports;

use App\Models\StudentModel;
use App\Models\StudentStatusModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    use Importable, SkipsFailures;

    public function model(array $row)
    {

        $date = str_replace("/", "-", $row["ngay_sinh"]);
        $date2 = str_replace("/", "-", $row["ngay_het_han"]);

        $data = [
            "name" => $row["ho_va_ten"],
            "dob" => date("Y-m-d", strtotime($date)),
            "department" => $row["chu_the"],
            "gender" => $row["gioi_tinh"] == "Nam" ? 0 : 1,
            "phone" => $row["so_dien_thoai"],
            "expiredDate" => date("Y-m-d", strtotime($date2)),
        ];
        return new StudentModel($data);
    }

    public function rules(): array
    {
        return [
            '*.so_dien_thoai' => ['unique:student,phone',],
        ];
    }
}
