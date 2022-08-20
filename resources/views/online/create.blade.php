@extends('layout.layout2')
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
                                <form action="{{ route('online.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{-- Sach --}}
                                    <h3>
                                        <div hidden>
                                            Mã sách:
                                            <input type="hidden" name="idBook" value="{{ $book->idBook }}">
                                        </div>
                                        <div>
                                            Tên sách:
                                            {{ $book->bookTitle }}
                                        </div>
                                    </h3>
                                    <h3>
                                        <div>
                                            Tác giả:
                                            {{ $book->nameAuthor }}
                                        </div>
                                    </h3>
                                    <br><br>

                                    {{-- Thong tin --}}

                                    <div class="form-group">
                                        <label>Mã thẻ thư viện</label>
                                        <input list="hsinh" id="idStudent" name="idStudent" class="form-control"
                                            required />
                                    </div>

                                    <div class="form-group">
                                        <label>Họ và tên</label>
                                        <input type="text" id="nameStudent" name="nameStudent" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input type="number" id="phone" name="phone" class="form-control" required>
                                    </div>

                                    {{-- <div class="form-group">
                                        <label>Ngày sinh</label>
                                        <input type="date" class="form-control" name="dob" required>
                                    </div> --}}

                                    <div class="form-group">
                                        <label>Ngày mượn</label>

                                        <input type="date" name="dateCurrent" class="form-control"
                                            value="{{ $now->format('Y-m-d') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Ngày trả</label>
                                        <input type="date" name="dateReturn" class="form-control">
                                    </div>

                                    <div class="form-group" hidden>
                                        <label>Status</label>
                                        <input type="number" name="status" class="form-control" value="2" >
                                    </div>

                                    <button type="submit" class="btn btn-fill btn-info">Thêm</button>
                                </form>

                            </div>

                            @if (session()->has('danger'))
                                <div class="alert alert-danger">
                                    {{ session()->get('danger') }}
                                </div>
                            @endif

                        </div> <!-- end card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
