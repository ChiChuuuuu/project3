@extends('layout.layout2')
@section('main')
    <style>
        .card {
            box-shadow: 0px 7px 10px rgba(0, 0, 0, 0.5);
            transition: 0.5s ease-in-out;
        }

        .card:hover {
            transform: translateY(20px);
        }

        .card:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 176, 155, 0.5), rgba(201, 155, 61, 1));
            z-index: 2;
            transition: 0.5s all;
            opacity: 0;
        }

        .card:hover:before {
            opacity: 1;

        }

        .card img {
            position: relative;
            object-fit: cover;
            width: auto;
            height: 500px;
        }

        .card .info {
            position: absolute;
            z-index: 3;
            color: #fff;
            opacity: 0;
            transform: translateY(30px);
            transition: 0.5s all;
        }

        .card:hover .info {
            opacity: 1;
            transform: translateY(0px);
        }
    </style>


    <div class="main-panel">
        <div class="container-fluid">
            <div class="card2">
                <div class="col-md-4">
                    <div class="container-fluid">
                        <br><br>
                        <div class="row">
                            <form class="navbar-form navbar-left navbar-search-form" role="search">
                                <div class="input-group">
                                    <table class="table">
                                        <tr>
                                            <td><input type="text" name="search" value="{{ $search }}"
                                                    class="form-control" placeholder="Search..."></td>
                                            <td><select class="form-control" name="searchCategory">
                                                    <option></option>
                                                    @foreach ($category as $category)
                                                        <option value="{{ $category->nameCategory }}">
                                                            {{ $category->nameCategory }}</option>
                                                    @endforeach
                                                </select></td>
                                            <td><button class="btn btn-search"><i class="fa fa-search"></i></button></td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>

        <div class="wrapper">
            @foreach ($book as $book)
                <div class="col-md-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="card">
                                <div class="header">
                                    <legend> {{ $book->bookTitle }}</legend>

                                </div>
                                <div class="content">
                                    <div class="info">
                                        <h2>{{ $book->bookTitle }}</h2>
                                        <h3>{{ $book->nameAuthor }}</h3><br>
                                        @if ($book->quantity > 0)
                                            <a href="{{ route('online.create', ['idBook' => $book->idBook]) }}"
                                                class="btn btn-primary btn-fill">Mượn sách</a>
                                        @else
                                            <h4 style="color: red">Hết sách<h4>
                                        @endif

                                    </div>

                                    @if (isset($book->image))
                                        <div class="text-center"><img
                                                src="{{ asset('/storage/images/book/' . $book->image) }}"></div>
                                    @endif
                                </div>
                            </div> <!-- end card -->
                        </div>
                    </div>
                </div>
            @endforeach
            <div>
            </div>
        </div>
    </div>


    <script>
        var msg = '{{ Session::get('alert') }}';
        var exist = '{{ Session::has('alert') }}';
        if (exist) {
            alert(msg);
        }
    </script>
@endsection
