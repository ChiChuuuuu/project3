<?php

namespace App\Http\Controllers;

use App\Models\BBookModel;
use App\Models\BookModel;
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
        $book = BookModel::all();
        $book2 = BookModel::all();
        return view('bbook.index', [
            'book' => $book,
            'book2' => $book2,
            'mytime' => $mytime
        ]);
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

        for ($i = 0; $i < count($book); $i++) {
            $datasave = [
                'idBook' => $book[$i],
                'idStudent' => $idStudent[$i],
                'fromDate' => $dateCurrent[$i],
                'toDate' => $dateReturn[$i],
                'id' => $idStaff[$i],
            ];
            DB::table('borrowed_book')->insert($datasave);
        };
        return redirect(route('book.index'))->with('message', 'Mượn thành công');

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
