@extends('layout.layout')
@section('main')

    <div class="main-panel">

        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="header">
                            <legend>Thống kê tháng {{ $year }}</legend>
                            <div class="text-right">
                                <a href="{{ url('/dashboard/previewYear/exportByYear', $year) }}" class="btn btn-primary">Tải xuống</a>
                            </div>
                        </div>
                        <div class="content">
                            <div >
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
                                            @forelse ($book as $history2)
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
                                                    <td>
                                                        @if($history2->status == 3)
                                                        <span style="color:red">Khong co du lieu</span>
                                                        @elseif(is_null($history2->actualDate))
                                                        <span style="color:red">Khong co du lieu</span>
                                                        @else
                                                        {{ date('d-m-Y', strtotime($history2->actualDate)) }}
                                                        @endif
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
                                                        @else
                                                        <span style="color:red">Sách đã mất hoặc chưa được trả</span>
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
                                    {{ $book->appends(['search2' => $search2])->links('pagination::bootstrap-4') }}
                                </div>

                            </div>
                        </div>
                    </div> <!-- end card -->
                </div>
            </div>
        </div>
    </div>

@endsection
