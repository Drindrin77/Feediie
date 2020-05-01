$(window).load(function () {
    setMatchedUserContainerHeight();
    setChatBoxSize();
    scrollDownChatBox();
    setInterval(updateMatchAndMessages, 1000)
});

$(window).resize(function () {
    setMatchedUserContainerHeight();
    setChatBoxSize();
});




function spaceBelow2Div(divA, divB) {
    const firstDiv = $(divA).offset();
    const secondDiv = $(divB).offset();
    return secondDiv.top - firstDiv.top;
}

function setMatchedUserContainerHeight() {
    const height = $("#pageContainer").height();//spaceBelow2Div("#pageContainer", "#footer");
    $("#matchedUserContainer").height(height);
}

function setChatBoxSize() {
    let height = $("#pageContainer").height()//spaceBelow2Div("#pageContainer", "#footer");
    height -= $("#userMessageArea").height() + $("#chatSelectedContact").height();
    $("#chatBox").height(height);
}

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
        },
        success: function (data) {
            data = data.data;
            fillChatBox(data.messageList, data.userPhoto, contactUniqId);
        },
        error: function (e) {
            console.log("fail", e);
        }
    });
}

function updateMatchAndMessages(){
    fetchUnreadMessages($("#chatSelectedContact").attr("data-uniqid"));
}
function fetchUnreadMessages(contactUniqId) {
    $.ajax({
        url: "/ajax.php?entity=chat&action=fetchUnreadMessages",
        type: "POST",
        dataType: 'json',
        timeout: 500,
        data: {
            "contactUniqId": contactUniqId
        },
        success: function (data) {
           // console.log(data);
            data = data.data;
            fillChatBox(data.messageList, null, contactUniqId);
        },
        error: function (e) {
            console.log("fail", e);
        }
    });
}

function fillChatBox(messageList, userPhoto, contactUniqId) {
    let isScrollDown = $("#chatBox").scrollTop() == ($("#chatBox")[0].scrollHeight - $('#chatBox')[0].clientHeight);
    for (let i = messageList.length - 1; i >= 0; i--) {
        //console.log(createMessageDiv(messageList[i].message, userPhoto, true));
        let isCurrentUser = contactUniqId !== messageList[i].uniqid;
        $("#messageListContainer").append(createMessageDiv(messageList[i].message, userPhoto, isCurrentUser));
    }
    if(isScrollDown){
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
            },
            success: function (data) {
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
            },
            error: function (e) {
                console.log("fail", e);
            }
        });
        $("#inputMessage").val("");

    }
});

function scrollDownChatBox(){
    console.log($("#chatBox"));
    $("#chatBox").scrollTop($("#chatBox")[0].scrollHeight - $('#chatBox')[0].clientHeight);
}