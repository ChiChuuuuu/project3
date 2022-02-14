<?php

namespace App\Imports;

use App\Models\StudentModel;
use App\Models\StudentStatusModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $date = str_replace("/", "-", $row["ngay_sinh"]);

        $data = [
            "name" => $row["ho_va_ten"],
            "dob" => date("Y-m-d", strtotime($date)),
            "department" => $row["chuyen_nganh"],
            "gender" => $row["gioi_tinh"] == "Nam" ? 0 : 1,
            "phone" => $row["so_dien_thoai"],
            "idStatus" => StudentStatusModel::where("status", $row["tinh_trang"])->value("idStatus"),
        ];
        return new StudentModel($data);
    }
}
