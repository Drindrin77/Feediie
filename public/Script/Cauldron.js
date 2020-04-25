function spaceBelow2Div(divA, divB) {
    const firstDiv=$(divA).offset();
    const firstDivHeight = $(divA).height();
    const secondDiv=$(divB).offset();
    console.log(firstDiv);
    const spaceBelow = secondDiv.top-firstDiv.top;

    return spaceBelow
}

function setMatchedUserContainerHeight(){
    const height = spaceBelow2Div("#pageContainer", "#footer");
    $("#matchedUserContainer").height(height );
    console.log(height);
}

function setChatBoxSize(){
    let height = spaceBelow2Div("#pageContainer", "#footer");
    console.log(height);

    height -= ($("#userMessageArea").height() + $("#chatSelectedContact").height());
    console.log(height);

    $("#chatBox").height(height);
}

$(document).ready(function() {
    setMatchedUserContainerHeight();
    setChatBoxSize();
});

$(window).resize(function(){
    setMatchedUserContainerHeight();
    setChatBoxSize();
});