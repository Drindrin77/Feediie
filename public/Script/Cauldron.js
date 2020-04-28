function spaceBelow2Div(divA, divB) {
    const firstDiv = $(divA).offset();
    const secondDiv = $(divB).offset();
    return secondDiv.top - firstDiv.top;
}

function setMatchedUserContainerHeight() {
    const height = spaceBelow2Div("#pageContainer", "#footer");
    $("#matchedUserContainer").height(height);
}

function setChatBoxSize() {
    let height = spaceBelow2Div("#pageContainer", "#footer");
    height -= $("#userMessageArea").height() + $("#chatSelectedContact").height();
    $("#chatBox").height(height);
}

$(document).ready(function () {
    setMatchedUserContainerHeight();
    setChatBoxSize();
});

$(window).resize(function () {
    setMatchedUserContainerHeight();
    setChatBoxSize();
});

//selectionne un utilisateur dans la liste des matchs
$("#matchedUserContainer").on("click", ".matchedUser", function (event) {
    const uniqId = $(event.currentTarget).attr("data-uniqid");
    const photo = $("#photo-" + uniqId).attr("src");
    const photoDesciption = $("#photo-" + uniqId).attr("alt");
    const name = $("#name-" + uniqId).text();

    $(".selectedMatchedUser").addClass("matchedUser");
    $(".selectedMatchedUser").removeClass("selectedMatchedUser");

    $("#user-" + uniqId).addClass("selectedMatchedUser")
    $("#user-" + uniqId).removeClass("matchedUser")

    $("#chatSelectedContact").attr("data-uniqid", uniqId);
    $("#chatSelectedContact").attr("href", "/profile/" + uniqId);
    $("#selectedContactPhoto").attr("src", photo);
    $("#selectedContactPhoto").attr("alt", photoDesciption);
    $("#selectedContactName").text(name);

    setChatBoxSize(); //TODO enlever dès que les images sont de taille fixe
    changeChatBoxContent(uniqId);
});

function changeChatBoxContent(uniqId) {
    $("#messageListContainer").empty();
    fetchMessages(uniqId, 0);

}


function fetchMessages(uniqId, offset) {
    $.post("/ajax.php?entity=chat&action=fetchMessages",
        {
            "contactUniqId": uniqId,
            "offset": offset
        }, "json")
        .fail(function (e) {
            console.log("fail", e)
        })
        .done(function (e) {
            const jsonResponse = JSON.parse(e);
            console.log(jsonResponse);
            fillChatBox(jsonResponse.data.messageList, jsonResponse.data.userPhoto, uniqId);//TODO faire en sorte d'attendre la réponse pour enlever la responsabiliter
        });
}

function fillChatBox(messageList, userPhoto, contactUniqId) {
    for (let i = messageList.length - 1; i >= 0; i--) {
        console.log(createMessageDiv(messageList[i].message, userPhoto, true));
        let isCurrentUser = contactUniqId !== messageList[i].uniqid;
        $("#messageListContainer").append(createMessageDiv(messageList[i].message, userPhoto, isCurrentUser));
    }
}

function createMessageDiv(messageText, userPhoto, isCurrentUser) {
    let messageDiv;

    if (isCurrentUser) {
        messageDiv = $([
            "<div class='messageContainer row'>",
            "   <div class='userMessage col-9 offset-2'>",
            "       " + messageText,
            "   </div>",
            "   <img class='col-1' src='" + userPhoto + "'>",
            "</div>"
        ].join("\n"));
    } else {
        const contactPhoto = $("#selectedContactPhoto").attr("src");
        messageDiv = $([
            "<div class='messageContainer row'>",
            "   <img class='col-1' src='" + contactPhoto + "'>",
            "   <div class='contactMessage col-9'>",
            "       " + messageText,
            "   </div>",
            "</div>"
        ].join("\n"));
    }
    // console.log(messageDiv[0]);
    //console.log($("#messageListContainer"));


    return messageDiv;
}