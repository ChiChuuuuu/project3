<?php

namespace App\Http\Controllers;

use App\Models\BBookModel;
use App\Models\BookModel;
use App\Models\ChargeModel;
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

        try {
            foreach ($bookCheck as $bookCheck) {
                if ($bookCheck->idStatus == 1) {
                    return redirect(route('bbook.index'))->with('danger', 'Sach khong duoc muon');
                } else {
                    if ($dateCurrent > $dateReturn) {
                        return redirect(route('bbook.index'))->with('danger', 'Ngày trả không được nhỏ hơn ngày mượn');
                    } else {
                        for ($i = 0; $i < count($book); $i++) {

                            $quantity = BookModel::where('bookTitle', '=', $book[$i])->value('quantity');

                            if ($quantity == 0) {
                                return redirect(route('bbook.index'))->with('danger', 'Không còn đủ số lượng sách cho mượn');
                            } else {
                                $datasave = [
                                    'idBook' => BookModel::where('bookTitle', '=', $book[$i])->value('idBook'),
                                    'idStudent' => $idStudent[$i],
                                    'fromDate' => $dateCurrent[$i],
                                    'toDate' => $dateReturn[$i],
                                    'id' => $idStaff[$i],
                                    'note' => $note[$i]
                                ];
                                DB::table('borrowed_book')->insert($datasave);

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
        } catch (\Throwable $th) {
            return redirect(route('bbook.index'))->with('danger', 'Khong co ma sinh vien nay');
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

    }

    public function createBB()
    {
        $now = Carbon::now();
        $student = StudentModel::all();
        $book = BookModel::join('author', 'idAuthor', '=', 'book.author')
            ->join('category', 'idCategory', '=', 'book.category')
            ->join('shelf', 'shelf.idShelf', '=', 'book.idShelf')
            ->join('shelf_status', 'shelf_status.idStatus', '=', 'shelf.status')
            ->where('shelf_status.idStatus', 2)
            ->get();

        return view('bbook.createBB', [
            "student" => $student,
            "book" => $book,
            "now" => $now,
        ]);
    }

    public function getStudentById($id)
    {
        $listStudent = StudentModel::where('idStudent', $id)->get();

        return $listStudent;
    }

    public function getBookById($id)
    {
        $listBook = BookModel::join('author', 'idAuthor', '=', 'book.author')
            ->join('category', 'idCategory', '=', 'book.category')
            ->join('shelf', 'shelf.idShelf', '=', 'book.idShelf')
            ->join('shelf_status', 'shelf_status.idStatus', '=', 'shelf.status')
            ->where('idBook', $id)
            ->where('shelf_status.idStatus', 2)
            ->get();
        return $listBook;
    }

    public function saveBB(Request $request)
    {

        $idStaff = $request->get('idStaff');
        $idStudent = $request->get('idStudent');
        $book = $request->get('book');
        $dateCurrent = $request->get('dateCurrent');
        $dateReturn = $request->get('dateReturn');
        $note = $request->get('note');



        $bookCheck = BookModel::join('shelf', 'shelf.idShelf', '=', 'book.idShelf')
            ->join('shelf_status', 'shelf_status.idStatus', '=', 'shelf.status')
            ->where('idBook', '=', $book)->get();

        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }

        foreach ($bookCheck as $bookCheck) {
            if ($bookCheck->idStatus == 1) {
                return redirect(route('bbook.createBB'))->with('danger', 'Sach khong duoc muon');
            }
            if ($dateCurrent > $dateReturn) {
                return redirect(route('bbook.createBB'))->with('danger', 'Ngày trả không được nhỏ hơn ngày mượn');
            } else {

                $quantity = BookModel::where('idBook', '=', $book)->value('quantity');

                if ($quantity == 0) {
                    return redirect(route('bbook.createBB'))->with('danger', 'Không còn đủ số lượng sách cho mượn');
                } else {
                    $bookModel = new BBookModel();
                    $bookModel->idBook = $book;
                    $bookModel->idStudent = $idStudent;
                    $bookModel->fromDate = $dateCurrent;
                    $bookModel->toDate = $dateReturn;
                    $bookModel->id = $idStaff;
                    $bookModel->note = $note;
                    $bookModel->save();

                    try {
                        $dataupdate = [
                            'quantity' => $quantity - 1
                        ];

                        DB::table('book')->where('idBook', '=', $book)->update($dataupdate);
                    } catch (\Throwable $th) {
                        return redirect(route('bbook.createBB'))->with('danger', 'Sai roi');
                    }
                }
            }

            return redirect(route('bbook.createBB'))->with('message', 'Mượn thành công');
        }
    }

    public function standby(Request $request)
    {
        $search = $request->get('search');
        $now = Carbon::now();
        $book = BBookModel::join('book', 'book.idBook', 'borrowed_book.idBook')
            ->join('student', 'student.idStudent', 'borrowed_book.idStudent')
            ->join('author', 'author.idAuthor', 'book.author')
            ->where('borrowed_book.status', '=', 2)
            ->where('name', 'LIKE', "%$search%")
            ->paginate(5);

        return view('bbook.standby', [
            'search' => $search,
            'book' => $book,
        ]);
    }

    public function standbyStatus(Request $request, $idBB, $status)
    {
        $mytime = Carbon::now();
        $note = $request->get('note');

        BBookModel::where('idBB', $idBB)->update([
            'note' => $note,
            'status' => $status,
            'id' => 1
        ]);

        BookModel::join('borrowed_book', 'borrowed_book.idBook', '=', 'book.idBook')
            ->where('borrowed_book.idBB', '=', $idBB)->update([
                'quantity' => DB::raw('quantity - 1')
            ]);

        return redirect(route('history.index'))->with('message', 'Mượn thành công');
    }

    public function charge(Request $request)
    {
        $idBB = $request->get('idBB');
        $money = $request->get('chargeMoney');
        $reason = $request->get('reason');
        $status = $request->get('status');
        $now = Carbon::now();
        $idBook = $request->get('idBook');
        $quantity = BookModel::where('idBook', $idBook)->value('quantity');

        $charge = new ChargeModel();
        $charge->idBB = $idBB;
        $charge->money = $money;
        $charge->reason = $reason;
        $charge->save();

        if (isset($status)) {
            BBookModel::where('idBB', $idBB)->update([
                'status' => $status,
                'actualDate' => $now,
            ]);
        } else{
            BBookModel::where('idBB', $idBB)->update([
                'status' => 0,
                'actualDate' => $now,
            ]);
            BookModel::where('idBook', $idBook)->update([
                'quantity' => $quantity + 1
            ]);
        }

        return redirect(url('/dashboard'));
    }

    public function removeBBook($id){
        BBookModel::find($id)->delete();
        return redirect(route('history.index'))->with('message', 'Xoa thành công');
    }
}
