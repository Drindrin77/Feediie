$(document).ready(function () {
    $("#btnConfirm").click(function () {
        let message = $("#textIdea").val();
        if (!message.trim()) {
            $("#alerteMsgError").removeClass("invisible");
            $("#alerteMsgError").html("Le message ne doit pas être vide")
        }
        else {
            $("#textIdea").val("");
            $("#alerteMsgError").addClass("invisible");
            $("#modalIdea").modal('hide')

            $.post("/ajax.php?entity=idea&action=add",
                {
                    message: message
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
        }
    })

})