$(document).ready(function () {

    let confirmModification = false;
    let changedFirstName = false;
    let changedLastName = false;
    let changedBirthday = false;
    let changedSex = false;
    let changedCity = false;
    let changedDescription = false;
    let firstName = $("#firstname").val()
    let lastName = $("#lastname").val()
    let birthday = $("#birthday").val()
    let sex = $("#sexControl").val()
    let city = $("#cityControl").children("option:selected").val()
    let description = $("#description").val()

    function atLeastOneChange() {
        return changedFirstName || changedLastName || changedBirthday || changedSex || changedCity || changedDescription
    }

    $("#btnViewProfile").click(function () {
        if (!confirmModification) {
            if (atLeastOneChange()) {
                console.log("view profile changed")
                //DISPLAY MODAL
            } else {
                window.location.replace("/profile/" + $(this).attr('uniqID'));
            }
        } else {
            window.location.replace("/profile/" + $(this).attr('uniqID'));
        }

    })


    $("#submitInfo").click(function () {
        confirmModification = true;
        let argsJson = {};
        if (changedFirstName) {
            let newFirstName = $("#firstname").val()
            argsJson.firstname = newFirstName
            changedFirstName = false;
            firstName = newFirstName
        }
        if (changedLastName) {
            let newLastName = $("#lastname").val()
            argsJson.lastname = newLastName;
            changedLastName = false;
            lastName = newLastName
        }
        if (changedBirthday) {
            let newBirthday = $("#birthday").val()
            argsJson.changedBirthday = newBirthday
            changedBirthday = false;
            birthday = newBirthday
        }
        if (changedSex) {
            let newSex = $("#sexControl").val()
            argsJson.sex = newSex
            changedSex = false;
            sex = newSex
        }
        if (changedCity) {
            let newCity = $("#cityControl").children("option:selected").val()
            argsJson.idcity = newCity
            changedCity = false;
            city = newCity
        }
        if (changedDescription) {
            let newDescription = $("#description").val();
            argsJson.description = newDescription
            changedDescription = false;
            description = newDescription
        }

        if (!jQuery.isEmptyObject(argsJson)) {
            $.post("/ajax.php?entity=user&action=editInfo", argsJson)
                .fail(function (e) {
                    console.log("fail", e)
                })
                .done(function (e) {
                    let data = JSON.parse(e)
                    if (data.status == 'success') {
                        console.log(data.success[0])
                    }
                })
        }
        //AJAX 

    })

    $("#lastname").change(function () {
        changedFirstName = firstName != this.value;
    })

    $("#firstname").change(function () {
        changedLastName = lastName != this.value;
    })

    $("#birthday").change(function () {
        changedBirthday = birthday != this.value;
    })

    $("#sexControl").change(function () {
        changedSex = sex != this.value;
    })

    $("#cityControl").change(function () {
        changedCity = city != $(this).children("option:selected").val();
    })

    $("#description").change(function () {
        changedDescription = description != this.value;
    })

    $(".nav-link").click(function (e) {
        let content = $(this).attr('targetIDContent');
        $(".nav-link").removeClass('active activeNav');
        $(this).addClass('active activeNav');
        $(".navContent").css('display', 'none');
        $('#' + content).css('display', 'contents');
    })


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
                let data = JSON.parse(e)
                console.log(data)
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
            success: function (e) {
                let data = JSON.parse(e)
                if (data.status == 'success') {
                    $(".containerEmptyPhoto").first().find('.containerSpinner').removeClass('invisible')
                    $(".containerEmptyPhoto").first().find('.containerBtnAddPhoto').addClass('invisible')
                    setTimeout(function () {
                        $("#uploadInput").val('')
                        addPhoto(data.data[0])
                    }, 1000);
                }
            },
            error: function (e) {
            }
        });
    })

    function addPhoto($url) {
        $(".containerEmptyPhoto").first().empty()
        $(".containerEmptyPhoto").first().append('<img src="' + $url + '"><div class="overlay"></div><div class="btnGroupPhoto"><div class="containerBtnPhoto"><button class="btn btn-primary"><i class="fas fa-expand"></i></button></div><div class="containerBtnPhoto delete"><button class="btn btnTrash"><i class="fa fa-trash"></i></button></div></div>');
        $(".containerEmptyPhoto").first().removeClass('containerEmptyPhoto');
    }
})

