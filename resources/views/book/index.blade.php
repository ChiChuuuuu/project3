@extends('layout.layout')
@section('main')
    <div class="main-panel">
        <nav class="navbar navbar-default">
            {{-- <div class="container-fluid">
            <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-warning btn-fill btn-round btn-icon">
                    <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                    <i class="fa fa-navicon visible-on-sidebar-mini"></i>
                </button>
            </div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Extended Tables</a>
            </div>
            <div class="collapse navbar-collapse">

                <form class="navbar-form navbar-left navbar-search-form" role="search">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" value="" class="form-control" placeholder="Search...">
                    </div>
                </form>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="../charts.html">
                            <i class="fa fa-line-chart"></i>
                            <p>Stats</p>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-gavel"></i>
                            <p class="hidden-md hidden-lg">
                                Actions
                                <b class="caret"></b>
                            </p>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Create New Post</a></li>
                            <li><a href="#">Manage Something</a></li>
                            <li><a href="#">Do Nothing</a></li>
                            <li><a href="#">Submit to live</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Another Action</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="notification">5</span>
                            <p class="hidden-md hidden-lg">
                                Notifications
                                <b class="caret"></b>
                            </p>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Notification 1</a></li>
                            <li><a href="#">Notification 2</a></li>
                            <li><a href="#">Notification 3</a></li>
                            <li><a href="#">Notification 4</a></li>
                            <li><a href="#">Another notification</a></li>
                        </ul>
                    </li>

                    <li class="dropdown dropdown-with-icons">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-list"></i>
                            <p class="hidden-md hidden-lg">
                                More
                                <b class="caret"></b>
                            </p>
                        </a>
                        <ul class="dropdown-menu dropdown-with-icons">
                            <li>
                                <a href="#">
                                    <i class="pe-7s-mail"></i> Messages
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="pe-7s-help1"></i> Help Center
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="pe-7s-tools"></i> Settings
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <i class="pe-7s-lock"></i> Lock Screen
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-danger">
                                    <i class="pe-7s-close-circle"></i>
                                    Log out
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div> --}}
        </nav>


        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Danh sách Sách</h4>
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
                                        <th>Thể loại</th>
                                        <th>Ngày phát hành</th>
                                        <th>Ngôn ngữ</th>
                                        <th>Tủ sách</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($book as $books)
                                        <tr>
                                            <td class="text-center"> {{ $books->idBook }} </td>
                                            <td> {{ $books->bookTitle }} </td>
                                            <td> {{ $books->nameAuthor }} </td>
                                            <td> {{ $books->nameCategory }} </td>
                                            <td> {{ date('d-m-Y', strtotime($books->publicationDate)) }} </td>
                                            <td> {{ $books->language }} </td>
                                            <td> {{ $books->shelfNo }} </td>
                                            <td class="td-actions">
                                                <a href="{{ route('book.edit', ['book' => $books->idBook]) }}"
                                                    rel="tooltip" title="Edit Profile"
                                                    class="btn btn-success btn-simple btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                {{-- <a href="#" rel="tooltip" title="Remove"
                                                    class="btn btn-danger btn-simple btn-xs">
                                                    <i class="fa fa-times"></i>
                                                </a> --}}
                                            </td>
                                        </tr>
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

                    @if (Session::get('isAdmin') == 0)
                    @else
                        <a href="{{ route('book.create') }}"><button type="button"
                                class="btn btn-primary btn-fill btn-wd">Thêm sách</button></a>

                        <a href="{{ route('book.insert-by-excel') }}"><button type="button"
                                class="btn btn-primary btn-fill btn-wd">Thêm sách = excel</button></a>
                        <a href="{{ route('book.export-excel') }}"><button type="button"
                                class="btn btn-primary btn-fill btn-wd">Tải file excel mẫu</button></a>
                    @endif

                </div>
            </div>


        </div>
    @endsection
