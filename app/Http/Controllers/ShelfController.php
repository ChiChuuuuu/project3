<?php

namespace App\Http\Controllers;

use App\Models\ShelfModel;
use App\Models\ShelfStatusModel;
use Illuminate\Http\Request;

class ShelfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shelf = ShelfModel::join('shelf_status', 'shelf_status.idStatus', '=', 'shelf.status')->get();

        return view('shelf.index', ['shelf' => $shelf]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = ShelfStatusModel::all();
        return view('shelf.create', ['status' => $status]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shelfNo = $request->get('shelfNo');
        $floorNo = $request->get('floorNo');
        $status = $request->get('status');
        $shelf = new ShelfModel();
        $shelf->shelfNo = $shelfNo;
        $shelf->floorNo = $floorNo;
        $shelf->status = $status;
        $shelf->save();

        return redirect(route('shelf.index'))->with('message', 'Thêm thành công');
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
        $shelf = ShelfModel::find($id);
        $status = ShelfStatusModel::all();
        return view('shelf.edit', ['shelf' => $shelf, 'status' => $status]);
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
        $shelfNo = $request->get('shelfNo');
        $floorNo = $request->get('floorNo');
        $status = $request->get('status');

        ShelfModel::where('idShelf',$id)->update([
            'shelfNo' => $shelfNo,
            'floorNo' => $floorNo,
            'status' => $status
        ]);

        return redirect(route('shelf.index'))->with('message', 'Sửa thành công');
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
