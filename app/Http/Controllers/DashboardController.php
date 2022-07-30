<?php

namespace App\Http\Controllers;

use App\Exports\DashboardExport;
use App\Exports\DashboardExport2;
use App\Models\BBookModel;
use App\Models\BookModel;
use App\Models\ChargeModel;
use App\Models\StudentModel;
use Carbon\Carbon;
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


        $bookByDay = BBookModel::whereDay('fromDate', '=', $now)->get();

        $bookNotReturn = BBookModel::where('actualDate', '=', NULL)->where('status',1)->get();

        $bookByYear = BBookModel::whereYear('fromDate', '=', $now);

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

}
