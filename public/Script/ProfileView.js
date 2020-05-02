$(document).ready(function () {
    $("#userphoto").click(function () {
        $("#modalphoto").modal()
        $("#carouselPhoto").carousel('pause')
        $(".modal-body img").removeClass("h-100")
    })
})
