@extends('layout.layout')
@section('main')

    <div class="main-panel">
        <div class="main-content">
            <div class="col-md-6">
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <div class="header">
                                <legend></legend>
                            </div>
                            <div class="content">
                                <form action="{{ route('author.update', ['author' => $author->idAuthor]) }}" method="POST"
                                    class="form-horizontal">
                                    @method('PUT')
                                    @csrf
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Tên tác giả</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nameAuthor"
                                                    value="{{ $author->nameAuthor }}">
                                            </div>
                                        </div> <br>
                                        <button class="btn btn-primary btn-fill ">Sửa</button>
                                    </fieldset>
                                </form>

                            </div>
                        </div> <!-- end card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
