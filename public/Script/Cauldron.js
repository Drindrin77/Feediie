let matchedUserList = [];

$(window).load(function () {
    setMatchedUserContainerHeight();
    setChatBoxSize();
    scrollDownChatBox();
    matchedUserList = getActualMatchedUserList();
    setInterval(updateMatchAndMessages, 1000)
});

$(window).resize(function () {
    setMatchedUserContainerHeight();
    setChatBoxSize();
});

function getActualMatchedUserList() {
    return $.makeArray($(".selectedMatchedUser,.matchedUser").map(function () {
        return $(this).attr("data-uniqid");
    }));
}

function setMatchedUserContainerHeight() {
    const height = $("#pageContainer").height();
    $("#matchedUserContainer").height(height);
}

function setChatBoxSize() {
    let height = $("#pageContainer").height();
    height -= $("#userMessageArea").height() + $("#chatSelectedContact").height();
    $("#chatBox").height(height);
}

//selectionne un utilisateur dans la liste des matchs
$("#matchedUserContainer").on("click", ".matchedUser", function (event) {
    const uniqId = $(event.currentTarget).attr("data-uniqid");
    const photo = $("#photo-" + uniqId).attr("src");
    const photoDesciption = $("#photo-" + uniqId).attr("alt");
    const name = $("#name-" + uniqId).text();
    const matchDate = $(event.currentTarget).attr("data-matchDate");
    const age = $(event.currentTarget).attr("data-age");

    $(".selectedMatchedUser").addClass("matchedUser");
    $(".selectedMatchedUser").removeClass("selectedMatchedUser");

    $("#user-" + uniqId).addClass("selectedMatchedUser")
    $("#user-" + uniqId).removeClass("matchedUser")

    $("#chatSelectedContact").attr("data-uniqid", uniqId);
    $("#chatSelectedContact").attr("href", "/profile/" + uniqId);
    $("#selectedContactPhoto").attr("src", photo);
    $("#selectedContactPhoto").attr("alt", photoDesciption);
    $("#selectedContactName").text(name);
    $("#selectedContactMatchDate").text("Match le : " + matchDate);
    $("#selectedContactAge").text(age + " ans");

    changeChatBoxContent(uniqId);
});

function changeChatBoxContent(uniqId) {
    $("#messageListContainer").empty();
    fetchMessages(uniqId, 0);

}


function fetchMessages(contactUniqId, offset) {

    $.ajax({
        url: "/ajax.php?entity=chat&action=fetchMessages",
        type: "POST",
        dataType: 'json',
        timeout: 500,
        data: {
            "contactUniqId": contactUniqId,
            "offset": offset
        }
    }).done(function (data) {
        data = data.data;
        fillChatBox(data.messageList, data.userPhoto, contactUniqId);
    }).fail(function (e) {
        console.log("fail", e);
    });

}

function updateMatchAndMessages() {
    fetchUnreadMessages($("#chatSelectedContact").attr("data-uniqid"));
    fetchMatchList();
    fetchUnreadMessagesCount();
}

function fetchUnreadMessages(contactUniqId) {
    $.ajax({
        url: "/ajax.php?entity=chat&action=fetchUnreadMessages",
        type: "POST",
        dataType: 'json',
        timeout: 500,
        data: {
            "contactUniqId": contactUniqId
        }
    }).done(function (response) {
        let data = response.data;
        fillChatBox(data.messageList, null, contactUniqId);
    }).fail(function (e) {
        console.log("fail", e);
    });
}

function fillChatBox(messageList, userPhoto, contactUniqId) {
    let isScrollDown = $("#chatBox").scrollTop() == ($("#chatBox")[0].scrollHeight - $('#chatBox')[0].clientHeight);
    for (let i = messageList.length - 1; i >= 0; i--) {
        let isCurrentUser = contactUniqId !== messageList[i].uniqid;
        $("#messageListContainer").append(createMessageDiv(messageList[i].message, userPhoto, isCurrentUser));
    }
    if (isScrollDown) {
        scrollDownChatBox();
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
            "   <div class='col-1'>",
            "       <img class='chatImage' src='" + userPhoto + "'>",
            "   </div>",
            "</div>"
        ].join("\n"));
    } else {
        const contactPhoto = $("#selectedContactPhoto").attr("src");
        messageDiv = $([
            "<div class='messageContainer row'>",
            "   <div class='col-1'>",
            "       <img class='chatImage' src='" + contactPhoto + "'>",
            "   </div>",
            "   <div class='contactMessage col-9'>",
            "       " + messageText,
            "   </div>",
            "</div>"
        ].join("\n"));
    }
    return messageDiv;
}


