@extends('layout.layout')
@section('main')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/...;" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/s...;"></script>

    <div class="main-panel">
        <div class="main-content">
            <div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <div class="header">
                                <legend>Mượn sách</legend>
                            </div>
                            <div class="content">
                                <form>

                                    <div class="form-group">
                                        <label>Tên sách</label>
                                        <input type="text" class="form-control" name="bookTitle" required>
                                    </div>


                                <br><br><br>
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
