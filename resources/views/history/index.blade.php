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
                                                    class="btn btn-success btn-xs-xl6">
                                                    Trả sách
                                                </a>
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
