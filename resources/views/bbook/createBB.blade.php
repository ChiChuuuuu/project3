@extends('layout.layout')
@section('main')
    <div class="main-panel">
        <div class="main-content">
            <div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <div class="header">
                                <legend>Mượn sách</legend>
                            </div>
                            <div class="content">
                                <form action="{{ route('bbook.saveBB') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label>Mã thẻ thư viện</label>
                                        <input list="hsinh" id="idStudent" name="idStudent" class="form-control"
                                            required />
                                        <datalist id="hsinh">
                                            @foreach ($student as $student)
                                                <option value="{{ $student['idStudent'] }}">{{ $student->idStudent }} |
                                                    {{ $student->name }} |
                                                    {{ date('d-m-Y', strtotime($student->dob)) }}
                                                </option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                    <div class="form-group">
                                        <label>Họ và tên</label>
                                        <select class="form-control" id="idName" name="nameStudent" disabled>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày sinh</label>
                                        <select class="form-control" id="dob" name="dob" disabled>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <select class="form-control" id="phone" name="phone" disabled>
                                            <option></option>
                                        </select>
                                    </div>

                                    {{-- Sach --}}

                                    <div class="form-group">
                                        <label>Mã sách</label>
                                        <input list="sach" id="book" name="book" class="form-control" required />
                                        <datalist id="sach">
                                            @foreach ($book as $book)
                                                <option value="{{ $book->idBook }}">{{ $book->bookTitle }}</option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                    <div class="form-group">
                                        <label>Tên sách</label>
                                        <select class="form-control" id="bookTitle" name="bookTitle" disabled>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tác giả</label>
                                        <select class="form-control" id="author" name="author" disabled>
                                            <option></option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Ngày mượn</label>

                                        <input type="date" name="dateCurrent" class="form-control"
                                            value="{{ $now->format('Y-m-d') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Ngày trả</label>
                                        <input type="date" name="dateReturn" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Note</label>
                                        <input type="text" name="note" class="form-control">
                                    </div>

                                    <input type="text" class="form-control hidden" name="idStaff"
                                        value="{{ Session::get('id') }}">

                                    <button type="submit" class="btn btn-fill btn-info">Thêm</button>
                                </form>

                            </div>

                            @if (session()->has('danger'))
                                <div class="alert alert-danger">
                                    {{ session()->get('danger') }}
                                </div>
                            @endif
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif

                        </div> <!-- end card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
