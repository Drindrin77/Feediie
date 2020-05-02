$(".dropdown-menu .stayOpenDropDownItem").click(function (e) {
    e.stopPropagation();
})

$("#submitAddSex").click(function (e) {
    let name = $("#textAddSex")

    $.post("/ajax.php?entity=sex&action=addSex",
        {
            'name': name,
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


$("#submitAddDiet").click(function (e) {
    let name = $("#textAddDiet")

    $.post("/ajax.php?entity=diet&action=addDiet",
        {
            'name': name,
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


$("#submitAddHobby").click(function (e) {
    let name = $("#textAddHobby")

    $.post("/ajax.php?entity=hobby&action=addHobby",
        {
            'name': name,
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


$("#submitAddRelation").click(function (e) {
    let name = $("#textAddRelation").val()
    console.log(name)

    if (!name.trim()) {
        $.post("/ajax.php?entity=relation&action=addRelation",
            {
                'name': name,
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                console.log(data)
                if (data.status == "success") {
                    $("#tableBodyRealtion");
                }

            })
    }


})


$(".deletehobby").click(function (e) {
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

$(".deleteDish").click(function (e) {
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


$(".deletePersonality").click(function (e) {
    let parent = $(this).parent().parent();
    let idDish = $(this).attr('data-id')

    console.log(idDish)

    $.post("/ajax.php?entity=dish&action=deletePersonality",
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

$(".deleteDiet").click(function (e) {
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


$(".deleteCity").click(function (e) {
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
    let action = $(this).text().trim()
    action = action == 'Promouvoir' ? 'setAdmin' : 'removeAdmin';
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

            }

        })
})
$(".deleteSex").click(function (e) {
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

$(".deleteRelation").click(function (e) {
    let parent = $(this).parent().parent();
    let id = parent.attr("data-id")

    $.post("/ajax.php?entity=relation&action=delete",
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

$(".deleteIdea").click(function (e) {
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
