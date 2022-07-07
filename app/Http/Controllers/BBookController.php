<?php

namespace App\Http\Controllers;

use App\Models\BBookModel;
use App\Models\BookModel;
use App\Models\ShelfStatusModel;
use App\Models\StudentModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mytime = Carbon::now();

        $book = BookModel::join('shelf', 'shelf.idShelf', '=', 'book.idShelf')
            ->join('shelf_status', 'shelf_status.idStatus', '=', 'shelf.status')
            ->where('shelf.status', '=', 2)
            ->get();

        $student = StudentModel::where('idStatus', '=', 1)->get();
        return view('bbook.index', [
            'book' => $book,
            'mytime' => $mytime,
            'student' => $student
        ]);
    }

    public function getAllBookById($id)
    {
        $listBook = BookModel::where('idBook', $id)->get();
        return $listBook;
    }

    public function getAllInfoById($id)
    {
        $listStudent = StudentModel::where('idStudent', $id)->get();
        return $listStudent;
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idStaff = $request->get('idStaff');
        $idStudent = $request->get('idStudent');
        $book = $request->get('book');
        $dateCurrent = $request->get('dateCurrent');
        $dateReturn = $request->get('dateReturn');
        $note = $request->get('note');

        $bookCheck = BookModel::join('shelf', 'shelf.idShelf', '=', 'book.idShelf')
            ->join('shelf_status', 'shelf_status.idStatus', '=', 'shelf.status')
            ->where('bookTitle', '=', $book)->get();

        foreach ($bookCheck as $bookCheck) {
            if ($bookCheck->idStatus == 1) {
                return redirect(route('bbook.index'))->with('danger', 'Sach khong duoc muon');
            } else {
                if ($dateCurrent > $dateReturn) {
                    return redirect(route('bbook.index'))->with('danger', 'Ngày trả không được nhỏ hơn ngày mượn');
                } else {
                    for ($i = 0; $i < count($book); $i++) {

                        $datasave = [
                            'idBook' => BookModel::where('bookTitle', '=', $book[$i])->value('idBook'),
                            'idStudent' => $idStudent[$i],
                            'fromDate' => $dateCurrent[$i],
                            'toDate' => $dateReturn[$i],
                            'id' => $idStaff[$i],
                            'note' => $note[$i]
                        ];
                        DB::table('borrowed_book')->insert($datasave);

                        $quantity = BookModel::where('bookTitle', '=', $book[$i])->value('quantity');

                        if ($quantity == 0) {
                            return redirect(route('bbook.index'))->with('danger', 'Không còn đủ số lượng sách cho mượn');
                        } else {
                            try {
                                $iddata = BookModel::where('bookTitle', '=', $book[$i])->value('idBook');
                                $dataupdate = [
                                    'quantity' => $quantity - 1
                                ];

                                DB::table('book')->where('idBook', '=', $iddata)->update($dataupdate);
                            } catch (\Throwable $th) {
                                return redirect(route('bbook.index'))->with('danger', 'Sai roi');
                            }
                        }
                    }

                    return redirect(route('book.index'))->with('message', 'Mượn thành công');
                }
            }
        }

        //SELECT * FROM `book` inner JOIN shelf ON shelf.idShelf = book.idShelf
        //INNER JOIN shelf_status ON shelf_status.idStatus = shelf.status WHERE bookTitle = 'The Shining'

        // if ($dateCurrent > $dateReturn) {
        //     return redirect(route('bbook.index'))->with('danger', 'Ngày trả không được nhỏ hơn ngày mượn');
        // } else {
        //     for ($i = 0; $i < count($book); $i++) {

        //         $datasave = [
        //             'idBook' => BookModel::where('bookTitle', '=', $book[$i])->value('idBook'),
        //             'idStudent' => $idStudent[$i],
        //             'fromDate' => $dateCurrent[$i],
        //             'toDate' => $dateReturn[$i],
        //             'id' => $idStaff[$i],
        //             'note' => $note[$i]
        //         ];
        //         DB::table('borrowed_book')->insert($datasave);
        //     };
        //     return redirect(route('book.index'))->with('message', 'Mượn thành công');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
