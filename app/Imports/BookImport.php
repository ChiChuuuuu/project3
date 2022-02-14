<?php

namespace App\Imports;

use App\Models\AuthorModel;
use App\Models\BookModel;
use App\Models\CategoryModel;
use App\Models\ShelfModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BookImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $date = str_replace("/", "-", $row["ngay_phat_hanh"]);

        $data = [
            "bookTitle" => $row["ten_sach"],
            "category" => CategoryModel::where('nameCategory',$row["the_loai"])->value('idCategory'),
            "publicationDate" => date("Y-m-d", strtotime($date)),
            "author" => AuthorModel::where('nameAuthor',$row["tac_gia"])->value('idAuthor'),
            "language" => $row["ngon_ngu"],
            "copiesActual" => $row["so_luong"],
            "copiesCurrent" => $row["so_luong"],
            "idShelf" => ShelfModel::where('shelfNo',$row["ke_sach"])->value('idShelf'),
        ];
        return new BookModel($data);
    }
}
