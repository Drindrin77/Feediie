$(".dropdown-menu .stayOpenDropDownItem").click(function (e) {
    e.stopPropagation();
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
