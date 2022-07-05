<?php

namespace App\Http\Controllers;

use App\Models\AuthorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $author = AuthorModel::paginate(5);
        $author = DB::table('author')
        ->where('nameAuthor', 'LIKE', "%$search%")
        ->paginate(5);

        return view('author.index', [
            'author' => $author,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $nameAuthor = $request->get('nameAuthor');
            $author = new AuthorModel();
            $author->nameAuthor = $nameAuthor;
            $author->save();
        } catch (\Throwable $th) {
            return redirect(route('author.index'))->with('danger', 'Đã tồn tại tác giả này');
        }

        return redirect(route('author.index'))->with('message', 'Thêm thành công');
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
        $author = AuthorModel::find($id);
        return view('author.edit', ['author' => $author]);
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
        $nameAuthor = $request->get('nameAuthor');
        AuthorModel::where('idAuthor', $id)->update([
            'nameAuthor' => $nameAuthor,
        ]);
        return redirect(route('author.index'))->with('message', 'Sửa thành công');
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
