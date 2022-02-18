@extends('layout.layout')
@section('main')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <div class="main-panel">
        <nav class="navbar navbar-default">
        </nav>


        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Lịch sử mượn sách</h4>
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
                                        <tr>
                                            <td> </td>
                                            <td> {{ $history->bookTitle }} </td>
                                            <td> {{ $history->nameAuthor }} </td>
                                            <td> {{ $history->name }} |
                                                {{ date('d-m-Y', strtotime($history->dob)) }}
                                            </td>
                                            <td> {{ date('d-m-Y', strtotime($history->fromDate)) }}
                                            </td>
                                            <td> {{ date('d-m-Y', strtotime($history->toDate)) }}
                                            </td>
                                            <td> {{ $history->note }} </td>
                                            <td> {{ $history->username }} </td>
                                            <th>
                                                @if ($history->status == 1)
                                                    <span>Đang mượn</span>
                                                @endif
                                            </th>
                                            <td>
                                                <a href="{{ url('/get-status', [$history->idBB, '0']) }}" rel="tooltip"
                                                    class="btn btn-success btn-xs">
                                                    Trả sách
                                                </a>
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
                            {{ $historys->appends(['search' => $search])->links('pagination::bootstrap-4') }}
                        </div>



                    </div>

                    <div class="card">
                        <div class="header">
                            <h4 class="title">Lịch sử trả sách</h4>
                        </div>
                        <form class="navbar-form navbar-left navbar-search-form" role="search">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" value="{{ $search2 }}" name="search2" class="form-control"
                                    placeholder="Search...">
                            </div>
                        </form>
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
                                        <th>Ngày trả sách</th>
                                        <th>Ghi chú</th>
                                        <th>Tình trạng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($history2s as $history2)
                                        <tr>
                                            <td> </td>
                                            <td> {{ $history2->bookTitle }} </td>
                                            <td> {{ $history2->nameAuthor }} </td>
                                            <td> {{ $history2->name }} |
                                                {{ date('d-m-Y', strtotime($history2->dob)) }}
                                            </td>
                                            <td> {{ date('d-m-Y', strtotime($history2->fromDate)) }}
                                            </td>
                                            <td> {{ date('d-m-Y', strtotime($history2->toDate)) }}
                                            </td>
                                            <td> {{ date('d-m-Y', strtotime($history2->actualDate)) }}
                                            </td>
                                            <td> {{ $history2->note }} </td>
                                            <td>
                                                @if ($history2->status == 0)
                                                    @if ($history2->actualDate > $history2->toDate)
                                                        <span style="color:blue">Đã trả sách</span><br>
                                                        <span style="color:red">(Quá hạn)</span>
                                                    @else
                                                        <span style="color:blue">Đã trả sách</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td></td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <th></th>
                                            <th>Khong co du lieu</th>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                            {{ $history2s->appends(['search2' => $search2])->links('pagination::bootstrap-4') }}
                        </div>

                    </div>

                    <div class="row">

                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @endsection
