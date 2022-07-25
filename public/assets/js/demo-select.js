$('#idStudent').change(function(e){
    $("#idName").html('');
    $("#dob").html('');
    $("#phone").html('');
    var idStudent = $(this).val();
    var currentUrl = window.location.href;
    var url = currentUrl + "/get-student-by-id/" + idStudent;

    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            $.each(response, function(index, value) {
                var option = `
                <option value="${value.name}">${value.name}</option>
                `
                var option2 = `
                    <option value="${value.dob}">${value.dob}</option>
                `
                var option3 = `
                    <option value="${value.phone}">${value.phone}</option>
                `

                $("#idName").append(option);
                $("#dob").append(option2);
                $("#phone").append(option3);
            })
        }
    });
})

$('#book').change(function(e){
    $("#bookTitle").html('');
    $("#author").html('');
    var idStudent = $(this).val();
    var currentUrl = window.location.href;
    var url = currentUrl + "/get-book-by-id/" + idStudent;

    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            $.each(response, function(index, value) {
                var option = `
                <option value="${value.bookTitle}">${value.bookTitle}</option>
                `
                var option2 = `
                    <option value="${value.nameAuthor}">${value.nameAuthor}</option>
                `

                $("#bookTitle").append(option);
                $("#author").append(option2);
            })
        }
    });
})

