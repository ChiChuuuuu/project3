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
                            <h4 class="title">Tủ sách</h4>
                        </div>
                        <form class="navbar-form navbar-left navbar-search-form" role="search">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" value="" class="form-control" placeholder="Search...">
                            </div>
                        </form>
                        <div class="content table-responsive table-full-width">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Tủ sách</th>
                                        <th>Tầng</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($shelf as $shelf)
                                        <tr>
                                            <td class="text-center"> {{ $shelf->idShelf }} </td>
                                            <td> {{ $shelf->shelfNo }} </td>
                                            <td> Tầng {{ $shelf->floorNo }} </td>
                                            <td>
                                                @if ($shelf->idStatus == 2)
                                                    <div style="color: blue">{{ $shelf->status }}</div>
                                                @else
                                                <div style="color: red">{{ $shelf->status }}</div>
                                                @endif
                                                 </td>
                                            <td class="td-actions">
                                                <a href="{{ route('shelf.edit', ['shelf' => $shelf->idShelf]) }}"
                                                    rel="tooltip" title="Edit Profile"
                                                    class="btn btn-success btn-simple btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        Chưa có dữ liệu
                                    @endforelse
                                </tbody>
                            </table>

                        </div>

                    </div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <a href="{{ route('shelf.create') }}"><button type="button"
                            class="btn btn-primary btn-fill btn-wd">Thêm</button></a>
                </div>
            </div>


        </div>

    @endsection
