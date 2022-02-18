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

        $data = [
            "name" => $row["ho_va_ten"],
            "dob" => date("Y-m-d", strtotime($date)),
            "department" => $row["chuyen_nganh"],
            "gender" => $row["gioi_tinh"] == "Nam" ? 0 : 1,
            "phone" => $row["so_dien_thoai"],
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
