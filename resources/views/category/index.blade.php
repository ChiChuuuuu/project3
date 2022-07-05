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
                            <h4 class="title">Thể loại</h4>
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
                                        <th>Thể loại</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($category as $categorys)
                                        <tr>
                                            <td class="text-center"> {{ $categorys->idCategory }} </td>
                                            <td> {{ $categorys->nameCategory }} </td>
                                            <td class="td-actions">
                                                <a href="{{ route('category.edit', ['category' => $categorys->idCategory]) }}"
                                                    rel="tooltip" title="Edit Profile"
                                                    class="btn btn-success btn-simple btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                Chưa có dữ liệu
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $category->links('pagination::bootstrap-4') }}
                    </div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <a href="{{ route('category.create') }}"><button type="button"
                            class="btn btn-primary btn-fill btn-wd">Thêm thể loại</button></a>
                </div>
            </div>
        </div>
    @endsection
