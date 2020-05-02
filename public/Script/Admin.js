$("#photoAddPersonality").click(function (e) {
    $("#uploadInput").click();
})

let stockExtension = '';
let stockBase64Img = '';

$("#resetAddPersonality").click(function (e) {
    resetPersonality()
})
function resetPersonality() {
    stockBase64Img = '';
    stockExtension = '';
    $("#containerImgUploadPersonality").empty();
    $("#textAddPersonality").val('');
    $("#uploadInput").val('')
    $("#errorAddPersonality").html("");
}

$("#submitAddPersonality").click(function (e) {
    let name = $("#textAddPersonality").val();
    if (name.trim() && stockBase64Img != '' && stockExtension != '') {
        $.post("/ajax.php?entity=personality&action=addPersonality",
            {
                'name': name,
                'base64Img': stockBase64Img,
                'ext': stockExtension
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == "success") {
                    resetPersonality()
                    addPersonality(name, data.data.url, data.data.id);
                    $("#messageSuccess").html("Ajout de personnalité réussi")
                    $('#containerMessageSuccess').show(200).delay(2000).hide(200)
                } else {
                    $("#errorAddPersonality").html(data.error[0]);
                }

            })
    } else {
        $("#errorAddPersonality").html("Le nom et le fichier ne doit pas être vide");
    }
})

function addPersonality(name, url, id) {
    $("#containerCardPersonality").append('<div class="card cardElement"><div class="cardImage"><img src="' + url + '" class= "card-img-top image" alt = "..." ></div ><div class="overlay"></div><div class="containerBtnOverlay containerDeleteBtn"><button data-id=' + id + ' class="btn btnDelete deletePersonality"><i class="fa fa-trash"></i> Supprimer</button></div ><div class="card-header titleCard">' + name + '</div></div > ')
}
//TODO GESTION SAME FILE
//TODO ALREADY TAKEN NAME


$("#uploadInput").change(function (e) {
    var file_data = $('#uploadInput').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);

    $.ajax({
        url: "/ajax.php?entity=photo&action=getTemporaryPhoto",
        type: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (e) {
            let data = JSON.parse(e)
            if (data.status == 'success') {
                console.log(data.data)
                var image = new Image();
                image.src = data.data.imgSrc
                image.className = "image"
                $("#containerImgUploadPersonality").append(image)
                stockExtension = data.data.extension
                stockBase64Img = data.data.imgSrc
            }
        },
        error: function (e) {
        }
    });
})









$(".dropdown-menu .stayOpenDropDownItem").click(function (e) {
    e.stopPropagation();
})

$("#submitAddSex").click(function (e) {
    let name = $("#textAddSex").val()
    if (name.trim()) {
        $.post("/ajax.php?entity=sex&action=addSex",
            {
                'name': name,
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == "success") {
                    $("#tableBodySex").append('<tr data-id=' + name + '><td>' + name + '</td><td><button class="btn btn-danger deleteSex">Supprimer</button></td></tr>');
                    $("#textAddSex").val("")
                    $("#messageSuccess").html("Ajout de relation réussi")
                    $('#containerMessageSuccess').show(200).delay(2000).hide(200)
                    $("#errorAddSex").html("");
                } else {
                    $("#errorAddSex").html(data.error[0]);
                }

            })
    } else {
        $("#errorAddSex").html("Le nom ne doit pas être vide");
    }
})


$("#submitAddDiet").click(function (e) {
    let name = $("#textAddDiet").val()
    if (name.trim()) {
        $.post("/ajax.php?entity=diet&action=addDiet",
            {
                'name': name,
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == "success") {
                    $("#tableBodyDiet").append('<tr data-id=' + data.data.id + '><td>' + name + '</td><td><button class="btn btn-danger deleteSex">Supprimer</button></td></tr>');
                    $("#textAddDiet").val("")
                    $("#messageSuccess").html("Ajout de relation réussi")
                    $('#containerMessageSuccess').show(200).delay(2000).hide(200)
                    $("#errorAddDiet").html("");
                } else {
                    $("#errorAddDiet").html(data.error[0]);
                }

            })
    } else {
        $("#errorAddDiet").html("Le nom ne doit pas être vide");
    }
})


$("#submitAddHobby").click(function (e) {

    let name = $("#textAddHobby").val()
    console.log(name)
    if (name.trim()) {
        $.post("/ajax.php?entity=hobby&action=addHobby",
            {
                'name': name,
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == "success") {
                    $("#bodyHobby").append('<div data-id=' + data.data.id + ' class="containerHobby deletehobby"><i class="fas fa-ban deleteHobbyIcon" ></i > <span>' + name + '</span></div >')
                    $("#textAddHobby").val("")
                    $("#messageSuccess").html("Ajout de relation réussi")
                    $('#containerMessageSuccess').show(200).delay(2000).hide(200)
                    $("#errorAddHobby").html("");
                } else {
                    $("#errorAddHobby").html(data.error[0]);
                }

            })
    } else {
        $("#errorAddHobby").html("Le nom ne doit pas être vide");
    }
})


