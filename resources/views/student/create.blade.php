@extends('layout.layout')
@section('main')
    <div class="main-panel">
        <div class="main-content">
            <div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <div class="header">
                                <legend>Thêm thẻ sinh viên</legend>
                            </div>
                            <div class="content">
                                <form action="{{ route('student.store') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Họ và tên</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                        </div> <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Ngày sinh</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="dob" />
                                            </div>
                                        </div> <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Giới tính </label>

                                            <div class="radio">
                                                &nbsp;<input type="radio" name="gender" id="gender" value="0">
                                                <label for="gender">
                                                    Nam
                                                </label>
                                            </div>
                                            <div class="radio">
                                                &nbsp;<input type="radio" name="gender" id="gender1" value="1">
                                                <label for="gender1">
                                                    Nữ
                                                </label>
                                            </div>

                                        </div> <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Chuyên ngành</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="department">
                                            </div>
                                        </div> <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Số điện thoại</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="phone">
                                            </div>
                                        </div> <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Trạng thái </label>
                                            @foreach ($status as $status)
                                                <div class="radio">
                                                    &nbsp;<input type="radio" name="status" id="{{ $status->idStatus }}"
                                                        value="{{ $status->idStatus }}">
                                                    <label for="{{ $status->idStatus }}">
                                                        {{ $status->status }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div> <br>
                                        <button class="btn btn-primary btn-fill ">Thêm</button>
                                    </fieldset>
                                </form>


                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
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
