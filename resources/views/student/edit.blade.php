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
                                                &nbsp;<input type="radio" name="gender" id="gender" value="0"
                                                    @if ($student->gender == 0) checked @endif>
                                                <label for="gender">
                                                    Nam
                                                </label>
                                            </div>
                                            <div class="radio">
                                                &nbsp;<input type="radio" name="gender" id="gender1" value="1"
                                                    @if ($student->gender == 1) checked @endif>
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
                                            <label class="col-sm-2 control-label">Ngày hết hạn</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="expiredDate"
                                                    value="{{ $student->expiredDate }}" />
                                                @if ($student->expiredDate < $now)
                                                    <div style="color: red">Ngày hết hạn không được nhỏ hơn ngày hiện tại
                                                    </div>
                                                @endif
                                            </div>
                                        </div> <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Trạng thái </label>

                                            <div class="radio">
                                                &nbsp;<input type="radio" name="status" id="1" value="1"
                                                    @if ($student->expiredDate > $now) checked="checked" @endif>
                                                <label for="1">
                                                    Hoạt động
                                                </label>
                                            </div>

                                            <div class="radio">
                                                &nbsp;<input type="radio" name="status" id="2" value="2"
                                                    @if ($student->expiredDate <= $now) checked="checked" @endif>
                                                <label for="2">
                                                    Không hoạt động
                                                </label>
                                            </div>
                                            @if (session()->has('danger'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('danger') }}
                                            </div>
                                        @endif
                                        </div> <br>
                                        <button class="btn btn-primary btn-fill ">Update</button>
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
