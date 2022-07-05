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
                                <form action="{{ route('book.store') }}" method="post" enctype="multipart/form">
                                    @csrf
                                    <div class="form-group">
                                        <label>Tên sách</label>
                                        <input type="text" class="form-control" name="bookTitle" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Tác giả</label>
                                            <select name="author" class="selectpicker" data-title="Single Select" required
                                                data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                @foreach ($author as $author)
                                                <option value="{{ $author->idAuthor }}">{{ $author->nameAuthor }}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Thể loại</label>
                                        <select name="category" class="selectpicker" data-title="Single Select" required
                                                data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                @foreach ($category as $category)
                                                <option value="{{ $category->idCategory }}">{{ $category->nameCategory }}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Ngôn ngữ</label>
                                        <input type="text" class="form-control" name="language" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Ngày xuất bản</label>
                                        <input type="date" class="form-control datepicker" name="publicationDate"  required/>
                                    </div>

                                    <div class="form-group">
                                        <label>Số lượng</label>
                                        <input type="number" class="form-control" name="quantity" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Tủ sách</label>
                                        <select name="shelf" class="selectpicker" data-title="Single Select" required
                                                data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                @foreach ($shelf as $shelf)
                                                <option value="{{ $shelf->idShelf }}">{{ $shelf->shelfNo }}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                    <button type="submit" class="btn btn-fill btn-info">Thêm</button>
                                </form>
                            </div>
                        </div> <!-- end card -->
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
