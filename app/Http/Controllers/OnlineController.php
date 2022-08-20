<?php

namespace App\Http\Controllers;

use App\Models\BBookModel;
use App\Models\BookModel;
use App\Models\CategoryModel;
use App\Models\StudentModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OnlineController extends Controller
{
    public function online(Request $request)
    {
        $search = $request->get('search');
        $searchCategory = $request->get('searchCategory');
        $book = BookModel::join('author', 'idAuthor', '=', 'author')
            ->join('category', 'idCategory', '=', 'book.category')
            ->join('shelf', 'shelf.idShelf', '=', 'book.idShelf')
            ->join('shelf_status', 'shelf_status.idStatus', '=', 'shelf.status')
            ->where('bookTitle', 'LIKE', "%$search%")
            ->Where('nameCategory', 'LIKE', "%$searchCategory%")
            ->where('shelf_status.idStatus', 2)
            ->get();
        $category = CategoryModel::all();

        return view('online.online', [
            'book' => $book,
            'search' => $search,
            'category' => $category
        ]);
    }

    public function create($idBook)
    {
        $now = Carbon::now();
        $student = StudentModel::all();
        $book = BookModel::join('author', 'idAuthor', '=', 'book.author')->find($idBook);

        return view('online.create', [
            "student" => $student,
            "book" => $book,
            "now" => $now,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $idBook = $request->get('idBook');
            $idStudent = $request->get('idStudent');
            $status = $request->get('status');
            $dateCurrent = $request->get('dateCurrent');
            $dateReturn = $request->get('dateReturn');
            if($dateCurrent > $dateReturn){
                return redirect(url('/online'))->with('alert', 'Ngày trả không được nhỏ hơn ngày mượn');
            } else {
                $book = new BBookModel();
                $book->idBook = $idBook;
                $book->idStudent = $idStudent;
                $book->fromDate = $dateCurrent;
                $book->toDate = $dateReturn;
                $book->status = $status;
                $book->save();

                return redirect(url('/online'))->with('alert', 'Mượn thành công');
            }

        } catch (\Throwable $th) {
            return redirect(url('/online'))->with('alert', 'Mượn thất bại');
        }
    }
}
