$(".photoAddCard").click(function (e) {
    let content = $(this).data('content');
    $('.uploadInput[data-content=' + content + ']').click();
})

$("#searchUser").on('input', function (e) {
    let name = $(this).val();
    filterUser(name)
})

jQuery.expr[':'].regex = function (elem, index, match) {
    var matchParams = match[3].split(','),
        validLabels = /^(data|css):/,
        attr = {
            method: matchParams[0].match(validLabels) ?
                matchParams[0].split(':')[0] : 'attr',
            property: matchParams.shift().replace(validLabels, '')
        },
        regexFlags = 'ig',
        regex = new RegExp(matchParams.join('').replace(/^\s+|\s+$/g, ''), regexFlags);
    return regex.test(jQuery(elem)[attr.method](attr.property));
}

function filterUser(name) {
    $('.contentUserTable').attr('data-hidden', 'true')
    $('.contentUserTable:regex(data-email, .*' + name + '.*)').attr('data-hidden', 'false')
}


function triggerPopOver(target) {
    let hidden = $("#" + target).attr("data-hidden")
    hidden = hidden == 'false' ? 'true' : 'false'
    $("#" + target).attr("data-hidden", hidden)
}

$(".resetAddCard").click(function (e) {
    let content = $(this).data('content')
    resetCard(content)
})
function resetCard(content) {
    $("#containerImgUpload" + content).empty();
    $("#textAdd" + content).val('');
    $('.uploadInput[data-content=' + content + ']').val('')
    $("#errorAdd" + content).html("");
}

$("#submitAddRelation").click(function (e) {
    let uploadInput = $('.uploadInput[data-content="Relation"]');
    let name = $("#nameAddRelation").val();
    let description = $("#descriptionAddRelation").val()
    let container = $("#containerImgUploadRelation")

    if (name.trim() != '' && description != '' && uploadInput.val() != '') {
        $.post('/ajax.php?entity=relation&action=addRelation',
            {
                'name': name,
                'description': description,
                'base64Img': container.find("img").attr("src"),
                'ext': container.data("extension")
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == "success") {
                    let id = data.data.id
                    let url = data.data.url

                    $("#containerImgUploadRelation").empty();
                    $("#nameAddRelation").val('');
                    $("#descriptionAddRelation").val('');
                    $('.uploadInput[data-content="Relation"]').val('')
                    $("#errorAddRelation").html("");
                    $("#tdAddRelation").after('<tr class="relationTr" data-id=' + id + '><td><div class="containerImgRelation"><img class="image" src="' + url + '" /></div></td ><td><b>' + name + '</b></td><td>' + description + '</td><td><button class="btn btn-danger deleteRelation">Supprimer</button></td></tr > ')

                    $("#messageSuccess").html("Ajout de relation réussi")
                    $('#containerMessageSuccess').show(200).delay(2000).hide(200)
                } else {
                    $("#errorAddRelation").html(data.error[0]);
                }
            })
    } else {
        $("#errorAddRelation").html("Le nom, la description et le fichier ne doivent pas être vide");
    }


})

$("#submitAddCity").click(function (e) {
    let name = $("#textAddCity").val()
    let zipcode = $("#textAddZipCode").val()

    if (name.trim() && zipcode.trim()) {
        $.post("/ajax.php?entity=city&action=addCity",
            {
                'name': name,
                'zipcode': zipcode
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == "success") {
                    $("#tableBodyCity").prepend('<tr data-id=' + data.data.id + '><td>' + name + '</td><td>' + zipcode + '</td><td><button class="btn btn-danger deleteCity">Supprimer</button></td></tr > ');
                    $("#textAddCity").val("")
                    $("#textAddZipCode").val("")
                    $("#messageSuccess").html("Ajout de ville réussi")
                    $("#errorAddCity").html("");
                    $('#containerMessageSuccess').show(200).delay(2000).hide(200)
                } else {
                    $("#errorAddCity").html(data.error[0]);
                }
            })
    } else {
        $("#errorAddCity").html("Le nom et le code postal ne doivent pas être vide");
    }
})

