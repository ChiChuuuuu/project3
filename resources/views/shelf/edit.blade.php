@extends('layout.layout')
@section('main')

    <div class="main-panel">
        <div class="main-content">
            <div class="col-md-6">
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <div class="header">
                                <legend>Sửa tủ</legend>
                            </div>
                            <div class="content">
                                <form action="{{ route('shelf.update', ['shelf' => $shelf->idShelf]) }}" method="POST"
                                    class="form-horizontal">
                                    @csrf
                                    @method('put')
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Số hiệu tủ</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="shelfNo"
                                                    value="{{ $shelf->shelfNo }}">
                                            </div>
                                        </div> <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Tầng</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="floorNo"
                                                    value="{{ $shelf->floorNo }}">
                                            </div>
                                        </div> <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Trạng thái </label>
                                            @foreach ($status as $status)
                                                <div class="radio">
                                                    &nbsp;<input type="radio" name="status" id="{{ $status->idStatus }}"
                                                        value="{{ $status->idStatus }}" @if ($status->idStatus == $shelf->status)
                                                    checked
                                            @endif
                                            >
                                            <label for="{{ $status->idStatus }}">
                                                {{ $status->status }}
                                            </label>
                                        </div>
                                        @endforeach

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
