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
                            <h4 class="title">Thẻ thư viện</h4>
                        </div>
                        <form class="navbar-form navbar-left navbar-search-form" role="search">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" name="search" value="{{ $search }}" class="form-control"
                                    placeholder="Search...">
                            </div>
                        </form>
                        <div class="content table-responsive table-full-width">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Mã thẻ</th>
                                        <th>Họ và tên</th>
                                        <th>Ngày sinh</th>
                                        <th>Giới tính</th>
                                        <th>Chuyên ngành</th>
                                        <th>Số điện thoại</th>
                                        <th>Trạng thái</th>
                                        <th>In thẻ</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($student as $students)
                                        <tr>
                                            <td class="text-center"> {{ $students->idStudent }} </td>
                                            <td> {{ $students->name }} </td>
                                            <td> {{ date('d-m-Y', strtotime($students->dob)) }}</td>
                                            <td>
                                                @if ($students->gender == 0)
                                                    Nam
                                                @else
                                                    Nữ
                                                @endif
                                            </td>
                                            <td> {{ $students->department }} </td>
                                            <td> {{ $students->phone }} </td>
                                            <td>
                                                @if ($students->idStatus == 2)
                                                    <div style="color: red"> {{ $students->status }} </div>
                                                @else
                                                    <div style="color: blue"> {{ $students->status }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td></td>
                                            <td class="td-actions">
                                                <a href="#" rel="tooltip" title="View Profile"
                                                    class="btn btn-info btn-simple btn-xs">
                                                    <i class="fa fa-user"></i>
                                                </a>
                                                <a href="{{ route('student.edit', ['student' => $students->idStudent]) }}"
                                                    rel="tooltip" title="Edit Profile"
                                                    class="btn btn-success btn-simple btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td></td>
                                            <td>Không có dữ liệu</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $student->appends(['search' => $search])->links('pagination::bootstrap-4') }}
                </div>
            </div>

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <a href="{{ route('student.create') }}"><button type="button"
                    class="btn btn-primary btn-fill btn-wd">Thêm</button></a>
            <a href="{{ route('student.insert-by-excel') }}"><button type="button"
                    class="btn btn-primary btn-fill btn-wd">Thêm bằng excel</button></a>
            <a href="{{ route('student.export-excel') }}"><button type="button" class="btn btn-primary btn-fill btn-wd">Tải
                    file excel mẫu</button></a>
        </div>

    @endsection
