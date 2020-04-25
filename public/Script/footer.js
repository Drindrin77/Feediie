document.addEventListener("DOMContentLoaded", function (event) {
    var element = document.getElementById('pageContainer');
    var height = element.offsetHeight;
    console.log(height, screen.height)
    if (height < screen.height) {
        $("#footer").addClass('stikybottom');
    }




}, false);