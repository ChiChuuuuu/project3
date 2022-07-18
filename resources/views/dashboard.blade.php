@extends('layout.layout')

@section('main')
    <div class="wrapper">
        <div class="main-panel">
            <nav class="navbar navbar-default">
                <a class="navbar-brand">Thống kê</a>
            </nav>


            <div class="main-container">

                <div class="main-content">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card" style="background-color: cyan">
                                    <div class="header">
                                        <h4>Tổng số sách được mượn trong tháng {{ date('m', strtotime($now)) }} :
                                            {{ $bookByMonth->count() }}
                                        </h4><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="header">
                                        <h4>Tổng số sách được mượn trong ngày {{ date('d-m', strtotime($now)) }} :
                                            {{ $bookByDay->count() }}</h4><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card" style="background-color: rgb(252, 62, 62)">
                                    <div class="header">
                                        <h4>Tổng số sách chưa được trả :
                                            {{ $bookNotReturn->count() }}</h4><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="container-fluid">

                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sách đang mượn quá thời hạn</h4>
                            </div>

                            <div class="content table-responsive table-full-width">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Tên sách</th>
                                            <th>Tác giả</th>
                                            <th>Người mượn</th>
                                            <th>Ngày mượn</th>
                                            <th>Ngày hẹn trả sách</th>
                                            <th>Ghi chú</th>
                                            <th>Thủ thư cho mượn</th>
                                            <th>Tình trạng</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($historys as $history)
                                            @if ($history->toDate <= $now)
                                                <tr>
                                                    <td> </td>
                                                    <td> {{ $history->bookTitle }} </td>
                                                    <td> {{ $history->nameAuthor }} </td>
                                                    <td> {{ $history->name }} |
                                                        {{ date('d-m-Y', strtotime($history->dob)) }} |
                                                        {{ $history->phone }}
                                                    </td>
                                                    <td> {{ date('d-m-Y', strtotime($history->fromDate)) }}
                                                    </td>
                                                    <td> {{ date('d-m-Y', strtotime($history->toDate)) }}
                                                    </td>
                                                    <td> {{ $history->note }} </td>
                                                    <td> {{ $history->username }} </td>
                                                    <td>
                                                        Đã quá hạn
                                                        {{ $now->diffInDays($history->toDate) }} ngày
                                                    </td>
                                                </tr>
                                            @endif

                                        @empty
                                            <tr>
                                                <th></th>
                                                <th>Khong co du lieu</th>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>


                    <div class="container-fluid">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title text-center">Sách được mượn nhiều trong ngày
                                        {{ date('d-m', strtotime($now)) }} </h4>
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Tên sách</th>
                                                <th>Số lần mượn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mostBorrowedDay as $mostBorrowedDay)
                                                <tr>
                                                    <td>
                                                        {{ $mostBorrowedDay->bookTitle }}
                                                    </td>
                                                    <td>
                                                        {{ $mostBorrowedDay->NoOfTimesBorrowed }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title text-center">Sách được mượn nhiều trong tháng
                                        {{ date('m', strtotime($now)) }} </h4>
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Tên sách</th>
                                                <th>Số lần mượn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mostBorrowedBook as $mostBorrowedBook)
                                                <tr>
                                                    <td>
                                                        {{ $mostBorrowedBook->bookTitle }}
                                                    </td>
                                                    <td>
                                                        {{ $mostBorrowedBook->NoOfTimesBorrowed }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title text-center">Sách được mượn nhiều trong năm
                                        {{ date('Y', strtotime($now)) }} </h4>
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Tên sách</th>
                                                <th>Số lần mượn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mostBorrowedYear as $mostBorrowedYear)
                                                <tr>
                                                    <td>
                                                        {{ $mostBorrowedYear->bookTitle }}
                                                    </td>
                                                    <td>
                                                        {{ $mostBorrowedYear->NoOfTimesBorrowed }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title text-center">Thống kê năm {{ date('Y', strtotime($now)) }}</h4>
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Tháng</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($period as $period)
                                                <tr>
                                                    <td class="text-center">
                                                        Tháng {{ $period->Month }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('/dashboard/export', $period->Month) }}">Tải
                                                            xuống</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title text-center">Thống kê năm cũ</h4>
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Tháng</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($year as $period)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $period->Year }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('/dashboard/exportByYear', $period->Year) }}">Tải
                                                            xuống</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
