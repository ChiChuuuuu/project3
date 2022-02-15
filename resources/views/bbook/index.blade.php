@extends('layout.layout')
@section('main')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <style type="text/css">
        td {
            padding: 10px
        }

    </style>

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
                                <form action="{{ route('bbook.store') }}" method="POST">
                                    @csrf
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>Mã thẻ thư viện</td>
                                                <td>Thông tin thẻ</td>
                                                <td>Mã sách</td>
                                                <td>Tên Sách</td>
                                                <td>Ngày mượn</td>
                                                <td>Ngày trả dự kiến</td>
                                                <td>Ghi chú</td>
                                                <td>
                                                    <button class="btn btn-info addRow">+</button>
                                                    <br><br></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control hidden" name="idStaff[]"
                                                value="{{ Session::get('id') }}" >
                                                </td>
                                                <td>
                                                    <input list="hsinh" id="idStudent" name="idStudent[]" class="form-control" />
                                                    <datalist id="hsinh">
                                                        @foreach ($student as $student)
                                                            <option value="{{ $student->idStudent }}">{{ $student->name }}</option>
                                                        @endforeach
                                                    </datalist>
                                                </td>
                                                <td>
                                                    <select id="infoStudent" class="form-control" disabled>

                                                    </select>
                                                </td>
                                                <td>
                                                    <input list="sach" id="book" name="book[]" class="form-control" required/>
                                                    <datalist id="sach">
                                                        @foreach ($book as $book)
                                                            <option value="{{ $book->idBook }}">{{ $book->bookTitle }}</option>
                                                        @endforeach
                                                    </datalist>
                                                </td>
                                                <td>
                                                    <select id="book2" class="form-control" disabled>

                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" name="dateCurrent[]"
                                                        value="{{ $mytime->format('Y-m-d') }}">
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" name="dateReturn[]">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="note[]">
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    {{-- <input type="text" class="form-control hidden" name="idStaff[]"
                                        value="{{ Session::get('id') }}">
                                    <div class="form-group">
                                        <label class="control-label">Mã thẻ thư viện</label>
                                        <div>
                                            <input type="text" class="form-control" name="idStudent[]">
                                        </div>
                                    </div>

                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="book">Sách:</label>
                                                </td>
                                                <td>
                                                    <input list="sach" id="book" name="book[]" class="form-control" />
                                                </td>
                                                <td>
                                                    <datalist id="sach">
                                                        @foreach ($book as $book)
                                                            <option value="{{ $book->bookTitle }}"></option>
                                                        @endforeach
                                                    </datalist>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <a href="#" class="addRow">Thêm sách</a> <br><br>

                                    <div class="form-group">
                                        <label class="control-label">Ngày mượn</label>
                                        <div>
                                            <input type="date" class="form-control" name="dateCurrent[]"
                                                value="{{ $mytime->format('Y-m-d') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Ngày trả dự kiến</label>
                                        <div>
                                            <input type="date" class="form-control" name="dateReturn[]">
                                        </div>
                                    </div> --}}


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

    <script type="text/javascript">
        $('#book').change(function(e) {
            $('#book2').html('');
            var idBook = $(this).val();
            var currentURL = window.location.href;
            var URL = currentURL + "/get-books/" + idBook;
            $.ajax({
                type: "get",
                url: URL,
                success: function (response) {
                    $.each(response, function(index,value){
                        var option = `
                            <option value="${ value.bookTitle }"> ${ value.bookTitle } </option>
                        `;
                        $('#book2').append(option);
                    })
                }
            });
        })

        $('#idStudent').change(function(e) {
            $('#infoStudent').html('');
            var idStudent = $(this).val();
            var currentURL = window.location.href;
            var URL = currentURL + "/get-student/" + idStudent;
            $.ajax({
                type: "get",
                url: URL,
                success: function (response) {
                    $.each(response, function(index,value){
                        var option = `
                            <option value="${ value.dob }"> ${ value.name } | ${ value.dob } </option>
                        `;
                        $('#infoStudent').append(option);
                    })
                }
            });
        })


        $('.addRow').on('click', function() {
            addRow();
        });

        function addRow() {
            var tr =
            '<tr>'+
                '<td>'+ '<input type="text" class="form-control hidden" name="idStaff[]" value="{{ Session::get('id') }}" >' +'</td>'+
                '<td>'+
                    '<input list="hsinh" id="idStudent" name="idStudent[]" class="form-control" />'+
                        '<datalist id="hsinh">'+
                            '@foreach ($student as $student)'+
                                '<option value="'+'{{'+ $student->idStudent+ '}}'+ '"></option>'+
                            '@endforeach'+
                        '</datalist>'+
                '</td>'+
                '<td>'+
                    '<input type="text" class="form-control" name="infoStudent" disabled>'+
                '</td>'+
                '<td>'+
                    '<input list="sach" id="book" name="book[]" class="form-control" required/>'+
                    '<datalist id="sach">'+
                        '@foreach ($book as $book)'+
                        '<option value="' + '{{'+ $book->idBook +'}}' + '"></option>'+
                        '@endforeach'+
                    '</datalist>'+
                '</td>'+
                '<td>'+
                    '<select id="book2" class="form-control" disabled>'+

                    '</select>'+
                '</td>'+
                '<td>'+
                    '<input type="date" class="form-control" name="dateCurrent[]"'+
                        'value="{{ $mytime->format('Y-m-d') }}">'+
                '</td>'+
                '<td>'+
                '<input type="date" class="form-control" name="dateReturn[]">'+
                '</td>'+
                '<td>'+
                        '<input type="text" class="form-control" name="note[]">'+
                '</td>'+
                '<td>'+
                    '<button class="btn btn-danger remove">-</button> '+
                    '</td>'+
            '</tr>';
            $('tbody').append(tr);
        }

        $('tbody').on('click', '.remove', function() {
            $(this).parent().parent().remove();
        })


    </script>

@endsection
