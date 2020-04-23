$(document).ready(function () {

    $(".delete").click(function (e) {
        let url = $(this).parent().parent().find("img").attr('src');
        $.post("/ajax.php?entity=photo&action=delete",
            {
                'url': url
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                console.log("done", e)
                if (e['status'] === 'success') {
                    console.log("success")
                } else {
                    console.log("error")
                }
            })
    });

    $(".btnAddPhoto").click(function () {
        $("#uploadInput").click();
    })

    $("#uploadInput").change(function (e) {
        var file_data = $('#uploadInput').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: "/ajax.php?entity=photo&action=add",
            type: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data == 'invalid') {
                    // invalid file format.
                    $("#err").html("Invalid File !").fadeIn();
                }
                else {
                    // view uploaded file.
                }
            },
            error: function (e) {
                $("#err").html(e).fadeIn();
            }
        });
    })
    //TODO trigger on change value:
    /*
    -firstName
    -lastName
    -birthday
    -description
    -sex
    -city

    -add remove hobby / personalities / dish / photo
    */
})

