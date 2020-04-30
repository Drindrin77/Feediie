$(document).ready(function () {
    console.log("ready");

    let statusBtnParameter = 'opened';

    $("#closeBtn").click(function () {
        if (statusBtnParameter === 'opened') {
            $("#parameters").css('transform', 'translate(-420px,0)');
            setTimeout(function () {
                $("#closeBtn").css('transform', 'translate(580%,-35%)');
            }, 800);
            statusBtnParameter = 'closed'

        } else {
            $("#parameters").css('transform', 'translate(-120px,0)');
            $("#closeBtn").css('transform', 'translate(510%,-35%)');
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
    $("#ageRangemin").mouseleave('input', function () {
        if($(this).val()>$("#ageRangemax").val()) {
            $(this).val($("#ageRangemax").val());
            let value = $(this).val();
            $("#valueAgeMin").html(value);
        }
    });
    $("#ageRangemax").mouseleave('input', function () {
        if($(this).val()<$("#ageRangemin").val()) {
            $(this).val($("#ageRangemin").val());
            let value = $(this).val();
            $("#valueAgeMax").html(value);
        }
    });

    $("#ageRangemax").on('input', function () {
        let value = $(this).val();
        $("#valueAgeMax").html(value)
    });
    $("#submitParameter").click(function () {
        let distanceMax = $("#distanceMax").val();
        let ageRangemin = $("#ageRangemin").val();
        let ageRangemax = $("#ageRangemax").val();

        let sexSelect = [];
            $.each($("input[name='sex']:checked"), function() {
                sexSelect.push($(this).attr('id'));
            });
        //alert("Vous avez selectionne : " + sexSelect.join(", "));

        let dietSelect = [];
        $.each($("input[name='diet']:checked"), function() {
            dietSelect.push($(this).attr('id'));
        });
        //alert("Vous avez selectionne : " + dietSelect.join(", "));
        $.post("/ajax.php?entity=user&action=filter",
            {
                distanceMax : distanceMax,
                ageRangemin : ageRangemin,
                ageRangemax : ageRangemax,
                sexSelect : sexSelect,
                dietSelect : dietSelect,
            })
            .fail(function (e) {
                console.log("fail", e);
                $(this).html("Erreur d'enregistrement");
            })
            .done(function (e) {
                let data = JSON.parse(e);
                if (data.status === 'success') {
                    console.log(data);
                }
            });
        $("#messageSuccess").html("Réglages enregistrés !");
        $('#containerMessageSuccess').show(200).delay(2000).hide(200);
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

    /*$('#miamBtn').click(function () {
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
    });*/

});

