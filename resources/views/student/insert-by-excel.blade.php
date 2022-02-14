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
                                @endif
                            </div>
                        </div> <!-- end card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
