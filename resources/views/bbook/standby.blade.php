@extends('layout.layout')
@section('main')
    <div class="main-panel">
        <nav class="navbar navbar-default">
        </nav>


        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Danh sách Sách mượn online</h4>
                        </div>
                        <form class="navbar-form navbar-left navbar-search-form" role="search">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" value="{{ $search }}" name="search" class="form-control"
                                    placeholder="Search...">
                            </div>
                        </form>
                        <div class="content table-responsive table-full-width">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Mã thẻ thư viện</th>
                                        <th>Thông tin người mượn</th>
                                        <th>Tên sách</th>
                                        <th>Tác giả</th>
                                        <th>Ghi chú</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($book as $books)
                                    <form method="GET" action="{{ route('bbook.standby-status', [$books->idBB, '1']) }}">
                                        <tr>
                                            <td class="text-center"> {{ $books->idStudent }} </td>
                                            <td>{{ $books->name }} | {{ date('d-m-Y', strtotime($books->dob))}} | {{ $books->phone }}</td>
                                            <td> {{ $books->bookTitle }} </td>
                                            <td> {{ $books->nameAuthor }} </td>
                                            <td><input type="text" class="form-control" name="note" required></td>
                                            <td class="td-actions">
                                                <Button rel="tooltip"
                                                    class="btn btn-success btn-xs-xl6">
                                                    Mượn sách
                                                </Button>
                                            </td>
                                        </tr>
                                    </form>
                                    @empty
                                        <tr>
                                            <td>
                                            <td>
                                                Không có dữ liệu
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>

                        {{ $book->appends(['search' => $search])->links('pagination::bootstrap-4') }}

                    </div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                </div>
            </div>


        </div>
    @endsection
