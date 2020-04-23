$(document).ready(function () {
    console.log("reaady")

    let statusBtnParameter = 'opened'

    $("#closeBtn").click(function () {
        if (statusBtnParameter == 'opened') {
            $("#parameters").css('transform', 'translate(-420px,0)');
            setTimeout(function () {
                $("#closeBtn").css('transform', 'translate(300px, -30px)');
            }, 800);
            statusBtnParameter = 'closed'

        } else {
            $("#parameters").css('transform', 'translate(-100px,0)');
            $("#closeBtn").css('transform', 'translate(270px, -30px)');
            statusBtnParameter = 'opened'
        }
    })

    $('#distance').on('input', function () {
        let value = $(this).val()
        $("#valueDistance").html(value)
    })
    $("#ageRangemin").on('input', function () {
        let value = $(this).val()
        $("#valueAgeMin").html(value)
    })

    $("#ageRangemax").on('input', function () {
        let value = $(this).val()
        $("#valueAgeMax").html(value)
    })

    $("#submitParameter").click(function () {
        let distance = $("#distance").val();

        $.post("/ajax.php?entity=user&action=filter",
            {
                distance: distance
                //TODO OTHER PARAMETERS
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == 'success') {
                    console.log(data)
                }
            })

    })

    // function selection() {
    //     let profilLink = document.getElementById("profilLink");
    //     let backgroundOverlay = document.querySelector(".backgroundOverlay");
    //     let profilCloseBtn = document.getElementById("profilCloseBtn");
    //     profilLink.onclick = function () {
    //         backgroundOverlay.style.opacity = "100%";
    //         backgroundOverlay.style.pointerEvents = "all";
    //     };

    //     profilCloseBtn.onclick = function () {
    //         backgroundOverlay.style.opacity = "0";
    //         backgroundOverlay.style.pointerEvents = "none";
    //     };
    //     backgroundOverlay.onclick = function () {
    //         backgroundOverlay.style.opacity = "0";
    //         backgroundOverlay.style.pointerEvents = "none";
    //     };
    // }
    // selection();

    $(".buddy").on("swiperight", function () {
        if ($(this).is(':first-child')) {
        }
        else {
            $(this).addClass('rotate-left').delay(700).fadeOut(1);
            $(this).append('<div class="status miam">Miam!</div>');
        }
    });

    $(".buddy").on("swipeleft", function () {
        if ($(this).is(':first-child')) {
        }
        else {
            $(this).addClass('rotate-right').delay(700).fadeOut(1);
            $(this).append('<div class="status beurk">Beurk!</div>');
        }
    });

    $('#miamBtn').click(function () {
        if ($('.buddy:last').is(':first-child')) {
        }
        else {
            $('.buddy:last').addClass('rotate-left').delay(700).fadeOut(1);
            $('.buddy:last').append('<div class="status miam">Miam!</div>');
        }
    });
    $('#beurkBtn').click(function () {
        if ($('.buddy:last').is(':first-child')) {
        }
        else {
            $('.buddy:last').addClass('rotate-right').delay(700).fadeOut(1);
            $('.buddy:last').append('<div class="status beurk">Beurk!</div>');
        }
    });

    // function openSelection() {
    //     let showMoreBtn = document.querySelectorAll(".showMoreBtn");
    //     let boxSelectModified = document.querySelectorAll(".boxSelectModified");
    //     let boxSelect = document.querySelectorAll(".boxSelect");
    //     showMoreBtn[0].onclick = function () {
    //         if (opened[0] === false) {
    //             this.innerHTML = "<i style='font-size:18px;color:white' class='fas'>&#xf102;</i>";
    //             boxSelectModified[0].style.height = "auto";
    //             boxSelectModified[0].style.transition = "all 2s";
    //             for (let i = 0; i < nbBoxselect; i++) {
    //                 boxSelect[i].style.display = "none";
    //             }
    //             boxSelectModified[1].style.display = "none";
    //             showMoreBtn[1].style.display = "none";
    //             opened[0] = true;
    //         }
    //         else {
    //             this.innerHTML = "<i style='font-size:18px;color:white' class='fas'>&#xf103;</i>";
    //             boxSelectModified[0].style.height = "75px";
    //             boxSelectModified[0].style.transition = "all 2s";
    //             for (let i = 0; i < nbBoxselect; i++) {
    //                 boxSelect[i].style.display = "block";
    //             }
    //             boxSelectModified[1].style.display = "block";
    //             showMoreBtn[1].style.display = "block";
    //             opened[0] = false;

    //         }
    //     };
    //     showMoreBtn[1].onclick = function () {
    //         if (opened[1] === false) {
    //             this.innerHTML = "<i style='font-size:18px;color:white' class='fas'>&#xf102;</i>";
    //             boxSelectModified[1].style.height = "auto";
    //             boxSelectModified[1].style.transition = "all 2s";
    //             for (let i = 0; i < nbBoxselect; i++) {
    //                 boxSelect[i].style.display = "none";
    //             }
    //             boxSelectModified[0].style.display = "none";
    //             showMoreBtn[0].style.display = "none";
    //             opened[1] = true;
    //         }
    //         else {
    //             this.innerHTML = "<i style='font-size:18px;color:white' class='fas'>&#xf103;</i>";
    //             boxSelectModified[1].style.height = "75px";
    //             boxSelectModified[1].style.transition = "all 2s";
    //             for (let i = 0; i < nbBoxselect; i++) {
    //                 boxSelect[i].style.display = "block";
    //             }
    //             boxSelectModified[0].style.display = "block";
    //             showMoreBtn[0].style.display = "block";
    //             opened[1] = false;
    //         }
    //     }
    // }
    // let opened = [];
    // let nbBoxselectionModified = 2;
    // let nbBoxselect = 2;
    // for (let i = 0; i < nbBoxselectionModified; i++) {
    //     opened[i] = false;
    // }
    // openSelection();
})