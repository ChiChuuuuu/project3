<?php

namespace App\Http\Controllers;

use App\Models\BBookModel;
use App\Models\BookModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $search2 = $request->get('search2');

        //Mượn
        $historys = BBookModel::join('book', 'book.idBook', 'borrowed_book.idBook')
            ->join('student', 'student.idStudent', 'borrowed_book.idStudent')
            ->join('staff', 'staff.id', 'borrowed_book.id')
            ->join('author', 'author.idAuthor', 'book.author')
            ->where('name', 'LIKE', "%$search%")
            ->where('status', '1')
            ->paginate(5);

        // //Trả
        $history2s = BBookModel::join('book', 'book.idBook', 'borrowed_book.idBook')
            ->join('student', 'student.idStudent', 'borrowed_book.idStudent')
            ->join('staff', 'staff.id', 'borrowed_book.id')
            ->join('author', 'author.idAuthor', 'book.author')
            ->where('name', 'LIKE', "%$search2%")
            ->where('status', '0')
            ->orderBy('actualDate', 'DESC')
            ->paginate(5, ['*'], 'other_page');


        return view('history.index', [
            'historys' => $historys,
            'history2s' => $history2s,
            'search' => $search,
            'search2' => $search2,
        ]);
    }

    public function getStatus(Request $request, $idBB, $status)
    {
        $mytime = Carbon::now();

        BBookModel::where('idBB', $idBB)->update([
            'status' => $status,
            'actualDate' => $mytime,
        ]);

        BookModel::join('borrowed_book', 'borrowed_book.idBook', '=', 'book.idBook')
            ->where('borrowed_book.idBB', '=', $idBB)->update([
                'quantity' => DB::raw('quantity + 1')
            ]);

        return redirect(route('history.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
