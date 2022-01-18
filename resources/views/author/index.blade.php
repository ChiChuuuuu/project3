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
                            <h4 class="title">Tác giả</h4>
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
                                        <th>Họ và tên</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($author as $authors)
                                        <tr>
                                            <td class="text-center"> {{ $authors->idAuthor }} </td>
                                            <td> {{ $authors->nameAuthor }} </td>
                                            <td class="td-actions">
                                                <a href="{{ route('author.edit', ['author' => $authors->idAuthor]) }}"
                                                    rel="tooltip" title="Edit Profile"
                                                    class="btn btn-success btn-simple btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" rel="tooltip" title="Remove"
                                                    class="btn btn-danger btn-simple btn-xs">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        Chưa có dữ liệu
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                        {{ $author->links('pagination::bootstrap-4') }}
                    </div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <a href="{{ route('author.create') }}"><button type="button"
                            class="btn btn-primary btn-fill btn-wd">Thêm tác giả</button></a>
                </div>
            </div>


        </div>

    @endsection
