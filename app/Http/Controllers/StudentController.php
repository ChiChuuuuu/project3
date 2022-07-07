<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Imports\StudentImport;
use App\Models\StudentModel;
use App\Models\StudentStatusModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

use PhpOffice\PhpWord\TemplateProcessor;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $now = Carbon::now();
        $search = $request->get('search');
        $student = DB::table('student')
            ->join('student_status', 'student_status.idStatus', '=', 'student.idStatus')
            ->where('name', 'LIKE', "%$search%")
            ->paginate(5);
        return view('student.index', [
            'student' => $student,
            'search' => $search,
            'now' => $now,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mytime = Carbon::now()->addMonths(6);

        $status = StudentStatusModel::all();

        return view('student.create', [
            'status' => $status,
            'mytime' => $mytime
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
        try {
            $name = $request->get('name');
            $phone = $request->get('phone');
            $dob = $request->get('dob');
            $gender = $request->get('gender');
            $department = $request->get('department');
            $status = $request->get('status');
            $expiredDate = $request->get('expiredDate');

            $student = new StudentModel();
            $student->name = $name;
            $student->phone = $phone;
            $student->dob = $dob;
            $student->gender = $gender;
            $student->department = $department;
            $student->idStatus = $status;
            $student->expiredDate = $expiredDate;
            $student->save();
        } catch (\Throwable $th) {
            return redirect(route('student.create'))->with('error', 'Số điện thoại bị trùng');
        }

        return redirect(route('student.index'))->with('message', 'Thêm thành công');
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
        $now = Carbon::now();
        $student = StudentModel::find($id);
        $status = StudentStatusModel::all();
        return view('student.edit', ['status' => $status, 'student' => $student, 'now' => $now]);
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

        $now = Carbon::now();

        $name = $request->get('name');
        $phone = $request->get('phone');
        $dob = $request->get('dob');
        $gender = $request->get('gender');
        $department = $request->get('department');
        $status = $request->get('status');
        $expiredDate = $request->get('expiredDate');

        if ($expiredDate < $now) {
            return Redirect::back()->with('danger', 'Ngày hết hạn không được nhỏ hơn ngày hiện tại');
        } else {
            StudentModel::where('idStudent', $id)->update([
                'name' => $name,
                'phone' => $phone,
                'dob' => $dob,
                'gender' => $gender,
                'department' => $department,
                'idStatus' => $status,
                'expiredDate' => $expiredDate,
            ]);

            return redirect(route('student.index'))->with('message', 'Sửa thành công');
        }
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

    public function insertByExcel()
    {
        return view('student.insert-by-excel');
    }

    public function insertByExcelProcess(Request $request)
    {

        $student = Excel::toArray(new StudentImport, $request->file('excel'));

        try {
            $students = $student[0][0];
            $name = $students['ho_va_ten'];
            $dob = $students['ngay_sinh'];
            $department = $students['chu_the'];
            $gender = $students['gioi_tinh'];
            $phone = $students['so_dien_thoai'];
            $expiredDate = $students['ngay_het_han'];
            // if($name == '' && $dob == '' && $department == '' && $gender == '' && $phone == '' ){
            //     throw new Exception();
            // }
        } catch (Exception $e) {
            return redirect(route('student.insert-by-excel'))->with('error', 'File không đúng định dạng hoặc không có dữ liệu');
        }

        $file = $request->file('excel')->store('import');
        $import = new StudentImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect(route('student.insert-by-excel'))->with('message', 'Thêm thành công');
    }

    public function export()
    {
        return Excel::download(new StudentExport, 'student.xlsx');
    }

    public function wordExport($id)
    {
        $user = StudentModel::findOrFail($id);
        $templateProcessor = new TemplateProcessor('word-template/user.docx');
        $templateProcessor->setValue('idStudent', $user->idStudent);
        $templateProcessor->setValue('name', $user->name);
        $templateProcessor->setValue('dob', date('d-m-Y', strtotime($user->dob)));
        $templateProcessor->setValue('department', $user->department);
        $templateProcessor->setValue('expiredDate', date('d-m-Y', strtotime($user->expiredDate)));
        $fileName = $user->name;
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
