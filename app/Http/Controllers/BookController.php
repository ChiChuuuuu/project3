<?php

namespace App\Http\Controllers;

use App\Exports\BookExport;
use App\Imports\BookImport;
use App\Models\AuthorModel;
use App\Models\BookModel;
use App\Models\CategoryModel;
use App\Models\ShelfModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $book = DB::table('Book')
            ->join('author', 'idAuthor', '=', 'book.author')
            ->join('category', 'idCategory', '=', 'book.category')
            ->join('shelf', 'shelf.idShelf', '=', 'book.idShelf')
            ->where('bookTitle','LIKE',"%$search%")
            ->orWhere('nameAuthor','LIKE',"%$search%")
            ->paginate(5);
        return view('book.index', [
            'book' => $book,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $author = AuthorModel::all();
        $category = CategoryModel::all();
        $shelf = ShelfModel::all();
        return view('book.create', [
            'author' => $author,
            'category' => $category,
            'shelf' => $shelf,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bookTitle = $request->get('bookTitle');
        $category = $request->get('category');
        $language = $request->get('language');
        $quantity = $request->get('quantity');
        $publicationDate = $request->get('publicationDate');
        $shelf = $request->get('shelf');
        $nameAuthor = $request->get('author');
        $author = new BookModel();
        $author->bookTitle = $bookTitle;
        $author->author = $nameAuthor;
        $author->category = $category;
        $author->language = $language;
        $author->copiesActual = $quantity;
        $author->CopiesCurrent = $quantity;
        $author->publicationDate = $publicationDate;
        $author->idShelf = $shelf;
        $author->save();

        return redirect(route('book.index'))->with('message', 'Thêm thành công');
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
        $book = BookModel::find($id);
        $author = AuthorModel::all();
        $category = CategoryModel::all();
        return view('book.edit', ['book' => $book, 'author' => $author, 'category' => $category]);
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
        $bookTitle = $request->get('bookTitle');
        $category = $request->get('category');
        $language = $request->get('language');
        $quantity = $request->get('quantity');
        $publicationDate = $request->get('publicationDate');
        $nameAuthor = $request->get('author');
        BookModel::where('idBook', $id)->update([
            'bookTitle' => $bookTitle,
            'category' => $category,
            'language' => $language,
            'copiesActual' => $quantity,
            'publicationDate' => $publicationDate,
            'author' => $nameAuthor,
        ]);
        return redirect(route('book.index'))->with('message', 'Sửa thành công');
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

    public function insertByExcel(){
        return view('book.insert-by-excel');
    }

    public function insertByExcelProcess(Request $request){

        $book = Excel::toArray(new BookImport, $request->file('excel'));

        try {
            $students = $book[0][0];
            $name = $students['ten_sach'];
            $dob = $students['the_loai'];
            $department = $students['tac_gia'];
            $gender = $students['ngon_ngu'];
            $phone = $students['ke_sach'];
            // if($name == '' && $dob == '' && $department == '' && $gender == '' && $phone == '' ){
            //     throw new Exception();
            // }
        } catch (Exception $e) {
            return redirect(route('student.insert-by-excel'))->with('error', 'File không đúng định dạng hoặc không có dữ liệu');
        }

        $file = $request->file('excel')->store('import');
        $import = new BookImport;
        $import->import($file);

        return redirect(route('book.insert-by-excel'))->with('message', 'Thêm thành công');

    }

    public function export()
    {
        return Excel::download(new BookExport, 'book.xlsx');
    }
}
