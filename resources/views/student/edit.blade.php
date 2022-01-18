@extends('layout.layout')
@section('main')

    <div class="main-panel">
        <div class="main-content">
            <div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <div class="header">
                                <legend>Sửa thông tin thẻ sinh viên</legend>
                            </div>
                            <div class="content">
                                <form action="{{ route('student.update', ['student' => $student->idStudent]) }}"
                                    method="POST" class="form-horizontal">
                                    @csrf
                                    @method('PUT')
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Họ và tên</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $student->name }}">
                                            </div>
                                        </div> <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Ngày sinh</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="dob"
                                                    value="{{ $student->dob }}" />
                                            </div>
                                        </div> <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Giới tính </label>

                                            <div class="radio">
                                                &nbsp;<input type="radio" name="gender" id="gender" value="0" @if ($student->gender == 0)
                                                checked
                                                @endif>
                                                <label for="gender">
                                                    Nam
                                                </label>
                                            </div>
                                            <div class="radio">
                                                &nbsp;<input type="radio" name="gender" id="gender1" value="1" @if ($student->gender == 1)
                                                checked
                                                @endif>
                                                <label for="gender1">
                                                    Nữ
                                                </label>
                                            </div>

                                        </div> <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Chuyên ngành</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="department"
                                                    value="{{ $student->department }}">
                                            </div>
                                        </div> <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Số điện thoại</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="phone"
                                                    value="{{ $student->phone }}">
                                            </div>
                                        </div> <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Trạng thái </label>
                                            @foreach ($status as $status)
                                                <div class="radio">
                                                    &nbsp;<input type="radio" name="status" id="{{ $status->idStatus }}"
                                                        value="{{ $status->idStatus }}" @if ($status->idStatus == $student->idStatus)
                                                    checked
                                            @endif>
                                            <label for="{{ $status->idStatus }}">
                                                {{ $status->status }}
                                            </label>
                                        </div>
                                        @endforeach
                            </div> <br>
                            <button class="btn btn-primary btn-fill ">Thêm</button>
                            </fieldset>
                            </form>

                        </div>
                    </div> <!-- end card -->
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
