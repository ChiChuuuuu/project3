<?php

namespace App\Http\Controllers;

use App\Exports\DashboardExport;
use App\Exports\DashboardExport2;
use App\Models\BBookModel;
use App\Models\BookModel;
use App\Models\ChargeModel;
use App\Models\StudentModel;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $now = Carbon::now();

        $bookByMonth = BBookModel::whereMonth('fromDate', '=', $now)
            ->whereYear('fromDate', '=', $now)
            ->get();

        // SELECT * FROM `borrowed_book` WHERE MONTH(fromDate) = MONTH(CURRENT_DATE()) and YEAR(fromDate) = YEAR(CURRENT_DATE())


        $bookByDay = BBookModel::whereDay('fromDate', '=', $now)->whereMonth('fromDate', '=', $now)->get();

        $bookNotReturn = BBookModel::where('actualDate', '=', NULL)->where('status',1)->get();

        $bookByYear = BBookModel::whereYear('fromDate', '=', $now)->get();

        $period = DB::table('borrowed_book')->select(DB::raw('MONTH(fromDate) as Month'), DB::raw('count("idBB") as bbook'))->groupBy(DB::raw('MONTH(fromDate)'))->get();

        $year = DB::table('borrowed_book')->select(DB::raw('YEAR(fromDate) as Year'), DB::raw('count("idBB") as bbook'))->groupBy(DB::raw('YEAR(fromDate)'))->get();

        $historys = BBookModel::join('book', 'book.idBook', 'borrowed_book.idBook')
            ->join('student', 'student.idStudent', 'borrowed_book.idStudent')
            ->join('staff', 'staff.id', 'borrowed_book.id')
            ->join('author', 'author.idAuthor', 'book.author')
            ->where('status', '1')
            ->get();

        $mostBorrowedBook = DB::table('book')->select(DB::raw('book.idBook, book.bookTitle, COUNT(borrowed_book.idBB) AS NoOfTimesBorrowed'))
        ->leftJoin('borrowed_book','book.idBook','borrowed_book.idBook')
        ->groupBy('book.idBook','book.bookTitle')
        ->orderBy('NoOfTimesBorrowed','DESC')
        ->whereMonth('fromDate', $now)
        ->limit(5)->get();

        $mostBorrowedDay = DB::table('book')->select(DB::raw('book.idBook, book.bookTitle, COUNT(borrowed_book.idBB) AS NoOfTimesBorrowed'))
        ->leftJoin('borrowed_book','book.idBook','borrowed_book.idBook')
        ->groupBy('book.idBook','book.bookTitle')
        ->orderBy('NoOfTimesBorrowed','DESC')
        ->whereDate('fromDate', $now)
        ->limit(5)->get();

        $mostBorrowedYear = DB::table('book')->select(DB::raw('book.idBook, book.bookTitle, COUNT(borrowed_book.idBB) AS NoOfTimesBorrowed'))
        ->leftJoin('borrowed_book','book.idBook','borrowed_book.idBook')
        ->groupBy('book.idBook','book.bookTitle')
        ->orderBy('NoOfTimesBorrowed','DESC')
        ->whereYear('fromDate', $now)
        ->limit(5)->get();

        //SELECT book.idBook, book.bookTitle, COUNT(borrowed_book.idBB)
        //AS NoOfTimesBorrowed FROM book LEFT JOIN borrowed_book ON book.idBook = borrowed_book.idBook
        //GROUP BY book.idBook ORDER BY NoOfTimesBorrowed DESC LIMIT 5

        $mostBorrowedCat = DB::table('book')->select(DB::raw('category.idCategory, category.nameCategory, COUNT(category.idCategory) AS NoOfCategory'))
        ->leftJoin('borrowed_book','book.idBook','borrowed_book.idBook')
        ->leftJoin('category','book.category','category.idCategory')
        ->groupBy('category.idCategory','category.nameCategory')
        ->orderBy('NoOfCategory','DESC')
        ->whereYear('fromDate', $now)
        ->limit(5)->get();

        //SELECT category.idCategory, category.nameCategory, COUNT(category.idCategory)
        // AS NoOfCategory FROM book LEFT JOIN borrowed_book ON book.idBook = borrowed_book.idBook LEFT JOIN category ON book.category = category.idCategory
        // GROUP BY category.idCategory ORDER BY NoOfCategory DESC LIMIT 5

        $expDate = Carbon::now()->addDays(45);

        $lostBook = BBookModel::join('book', 'book.idBook', 'borrowed_book.idBook')
        ->join('student', 'student.idStudent', 'borrowed_book.idStudent')
        ->join('staff', 'staff.id', 'borrowed_book.id')
        ->join('author', 'author.idAuthor', 'book.author')
        ->where('status', '3')
        ->paginate(5);

        $extendCard = StudentModel::whereNotNull('lastUpdated')->orderBy('lastUpdated','desc')->limit(5)->get();

        $charge = ChargeModel::join('borrowed_book', 'borrowed_book.idBB','charge.idBB')
        ->join('book', 'book.idBook', 'borrowed_book.idBook')
        ->join('student', 'student.idStudent', 'borrowed_book.idStudent')
        ->get();

        $dataDay = "";
        $dataMonth ="";
        $dataYear = "";
        $dataCategory = "";
        foreach($mostBorrowedYear as $val){
            $dataYear.="['".$val->bookTitle."',     ".$val->NoOfTimesBorrowed."],";
        };
        foreach($mostBorrowedDay as $val){
            $dataDay.="['".$val->bookTitle."',     ".$val->NoOfTimesBorrowed."],";
        };
        foreach($mostBorrowedBook as $val){
            $dataMonth.="['".$val->bookTitle."',     ".$val->NoOfTimesBorrowed."],";
        };
        foreach($mostBorrowedCat as $val){
            $dataCategory.="['".$val->nameCategory."',     ".$val->NoOfCategory."],";
        }

        $chartDataYear = $dataYear;
        $chartDataMonth = $dataMonth;
        $chartDataDay = $dataDay;
        $chartDataCategory = $dataCategory;

        return view('dashboard', [
            'historys' => $historys,
            'now' => $now,
            'bookByMonth' => $bookByMonth,
            'bookByDay' => $bookByDay,
            'bookNotReturn' => $bookNotReturn,
            'bookByYear' => $bookByYear,
            'period' => $period,
            'year' => $year,
            'mostBorrowedBook' => $mostBorrowedBook,
            'mostBorrowedDay' => $mostBorrowedDay,
            'mostBorrowedYear' => $mostBorrowedYear,
            'lostBook' => $lostBook,
            'expDate' => $expDate,
            'extendCard' => $extendCard,
            'charge' => $charge,
            'chartDataYear' => $chartDataYear,
            'chartDataMonth' => $chartDataMonth,
            'chartDataDay' => $chartDataDay,
            'chartDataCategory' => $chartDataCategory,
            'mostBorrowedCat' => $mostBorrowedCat,
        ]);
    }

    public function export(Request $request, $month)
    {
        return Excel::download(new DashboardExport($month), 'Danh sach.xlsx');
    }

    public function exportByYear(Request $request, $year)
    {
        return Excel::download(new DashboardExport2($year), 'Danh sach nam.xlsx');
    }

    public function lostBook(Request $request,$idBB,$status){
        BBookModel::where('idBB', $idBB)->update([
            'status' => $status,
        ]);

        return redirect(url('/dashboard'));
    }

    public function preview(Request $request,$month){

        $now = Carbon::now();

        $search2 = $request->get('search2');

        $book = BBookModel::join('book', 'book.idBook', 'borrowed_book.idBook')
            ->join('student', 'student.idStudent', 'borrowed_book.idStudent')
            ->join('staff', 'staff.id', 'borrowed_book.id')
            ->join('author', 'author.idAuthor', 'book.author')
            ->whereMonth('fromDate', '=', $month)
            ->whereYear('fromDate', '=', $now)
            ->Where('bookTitle', 'LIKE', "%$search2%")
            ->paginate(10);

        return view('preview.preview',[
            'month' => $month,
            'book' => $book,
            'search2' => $search2,
        ]);
    }

    public function previewYear(Request $request,$year){

        $search2 = $request->get('search2');

        $book = BBookModel::join('book','book.idBook','borrowed_book.idBook')
        ->join('student','student.idStudent','borrowed_book.idStudent')
        ->join('staff','staff.id','borrowed_book.id')
        ->join('author','author.idAuthor','book.author')
        ->whereYear('fromDate','=',$year)
        ->where('bookTitle', 'LIKE', "%$search2%")
        ->paginate(10);

        return view('preview.previewYear',[
            'year' => $year,
            'book' => $book,
            'search2' => $search2,
        ]);
    }

}
