$(document).ready(function () {
    console.log("ready");

    let statusBtnParameter = 'opened';

    $("#closeBtn").click(function () {
        if (statusBtnParameter === 'opened') {
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
    });

    $("#showMore1").click(function () {
        if (document.getElementById("boxSelectModified1").style.height === "auto") {
            $("#boxSelectModified1").css('height', '75px');
            $("#boxSelectModified2").show();
            $(".boxSelect").show();
            $("#showMore2").show();
            $(this).html('<i style=\'font-size:18px;color:white\' class=\'fas\'>&#xf103;</i>');
        } else {
            $("#boxSelectModified1").css('height', 'auto');
            $("#boxSelectModified2").hide();
            $(".boxSelect").hide();
            $("#showMore2").hide();
            $(this).html('<i style=\'font-size:18px;color:white\' class=\'fas\'>&#xf102;</i>');
        }
    });
    $("#showMore2").click(function () {
        if (document.getElementById("boxSelectModified2").style.height === "auto") {
            $("#boxSelectModified2").css('height', '75px');
            $("#boxSelectModified1").show();
            $("#showMore1").show();
            $(".boxSelect").show();
            $(this).html('<i style=\'font-size:18px;color:white\' class=\'fas\'>&#xf103;</i>');
        } else {
            $("#boxSelectModified2").css('height', 'auto');
            $("#boxSelectModified1").hide();
            $("#showMore1").hide();
            $(".boxSelect").hide();
            $(this).html('<i style=\'font-size:18px;color:white\' class=\'fas\'>&#xf102;</i>');
        }
    });

    ///////////////////////RECUPERATION DES DONNEES PARAMETRES////////////////////////

    //ON LOADING PAGE
    $('#distanceMax').load('input', function () {
        let value = $(this).val();
        $("#valueDistance").html(value)
    });
    $("#ageRangemin").load('input', function () {
        let value = $(this).val();
        $("#valueAgeMin").html(value)
    });
    $("#ageRangemax").load('input', function () {
        let value = $(this).val();
        $("#valueAgeMax").html(value)
    });
    //ON MOVE EVENT
    $('#distanceMax').on('input', function () {
        let value = $(this).val();
        $("#valueDistance").html(value)
    });
    $("#ageRangemin").on('input', function () {
        let value = $(this).val();
        $("#valueAgeMin").html(value)
    });

    $("#ageRangemax").on('input', function () {
        let value = $(this).val();
        $("#valueAgeMax").html(value)
    });

    $("#submitParameter").click(function () {
        let distanceMax = $("#distanceMax").val();
        let ageRangemin = $("#ageRangemin").val();
        let ageRangemax = $("#ageRangemax").val();

        $.post("/ajax.php?entity=user&action=filter",
            {
                distanceMax : distanceMax,
                ageRangemin : ageRangemin,
                ageRangemax : ageRangemax,
                //TODO OTHER PARAMETERS
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e);
                if (data.status === 'success') {
                    console.log(data)
                }
            })
    });
////////////////////////////////////////////////////////////////////////////////////
    function selection() {
        let profilLink = document.getElementById("profilLink");
        let backgroundOverlay = document.querySelector(".backgroundOverlay");
        let profilCloseBtn = document.getElementById("profilCloseBtn");
        profilLink.onclick = function () {
            backgroundOverlay.style.opacity = "100%";
            backgroundOverlay.style.pointerEvents = "all";
        };

        profilCloseBtn.onclick = function () {
            backgroundOverlay.style.opacity = "0";
            backgroundOverlay.style.pointerEvents = "none";
        };
        backgroundOverlay.onclick = function () {
            backgroundOverlay.style.opacity = "0";
            backgroundOverlay.style.pointerEvents = "none";
        };
    }

    selection();

    $(".buddy").on("swiperight", function () {
        $(this).addClass('rotate-left').delay(700).fadeOut(1);
        $('.buddy').find('.status').remove();

        $(this).append('<div class="status miam">Miam!</div>');
        if ($(this).is(':last-child')) {
            $('.buddy:nth-child(1)').removeClass('rotate-left rotate-right').fadeIn(300);
        } else {
            $(this).next().removeClass('rotate-left rotate-right').fadeIn(400);
        }
    });

    $(".buddy").on("swipeleft", function () {
        $(this).addClass('rotate-right').delay(700).fadeOut(1);
        $('.buddy').find('.status').remove();
        $(this).append('<div class="status beurk">Beurk!</div>');

        if ($(this).is(':last-child')) {
        } else {
            $(this).next().removeClass('rotate-left rotate-right').fadeIn(400);
        }
    });

    $('#miamBtn').click(function () {
        if ($('.buddy:last').is(':first-child')) {
        } else {
            $('.buddy:last').addClass('rotate-left').delay(700).fadeOut(1);
            $('.buddy:last').append('<div class="status miam">Miam!</div>');
        }
    });
    $('#beurkBtn').click(function () {
        if ($('.buddy:last').is(':first-child')) {
        } else {
            $('.buddy:last').addClass('rotate-right').delay(700).fadeOut(1);
            $('.buddy:last').append('<div class="status beurk">Beurk!</div>');
        }
    });


});

