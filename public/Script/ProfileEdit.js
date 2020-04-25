$(document).ready(function () {
    let confirmModification = false;
    let changedFirstName = false;
    let changedBirthday = false;
    let changedSex = false;
    let changedCity = false;
    let changedDescription = false;
    let firstName = $("#firstname").val()
    let birthday = $("#birthday").val()
    let sex = $("#sexControl").val()
    let city = $("#cityControl").children("option:selected").val()
    let description = $("#description").val()

    // $j is now an alias to the jQuery function; creating the new alias is optional.

    $('[data-toggle="popover"]').popover()

    $("#btnOpenModalResetPassword").click(function () {
        $('#modalResetPassword').modal()
    })

    $(document).on("click", ".deletePersonality", function (event) {
        let iddish = $(this).attr('data-iddish')
        let name = $(this).attr('data-name')
        let url = $(this).attr('data-url')
        $(this).parent().parent().remove()

        $.post("/ajax.php?entity=dish&action=deletePersonality",
            {
                idDish: iddish
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == 'success') {
                    deletePersonality(name, iddish, url)
                }
            })
    })

    $(document).on("click", ".addPersonality", function (event) {
        let iddish = $(this).attr('data-iddish')
        let name = $(this).attr('data-name')
        let url = $(this).attr('data-url')

        $(this).parent().parent().remove()

        $.post("/ajax.php?entity=dish&action=addPersonality",
            {
                idDish: iddish
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == 'success') {
                    addPersonality(name, iddish, url)
                }
            })
    })


    function addPersonality(name, id, url) {
        $("#containerUsedPersonality").append('<div class="card cardPersonality"><div class="cardImage"><img src=' + url + ' class="card-img-top image"></div><div class="overlay"></div><div class="containerBtnOverlay containerDeleteBtn"><button data-url=' + url + ' data-name=' + name + '  data-iddish=' + id + ' class="btn btnDelete deletePersonality"><i class="fa fa-trash"></i> Supprimer</button></div><div class="card-header titleCard">' + name + '</div></div>')
    }

    function deletePersonality(name, id, url) {
        $("#containerUnusedPersonality").append('<div class="card cardPersonality"><div class="cardImage"><img src=' + url + ' class="card-img-top image"></div><div class="overlay"></div><div class="containerBtnOverlay containerAddBtn"><button data-url=' + url + ' data-name=' + name + '  data-iddish=' + id + ' class="btn btnAdd addPersonality"><i class="fa fa-trash"></i> Ajouter</button></div><div class="card-header titleCard">' + name + '</div></div>')
    }

    function addFavorite(name, id, url) {
        $("#containerUsedDish").append('<div class= "card cardPersonality"><div class="cardImage"><img src=' + url + ' class="card-img-top image"></div><div class="overlay"></div><div class="containerBtnOverlay containerDeleteBtn"><button data-url=' + url + ' data-name=' + name + ' data-iddish=' + id + ' class="btn btnDelete deleteDish"><i class="fa fa-trash"></i> Supprimer</button></div><div class="card-header titleCard">' + name + '</div></div>');
    }

    function deleteFavorite(name, id, url) {
        $("#containerUnusedDish").append('<div class= "card cardPersonality" > <div class="cardImage"><img src=' + url + ' class="card-img-top image"></div><div class="overlay"></div><div class="containerBtnOverlay containerAddBtn"><button data-url=' + url + ' data-name=' + name + ' data-iddish=' + id + ' class="btn btnAdd addDish"><i class="fa fa-plus"></i> Ajouter</button></div><div class="card-header titleCard">' + name + '</div></div>')
    }

    $(document).on("click", ".deleteDish", function (event) {
        let iddish = $(this).attr('data-iddish')
        let name = $(this).attr('data-name')
        let url = $(this).attr('data-url')

        $(this).parent().parent().remove()
        $.post("/ajax.php?entity=dish&action=deleteFavorite",
            {
                idDish: iddish
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == 'success') {
                    deleteFavorite(name, iddish, url)
                }
            })

    })

    $(document).on("click", ".addDish", function (event) {
        let iddish = $(this).attr('data-iddish')
        let name = $(this).attr('data-name')
        let url = $(this).attr('data-url')

        $(this).parent().parent().remove()

        $.post("/ajax.php?entity=dish&action=addFavorite",
            {
                idDish: iddish
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                //                let data = JSON.parse(e)
                console.log(e)
                addFavorite(name, iddish, url)
            })

    })

    function atLeastOneChange() {
        return changedFirstName || changedBirthday || changedSex || changedCity || changedDescription
    }

    $(document).on("click", ".hobbiesUnpracticed", function (event) {
        let id = $(this).attr('id')
        let name = $(this).children().last().text()
        $(this).remove()
        addPracticeHobby(name, id)

        $.post("/ajax.php?entity=hobby&action=add",
            {
                idHobby: id
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == 'success') {
                    console.log(data.success[0])
                }
            })
    })

    $(document).on("click", ".practicedHobby", function (event) {
        let id = $(this).attr('id')
        let name = $(this).children().last().text()
        $(this).remove()
        addUnpracticedHobby(name, id)
        $.post("/ajax.php?entity=hobby&action=remove",
            {
                idHobby: id
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == 'success') {
                    console.log(data.success[0])
                }
            })

    })

    function addPracticeHobby(name, id) {
        $("#containerPracticedHobby").append('<div class="containerHobby practicedHobby" id=' + id + '><i class="fas fa-ban deleteHobbyIcon"></i><span> ' + name + '</span></div>')
    }

    function addUnpracticedHobby(name, id) {
        $("#containerUnpracticedHobby").append('<div id=' + id + ' class="containerHobby hobbiesUnpracticed"><i class="fas fa-plus addHobbyIcon"></i><span> ' + name + '</span></div>')
    }

    $("#btnViewProfile").click(function () {
        if (!confirmModification) {
            if (atLeastOneChange()) {
                $('#modalConfirm').modal()

                if (changedFirstName) {
                    $("#firstname").addClass("errorValue")
                }
                if (changedBirthday) {
                    $("#birthday").addClass("errorValue")
                }
                if (changedSex) {
                    $("#sexControl").addClass("errorValue")
                }
                if (changedCity) {
                    $("#cityControl").addClass("errorValue")
                }
                if (changedDescription) {
                    $("#description").addClass("errorValue")
                }

            } else {
                window.location.replace("/profile/" + $(this).attr('uniqID'));
            }
        } else {
            window.location.replace("/profile/" + $(this).attr('uniqID'));
        }

    })

    let openPopOverPersonality = false;

    $("#btnPersonalityPopOver").click(function () {
        openPopOverPersonality = !openPopOverPersonality;
        if (openPopOverPersonality) {
            $("#containerUnusedPersonality").removeClass("invisible")
        } else {
            $("#containerUnusedPersonality").addClass("invisible")
        }
    })

    let openPopOverHobby = false;
    $("#btnHobbyPopOver").click(function () {
        openPopOverHobby = !openPopOverHobby;
        if (openPopOverHobby) {
            $("#containerUnpracticedHobby").removeClass("invisible")
        } else {
            $("#containerUnpracticedHobby").addClass("invisible")
        }
    })

    let openPopOverDish = false;
    $("#btnDishPopOver").click(function () {
        openPopOverDish = !openPopOverDish;
        if (openPopOverDish) {
            $("#containerUnusedDish").removeClass("invisible")
        } else {
            $("#containerUnusedDish").addClass("invisible")
        }
    })


    $("#submitInfo").click(function () {
        confirmModification = true;
        let argsJson = {};

        if (changedFirstName) {
            let newFirstName = $("#firstname").val()
            $("#firstname").removeClass("errorValue")
            argsJson.firstname = newFirstName
            changedFirstName = false;
            firstName = newFirstName
        }
        if (changedBirthday) {
            let newBirthday = $("#birthday").val()
            $("#birthday").removeClass("errorValue")
            argsJson.changedBirthday = newBirthday
            changedBirthday = false;
            birthday = newBirthday
        }
        if (changedSex) {
            let newSex = $("#sexControl").val()
            argsJson.sex = newSex
            changedSex = false;
            sex = newSex
            $("#sexControl").removeClass("errorValue")
        }
        if (changedCity) {
            let newCity = $("#cityControl").children("option:selected").val()
            argsJson.idcity = newCity
            changedCity = false;
            city = newCity
            $("#cityControl").removeClass("errorValue")
        }
        if (changedDescription) {
            let newDescription = $("#description").val();
            argsJson.description = newDescription
            changedDescription = false;
            description = newDescription
            $("#description").removeClass("errorValue")
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
    })

    $("#firstname").change(function () {
        changedFirstName = firstName != this.value;
        $("#firstname").removeClass("errorValue")
    })

    $("#birthday").change(function () {
        changedBirthday = birthday != this.value;
        $("#birthday").removeClass("errorValue")
    })

    $("#sexControl").change(function () {
        changedSex = sex != this.value;
        $("#sexControl").removeClass("errorValue")
    })

    $("#cityControl").change(function () {
        changedCity = city != $(this).children("option:selected").val();
        $("#cityControl").removeClass("errorValue")
    })

    $("#description").change(function () {
        changedDescription = description != this.value;
        $("#cityControl").removeClass("errorValue")
    })

    $(".nav-link").click(function (e) {
        let content = $(this).attr('targetIDContent');
        $(".nav-link").removeClass('active activeNav');
        $(this).addClass('active activeNav');
        $(".navContent").css('display', 'none');
        $('#' + content).css('display', 'contents');
    })


    $(document).on("click", ".containerPriority[data-priority=false]", function (evt) {
        let url = $(this).parent().find("img").attr('src')
        $.post("/ajax.php?entity=photo&action=setPriority",
            {
                'url': url,
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                console.log(data)
                if (data.status == 'success') {
                    setPriorityByURL(url)
                }
            })

    })


    $(document).on("click", ".delete", function (evt) {
        let url = $(this).parent().parent().find("img").attr('src');
        let priority = $(this).parent().parent().find("img").attr('priority');
        let parent = $(this).parent().parent()
        $.post("/ajax.php?entity=photo&action=delete",
            {
                'url': url,
                'priority': priority == 'true' ? true : false
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                console.log(data)
                if (data.status == 'success') {
                    parent.remove();
                    addEmptyPhoto()
                    if (data.data.newPriorityUrl) {
                        setPriorityByURL(data.data.newPriorityUrl)
                    }
                }
            })
    });

    function setPriorityByURL(url) {
        let img = $('#containerPhotos img[src="' + url + '"]')
        img.attr("priority", "true")
        $(".containerPriority[data-priority=true]").attr("data-priority", "false")
        img.parent().find('.containerPriority').attr("data-priority", "true")
    }

    $(document).on("click", ".btnAddPhoto", function (evt) {
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
                    $("#alerteMsgErrorUpload").addClass("invisible")
                    $("#uploadInput").val('')
                    setTimeout(function () {
                        let url = data.data.url
                        let priority = data.data.priority
                        addPhoto(url, priority)
                    }, 1000);
                } else {
                    $("#alerteMsgErrorUpload").removeClass("invisible")
                    let contentsError = ""
                    $.each(data.error, function (key, value) {
                        contentsError += value + "\n"
                    })
                    $("#alerteMsgErrorUpload").html(contentsError)
                }
            },
            error: function (e) {
            }
        });
    })

    function addEmptyPhoto() {

        let target = $(".containerNotEmptyPhoto").last()
        if (target.length == 0) {
            target = $(".containerEmptyPhoto").first()
        }
        let content = '<div class="containerPhoto containerEmptyPhoto"><div class="emptyPhoto"></div><div class="containerSpinner invisible spinner-border text-primary" role = "status"></div><div class="containerBtnAddPhoto"><button class="btn btn-primary btnAddPhoto"><i class="fas fa-plus"></i> Ajouter une photo</button></div></div>';
        $(content).insertAfter(target)
    }

    function addPhoto(url, priority) {
        $(".containerEmptyPhoto").first().empty()
        $(".containerEmptyPhoto").first().append('<img class="image" priority="' + priority + '" src="' + url + '"><div class="containerPriority" data-priority="' + priority + '"><i class= "fa fa-star"></i></div > <div class="overlay"></div> <div class="btnGroupPhoto"><div class="containerBtnPhoto"><button class="btn btn-primary"><i class="fas fa-expand"></i></button></div><div class="containerBtnPhoto delete"><button class="btn btnTrash"><i class="fa fa-trash"></i></button></div></div>');
        $(".containerEmptyPhoto").first().addClass('containerNotEmptyPhoto');
        $(".containerEmptyPhoto").first().removeClass('containerEmptyPhoto');
    }

    $("#oldPassword").on('input', function () {
        $("#oldPassword").removeClass('errorValue')
        $("#errorOldPassword").addClass('invisible')
    })
    $("#newPassword").on('input', function () {
        $("#newPassword").removeClass('errorValue')
        $("#errorNewPassword").addClass('invisible')
    })
    $("#confirmPassword").on('input', function () {
        $("#confirmPassword").removeClass('errorValue')
        $("#errorConfirmPassword").addClass('invisible')
    })

    $("#btnConfirmReset").click(function (e) {
        let oldPassword = $("#oldPassword").val()
        let newPassword = $("#newPassword").val()
        let confirmPassword = $("#confirmPassword").val()

        let isValid = true
        if (!oldPassword.trim()) {
            $("#oldPassword").addClass('errorValue')
            $("#errorOldPassword").removeClass('invisible')
            $("#errorOldPassword").html("Veuillez renseigner l'ancien mot de passe")
            isValid = false
        }
        if (!newPassword.trim()) {
            $("#newPassword").addClass('errorValue')
            $("#errorNewPassword").removeClass('invisible')
            $("#errorNewPassword").html("Veuillez renseigner le nouveau mot de passe")
            isValid = false
        }
        if (!confirmPassword.trim()) {
            $("#confirmPassword").addClass('errorValue')
            $("#errorConfirmPassword").removeClass('invisible')
            $("#errorConfirmPassword").html("Veuillez renseigner la confirmation du nouveau mot de passe")
            isValid = false
        }
        if (newPassword != confirmPassword) {
            $("#confirmPassword").addClass('errorValue')
            $("#newPassword").addClass('errorValue')
            $("#errorConfirmPassword").removeClass('invisible')
            $("#errorConfirmPassword").html("La confirmation doit etre identique au nouveau mot de passe")
            isValid = false
        }

        if (isValid) {
            if (newPassword == oldPassword) {
                $("#oldPassword").addClass('errorValue')
                $("#newPassword").addClass('errorValue')
                $("#errorNewPassword").removeClass('invisible')
                $("#errorNewPassword").html("Le nouveau mot de passe ne doit pas etre identique a l'ancien")
            } else {

                $.post("/ajax.php?entity=user&action=resetpassword",
                    {
                        'oldPassword': oldPassword,
                        'newPassword': newPassword
                    })
                    .fail(function (e) {
                        console.log("fail", e)
                    })
                    .done(function (e) {
                        let data = JSON.parse(e)
                        if (data.status == "success") {

                        } else {
                            $("#oldPassword").addClass('errorValue')
                            $("#errorOldPassword").removeClass('invisible')
                            $("#errorOldPassword").html("L'ancien mot de passe est incorrect")
                        }
                    })

            }
        }

    })


})

