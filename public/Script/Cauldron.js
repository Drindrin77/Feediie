function spaceBelow2Div(divA, divB) {
    const firstDiv=$(divA).offset();
    const firstDivHeight = $(divA).height();
    const secondDiv=$(divB).offset();
    const spaceBelow = secondDiv.top-firstDiv.top;

    return spaceBelow
}

function setMatchedUserContainerHeight(){
    const height = spaceBelow2Div("#pageContainer", "#footer");
    $("#matchedUserContainer").height(height );
}

function setChatBoxSize(){
    let height = spaceBelow2Div("#pageContainer", "#footer");

    height -= ($("#userMessageArea").height() + $("#chatSelectedContact").height());

    $("#chatBox").height(height);
}

$(document).ready(function() {
    setMatchedUserContainerHeight();
    setChatBoxSize();
    fetchMessages( $("#chatSelectedContact").attr("data-uniqid"));
});

$(window).resize(function(){
    setMatchedUserContainerHeight();
    setChatBoxSize();
});

//selectionne un utilisateur dans la liste des matchs
$("#matchedUserContainer").on("click", ".matchedUser", function (event) {
    const uniqId = $(event.currentTarget).attr("data-uniqid");
    const photo = $("#photo-" + uniqId).attr("src");
    const photoDesciption = $("#photo-" + uniqId).attr("alt");
    const name = $("#name-" + uniqId).text();

    console.log(event.currentTarget);
    $(".selectedMatchedUser").addClass("matchedUser");
    $(".selectedMatchedUser").removeClass("selectedMatchedUser");

    $("#user-" + uniqId).addClass("selectedMatchedUser")
    $("#user-" + uniqId).removeClass("matchedUser")
    console.log(event.currentTarget);

    $("#chatSelectedContact").attr("data-uniqid", uniqId);
    $("#chatSelectedContact").attr("href", "/profile/" + uniqId);
    $("#selectedContactPhoto").attr("src", photo);
    $("#selectedContactPhoto").attr("alt", photoDesciption);
    $("#selectedContactName").text(name);

    setChatBoxSize(); //TODO enlever dès que les images sont de taille fixe
});


function fetchMessages(uniqId){
    console.log(uniqId);
    $.post("/ajax.php?entity=chat&action=fetchMessages",
        {
            "contactUniqId": uniqId
        })
        .fail(function (e) {
            console.log("fail", e)
        })
        .done(function (e) {
            console.log(e);
        });
}