function fetchMatchList() {
    $.ajax({
        url: "/ajax.php?entity=chat&action=fetchMatchList",
        type: "POST",
        dataType: 'json',
        timeout: 500
    }).done(function (response) {
        let data = response.data;
        fillMatchList(data.matchList);
    }).fail(function (e) {
        console.log("fail", e);
    });
}

function fillMatchList(matchList) {
    let isFirst = true
    let lastId;
    let nodeToInsert;
    const actualMatchedUserList = getActualMatchedUserList();
    let i = 0;

    matchList.forEach(function (matchedUser) {
        if (matchedUserList.includes((matchedUser.uniq_id))) {
            nodeToInsert = $("#user-" + matchedUser.uniq_id);

            if (matchedUser.unreadmessages != $("#notif-" + matchedUser.uniq_id + " > span").text()) {
                $("#notif-" + matchedUser.uniq_id + " > span").text(matchedUser.unreadmessages);
            }
            if ((matchedUser.unreadmessages === 0 && !$("#notif-" + matchedUser.uniq_id).hasClass("invisible"))
                || (matchedUser.unreadmessages !== 0 && !$("#notif-" + matchedUser.uniq_id).hasClass("visible"))) {
                $("#notif-" + matchedUser.uniq_id).toggleClass("invisible");
                $("#notif-" + matchedUser.uniq_id).toggleClass("visible");
            }

        } else {
            nodeToInsert = createMatchedUserDiv(matchedUser);
            matchedUserList.add(matchedUser.uniqId);
        }
        if(actualMatchedUserList[i] !== matchedUser.uniq_id) {

            if (isFirst) {
                $("#matchedUserList").prepend(nodeToInsert);
            } else {
                $(lastId).after(nodeToInsert);
            }
        }
        lastId = "#user-" + matchedUser.uniq_id;
        isFirst = false;
        i++;
    });

}

function createMatchedUserDiv(matchedUser) {

    return $([
        "<div id='user-" + matchedUser.uniq_id + "'" +
        " class='row matchedUser align-items-center'" +
        " data-uniqId='" + matchedUser.uniq_id + "'" +
        " data-matchDate='" + matchedUser.date_match + "'" +
        " data-age='" + matchedUser.age + "'>",
        "   <div class='col-3'>",
        "       <img id='photo-" + matchedUser.uniq_id + "'" +
        "           src='" + matchedUser.photo_url + "'" +
        "           alt='Photo de profil de " + matchedUser.name + "'>",
        "   </div>",
        "   <span id='name-" + matchedUser.uniq_id + "' class='col-7'>" + matchedUser.name +
        "   </span>",
        "   <div id='notif-" + matchedUser.uniq_id + "' class='col-2 invisible'>",
        "       <span class='matchNotification'>" + 0,
        "       </span>",
        "   </div>",
        "</div>"
    ].join("\n"));
}

$("#sendMessageButton").on("click", function () {
    const inputMessage = $("#inputMessage").val();
    if (inputMessage !== "") {
        const contactUniqId = $("#chatSelectedContact").attr("data-uniqid");

        $.ajax({
            url: "/ajax.php?entity=chat&action=sendMessage",
            type: "POST",
            dataType: 'json',
            timeout: 500,
            data: {
                "contactUniqId": contactUniqId,
                "inputMessage": inputMessage
            }
        }).done(function (data) {
            data = data.data;
            if (data.isInserted === true) {
                const message = {
                    "message": inputMessage,
                    "uniqId": "-1",// il s'agit d'avoir un uniq id différent de celui du contact pour être considéré comme user
                    "datemessage": "null" //TODO
                };
                data.messageList.unshift(message);
            }
            fillChatBox(data.messageList, data.userPhoto, contactUniqId);
            fetchMatchList();
        }).fail(function (e) {
            console.log("fail", e);
        });
        $("#inputMessage").val("");
    }
});

function scrollDownChatBox() {
    $("#chatBox").scrollTop($("#chatBox")[0].scrollHeight - $('#chatBox')[0].clientHeight);
}
