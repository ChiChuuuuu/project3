@extends('layout.layout')
@section('main')

    <div class="main-panel">
        <div class="main-content">
            <div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <div class="header">
                                <legend>Thêm sách</legend>
                            </div>
                            <div class="content">
                                <form action="{{ route('book.update', ['book'=>$book->idBook]) }}" method="POST" enctype="multipart/form">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Tên sách</label>
                                        <input type="text" class="form-control" name="bookTitle" value="{{ $book->bookTitle }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Tác giả</label>
                                            <select name="author" class="selectpicker" data-title="Single Select"
                                                data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                @foreach ($author as $author)
                                                <option value="{{ $author->idAuthor }}"
                                                    @if ($author->idAuthor == $book->author)
                                                        selected
                                                    @endif
                                                    >{{ $author->nameAuthor }}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Thể loại</label>
                                        <select name="category" class="selectpicker" data-title="Single Select"
                                                data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                @foreach ($category as $category)
                                                <option value="{{ $category->idCategory }}"
                                                    @if ($category->idCategory == $book->category)
                                                        selected
                                                    @endif
                                                    >{{ $category->nameCategory }}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Ngôn ngữ</label>
                                        <input type="text" class="form-control" name="language" value="{{ $book->language }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Số lượng</label>
                                        <input type="number" class="form-control" name="quantity" value="{{ $book->quantity }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Ngày xuất bản</label>
                                        <input type="date" class="form-control datepicker" name="publicationDate" value="{{ $book->publicationDate }}"/>
                                    </div>


                                    <button type="submit" class="btn btn-fill btn-info">Sửa</button>
                                </form>
                            </div>
                        </div> <!-- end card -->
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