$("#submitAddRelation").click(function (e) {
    let name = $("#textAddRelation").val()
    if (name.trim()) {
        $.post("/ajax.php?entity=relation&action=addRelation",
            {
                'name': name,
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == "success") {
                    $("#tableBodyRelation").append('<tr data-id=' + data.data.id + '><td>' + name + '</td><td><button class="btn btn-danger deleteRelation">Supprimer</button></td></tr>');
                    $("#textAddRelation").val("")
                    $("#messageSuccess").html("Ajout de relation réussi")
                    $("#errorAddRelation").html("");
                    $('#containerMessageSuccess').show(200).delay(2000).hide(200)
                } else {
                    $("#errorAddRelation").html(data.error[0]);
                }

            })
    } else {
        $("#errorAddRelation").html("Le nom ne doit pas être vide");
    }
})

$(document).on("click", ".deletehobby", function (event) {
    let parent = $(this);
    let idHobby = $(this).attr('data-id')

    $.post("/ajax.php?entity=hobby&action=deleteHobby",
        {
            'idHobby': idHobby,
        })
        .fail(function (e) {
            console.log("fail", e)
        })
        .done(function (e) {
            let data = JSON.parse(e)
            console.log(data)
            if (data.status == "success") {
                parent.remove();
            }

        })
})


$(document).on("click", ".deleteDish", function (event) {
    let parent = $(this).parent().parent();
    let idDish = $(this).attr('data-id')

    $.post("/ajax.php?entity=dish&action=deleteDish",
        {
            'idDish': idDish,
        })
        .fail(function (e) {
            console.log("fail", e)
        })
        .done(function (e) {
            let data = JSON.parse(e)
            console.log(data)
            if (data.status == "success") {
                parent.remove();
            }

        })
})

$(document).on("click", ".deletePersonality", function (event) {
    let parent = $(this).parent().parent();
    let idDish = $(this).attr('data-id')

    console.log(idDish)

    $.post("/ajax.php?entity=personality&action=deletePersonality",
        {
            'idDish': idDish,
        })
        .fail(function (e) {
            console.log("fail", e)
        })
        .done(function (e) {
            let data = JSON.parse(e)
            console.log(data)
            if (data.status == "success") {
                parent.remove();
            }

        })
})

$(document).on("click", ".deleteDiet", function (event) {
    let parent = $(this).parent().parent();
    let idDiet = parent.attr('data-id')

    $.post("/ajax.php?entity=diet&action=deleteDiet",
        {
            'idDiet': idDiet,
        })
        .fail(function (e) {
            console.log("fail", e)
        })
        .done(function (e) {
            let data = JSON.parse(e)
            console.log(data)
            if (data.status == "success") {
                parent.remove();
            }

        })
})

$(document).on("click", ".deleteCity", function (event) {
    let parent = $(this).parent().parent();
    let idCity = parent.attr('data-id')

    $.post("/ajax.php?entity=city&action=deleteCity",
        {
            'idCity': idCity,
        })
        .fail(function (e) {
            console.log("fail", e)
        })
        .done(function (e) {
            let data = JSON.parse(e)
            console.log(data)
            if (data.status == "success") {
                parent.remove();
            }

        })
})

$(".modifyAdmin").click(function (e) {
    let text = $(this).text().trim()
    let button = $(this)
    action = text == 'Promouvoir' ? 'setAdmin' : 'removeAdmin';
    let idUser = $(this).parent().parent().attr('data-id')

    $.post("/ajax.php?entity=user&action=" + action,
        {
            'idUser': idUser,
        })
        .fail(function (e) {
            console.log("fail", e)
        })
        .done(function (e) {
            let data = JSON.parse(e)
            console.log(data)
            if (data.status == "success") {
                button.html(text == 'Promouvoir' ? "Destituer" : "Promouvoir")
            }

        })
})


$(document).on("click", ".deleteSex", function (event) {
    let parent = $(this).parent().parent();
    let sex = parent.attr("data-id")

    $.post("/ajax.php?entity=sex&action=delete",
        {
            'sex': sex,
        })
        .fail(function (e) {
            console.log("fail", e)
        })
        .done(function (e) {
            let data = JSON.parse(e)
            if (data.status == "success") {
                parent.remove();
            }
        })
})

$(document).on("click", ".deleteRelation", function (event) {
    let parent = $(this).parent().parent();
    let id = parent.attr("data-id")

    $.post("/ajax.php?entity=relation&action=deleteRelation",
        {
            'id': id,
        })
        .fail(function (e) {
            console.log("fail", e)
        })
        .done(function (e) {
            let data = JSON.parse(e)
            if (data.status == "success") {
                parent.remove();
            }
        })
})

$(document).on("click", ".deleteIdea", function (event) {
    let parent = $(this).parent();
    let id = parent.attr("data-id")

    $.post("/ajax.php?entity=idea&action=delete",
        {
            'id': id,
        })
        .fail(function (e) {
            console.log("fail", e)
        })
        .done(function (e) {
            let data = JSON.parse(e)
            if (data.status == "success") {
                parent.remove();
            }
        })
})

$(".deleteUser").click(function (e) {
    let parent = $(this).parent().parent();
    let id = parent.attr("data-id")
    console.log(id)
    $.post("/ajax.php?entity=user&action=delete",
        {
            'id': id,
        })
        .fail(function (e) {
            console.log("fail", e)
        })
        .done(function (e) {
            let data = JSON.parse(e)
            if (data.status == "success") {
                parent.remove();
            }
        })
})

$(".nav-link").click(function (e) {
    let content = $(this).attr('targetIDContent');
    $(".nav-link").removeClass('active activeNav');
    $(this).addClass('active activeNav');
    $(".navContent").addClass('invisible');
    $('#' + content).removeClass('invisible');
})