$(".submitAddCard").click(function (e) {
    let content = $(this).data("content")
    let uploadInput = $('.uploadInput[data-content=' + content + ']');
    let name = $("#textAdd" + content).val();
    let container = $("#containerImgUpload" + content)

    if (name.trim() != '' && uploadInput.val() != '') {
        $.post('/ajax.php?entity=' + content + '&action=add' + content,
            {
                'name': name,
                'base64Img': container.find("img").attr("src"),
                'ext': container.data("extension")
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == "success") {
                    resetCard(content)
                    addCard(content, name, data.data.url, data.data.id);
                    $("#messageSuccess").html("Ajout de personnalité réussi")
                    $('#containerMessageSuccess').show(200).delay(2000).hide(200)
                } else {
                    $("#errorAdd" + content).html(data.error[0]);
                }
            })
    } else {
        $("#errorAdd" + content).html("Le nom et le fichier ne doit pas être vide");
    }
})

function addCard(content, name, url, id) {
    $("#containerCard" + content).prepend('<div class="card cardElement"><div class="cardImage"><img src="' + url + '" class= "card-img-top image" alt = "..." ></div ><div class="overlay"></div><div class="containerBtnOverlay containerDeleteBtn"><button data-content=' + content + ' data-id=' + id + ' class="btn btnDelete deleteCard"><i class="fa fa-trash"></i> Supprimer</button></div ><div class="card-header titleCard">' + name + '</div></div > ')
}

$(".uploadInput").change(function (e) {
    var file_data = $(this).prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    let content = $(this).data("content");
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
                var image = new Image();
                image.src = data.data.imgSrc
                image.className = "image"

                let container = $("#containerImgUpload" + content)
                container.empty()
                container.append(image)
                container.data('extension', data.data.extension)
            }
        },
        error: function (e) {
        }
    });
})

$(".dropdown-menu .stayOpenDropDownItem").click(function (e) {
    e.stopPropagation();
})

$(".submitAddTabOneElement").click(function () {
    let content = $(this).data("content")
    let name = $("#textAdd" + content).val()

    if (name.trim()) {
        $.post('/ajax.php?entity=' + content + '&action=add' + content,
            {
                'name': name,
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == "success") {
                    switch (content) {
                        case 'Hobby':
                            $("#bodyHobby").prepend('<div data-id=' + data.data.id + ' class="containerHobby deletehobby"><i class="fas fa-ban deleteHobbyIcon" ></i > <span>' + name + '</span></div >')
                            break;
                        case 'Sex':
                            $("#tableBody" + content).prepend('<tr data-id=' + name + '><td>' + name + '</td><td><button data-content=' + content + ' class="btn btn-danger deleteTabOneElement">Supprimer</button></td></tr>');
                            break;
                        default:
                            $("#tableBody" + content).prepend('<tr data-id=' + data.data.id + '><td>' + name + '</td><td><button data-content=' + content + ' class="btn btn-danger deleteTabOneElement">Supprimer</button></td></tr>');
                            break;
                    }

                    $("#textAdd" + content).val("")
                    $("#messageSuccess").html("Ajout de " + content + " réussi")
                    $('#containerMessageSuccess').show(200).delay(2000).hide(200)
                    $("#errorAdd" + content).html("");
                } else {
                    $("#errorAdd" + content).html(data.error[0]);
                }

            })
    } else {
        $("#errorAdd" + content).html("Le nom ne doit pas être vide");
    }
})

function addRelation(id, url, name, description) {
    $("#tableBodyRelation").prepend('<tr data-id=' + id + '><td class="containerImgRelation"><img class="image" src="' + url + '" /></td><td><b>' + name + '</b></td><td>' + description + '</td><td><button class="btn btn-danger deleteRelation">Supprimer</button></td></tr >')
}

$(document).on("click", ".deletehobby", function (event) {
    let parent = $(this);
    let idHobby = $(this).data('id')

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


$(document).on("click", ".deleteCard", function (event) {
    let parent = $(this).parent().parent();
    let content = $(this).data('content')
    let id = $(this).data('id')

    $.post('/ajax.php?entity=' + content + '&action=delete' + content,
        {
            'id': id,
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

$(document).on("click", ".deleteTabOneElement", function (event) {
    let parent = $(this).parent().parent();
    let id = parent.attr('data-id')
    let content = $(this).data('content')

    $.post('/ajax.php?entity=' + content + '&action=delete' + content,
        {
            'id': id,
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

$(".deleteUser").click(function (e) {
    e.stopPropagation()
    let parent = $(this).parent().parent();
    let id = parent.data('id')

    $.post("/ajax.php?entity=user&action=deleteUser",
        {
            'id': id,
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
    e.stopPropagation()
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

$(".nav-link").click(function (e) {
    let content = $(this).attr('targetIDContent');
    $(".nav-link").removeClass('active activeNav');
    $(this).addClass('active activeNav');
    $(".navContent").addClass('invisible');
    $('#' + content).removeClass('invisible');
})
