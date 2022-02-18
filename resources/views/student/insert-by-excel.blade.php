@extends('layout.layout')
@section('main')

    <div class="main-panel">
        <div class="main-content">
            <div class="col-md-6">
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <div class="header">
                                <legend>Thêm sinh vien bang excel</legend>
                            </div>
                            <div class="content">
                                <form action="{{ route('student.insert-by-excel-process') }}" method="POST"
                                    class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="excel"
                                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    <br><br><br>
                                    <button>Thêm</button>
                                </form>


                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif<br><br>

                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif

                                <br><br><br><br>
                                @if (session()->has('failures'))
                                    <table class="table table-danger">
                                        <tr>
                                            <th>Lỗi</th>
                                            <th></th>
                                            <th>Dòng</th>
                                        </tr>
                                        @foreach (session()->get('failures') as $validation)
                                            <tr>
                                                <td>
                                                    @foreach ($validation->errors() as $e)
                                                        {{ $e }}
                                                    @endforeach
                                                </td>
                                                <td>{{ $validation->values()[$validation->attribute()] }}</td>
                                                <td>{{ $validation->row() }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif
                            </div>
                        </div> <!-- end card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
