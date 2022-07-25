@extends('layout.layout')
@section('main')

    <div class="main-panel">
        <div class="main-content">
            <div class="col-md-6">
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <div class="header">
                                <legend>Thêm ảnh</legend>
                            </div>
                            <div class="content">
                                <form action="{{ url('/save-image') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <input type="text" name="idBook" hidden value="{{ $idBook }}" >
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="image" accept="image/jpeg,image/gif,image/png,application/pdf">
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
