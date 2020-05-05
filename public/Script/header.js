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

    if (!$("#chatBox").length) {
        setInterval(fetchUnreadMessagesCount, 1000);
    }
})

function fetchUnreadMessagesCount() {
    $.ajax({
        url: "/ajax.php?entity=chat&action=getunreadmessagescount",
        type: "POST",
        dataType: 'json'
    }).done(function (response) {
        //console.log(response.data.unreadmessages);
        updateNotification(response.data.unreadmessages);
    }).fail(function (e) {
       // console.log("fail", e);
       // fetchUnreadMessagesCount();
    });
}

function updateNotification(count) {
    if (count != $("#nbNotif").text()) {
        $("#nbNotif").text(count);
        if ((count === 0 && $("#containerNotif").hasClass("visible"))
            || (count !== 0 && $("#containerNotif").hasClass("invisible"))) {
            $("#containerNotif").toggleClass("invisible");
            $("#containerNotif").toggleClass("visible");
        }
    }
}