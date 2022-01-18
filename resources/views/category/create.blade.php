@extends('layout.layout')
@section('main')

    <div class="main-panel">
        <div class="main-content">
            <div class="col-md-6">
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <div class="header">
                                <legend>Thêm thể loại</legend>
                            </div>
                            <div class="content">
                                <form action="{{ route('category.store') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Tên thể loại</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nameCategory">
                                            </div>
                                        </div> <br>
                                        <button class="btn btn-primary btn-fill ">Thêm</button>
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
