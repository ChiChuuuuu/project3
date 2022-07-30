@extends('layout.layout')

@section('main')
    <div class="wrapper">
        <div class="main-panel">
            <nav class="navbar navbar-default">
                <a class="navbar-brand">Thống kê</a>
            </nav>


            <div class="main-container">

                <div class="main-content">
                    {{-- Thong ke chung --}}
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

                    {{-- Muon qua thoi han --}}
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
                                        {{-- action="{{ url('/lostBook', [$history->idBB, '3']) }}" --}}
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

                                                    <td>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#exampleModal">
                                                            <div style="color:red"> Nộp phạt </div>
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Nộp phạt</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('bbook.charge', ['idBB' => $history->idBB,'idBook' => $history->idBook]) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="form-group row">
                                                                                <label for="inputChargeMoney"
                                                                                    class="col-sm-2 col-form-label">Số tiền
                                                                                    phạt</label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="text"
                                                                                        id="inputChargeMoney"
                                                                                        class="form-control"
                                                                                        name="chargeMoney" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="inputReason"
                                                                                    class="col-sm-2 col-form-label">Lý
                                                                                    do</label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="text" id="inputReason"
                                                                                        class="form-control" name="reason"
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="status"
                                                                                    class="col-sm-2 col-form-label">Mất
                                                                                    sách</label>
                                                                                <input type="checkbox" id="status"
                                                                                    name="status" value="3">

                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-primary">Save
                                                                                changes</button>
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    {{-- End modal --}}
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

                    {{-- Sach muon nhieu --}}
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
                    {{-- Thong ke nam cu --}}
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

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title text-center">The vua gia han</h4>
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Mã thẻ</th>
                                                <th>Họ và tên</th>
                                                <th>Ngày gia hạn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($extendCard as $extendCard)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $extendCard->idStudent }}
                                                    </td>
                                                    <td>
                                                        {{ $extendCard->name }}
                                                    </td>
                                                    <td> {{ date('d-m-Y', strtotime($extendCard->lastUpdated)) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Sach mat --}}
                    <div class="container-fluid">

                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sách đã mất</h4>
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

                                        @forelse ($lostBook as $history)
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
                                                    <div style='color:red;'>Sách đã mất</div>
                                                </td>
                                            </tr>
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
                    {{-- Nop phat --}}
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title text-center">Nộp phạt </h4>
                            </div>

                            <div class="content table-responsive table-full-width">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Mã thẻ</th>
                                            <th>Người mượn</th>
                                            <th>Tên sách</th>
                                            <th>Tiền phạt</th>
                                            <th>Lý do</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($charge as $charge)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $charge->idStudent }}
                                                </td>
                                                <td>
                                                    {{ $charge->name }}
                                                </td>
                                                <td>
                                                    {{ $charge->bookTitle }}
                                                </td>
                                                <td>
                                                    {{ $charge->money }}đ
                                                </td>
                                                <td>
                                                    {{ $charge->reason }}
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
@endsection
