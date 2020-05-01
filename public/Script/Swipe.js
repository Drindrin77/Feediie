$(document).ready(function () {
    console.log("ready");

    let statusBtnParameter = 'opened';

    $("#closeBtn").click(function () {
        if (statusBtnParameter === 'opened') {
            $(".animationParameters").css('transform', 'translate(-420px,0)');
            statusBtnParameter = 'closed';

        } else {
            $(".animationParameters").css('transform', 'translate(-120px,0)');
            statusBtnParameter = 'opened';
        }
    });
    //AFFICHER LES DIFFERENTES RELATIONS
    $('[data-toggle="popover"]').popover({ trigger: 'hover'});

    $("#showMoreSex").click(function () {
        if (document.getElementById("boxSelectModifiedSex").style.height === "auto") {
            $("#boxSelectModifiedSex").css('height', '75px');
            $("#boxSelectModifiedDiet").show();
            $("#showMoreDiet").show();
            $("#boxSelectModifiedCat").show();
            $("#showMoreCat").show();
            $("#boxSelectAge").css({ height: 'auto', opacity: '100' });
            $("#boxSelectDistance").css({ height: 'auto', opacity: '100' });
            $(this).html('<i style=\'font-size:18px;color:white\' class=\'fas\'>&#xf103;</i>');
        } else {
            $("#boxSelectModifiedSex").css('height', 'auto');
            $("#boxSelectModifiedDiet").hide();
            $("#showMoreDiet").hide();
            $("#boxSelectModifiedCat").hide();
            $("#showMoreCat").hide();
            $("#boxSelectAge").css({ height: '0', opacity: '0' });
            $("#boxSelectDistance").css({ height: '0', opacity: '0' });
            $(this).html('<i style=\'font-size:18px;color:white\' class=\'fas\'>&#xf102;</i>');
        }
    });
    $("#showMoreDiet").click(function () {
        if (document.getElementById("boxSelectModifiedDiet").style.height === "auto") {
            $("#boxSelectModifiedDiet").css('height', '75px');
            $("#boxSelectModifiedSex").show();
            $("#showMoreSex").show();
            $("#boxSelectModifiedCat").show();
            $("#showMoreCat").show();
            $("#boxSelectAge").css({ height: 'auto', opacity: '100' });
            $("#boxSelectDistance").css({ height: 'auto', opacity: '100' });
            $(this).html('<i style=\'font-size:18px;color:white\' class=\'fas\'>&#xf103;</i>');
        } else {
            $("#boxSelectModifiedDiet").css('height', 'auto');
            $("#boxSelectModifiedSex").hide();
            $("#showMoreSex").hide();
            $("#boxSelectModifiedCat").hide();
            $("#showMoreCat").hide();
            $("#boxSelectAge").css({ height: '0', opacity: '0' });
            $("#boxSelectDistance").css({ height: '0', opacity: '0' });
            $(this).html('<i style=\'font-size:18px;color:white\' class=\'fas\'>&#xf102;</i>');
        }
    });
    $("#showMoreCat").click(function () {
        if (document.getElementById("boxSelectModifiedCat").style.height === "auto") {
            $("#boxSelectModifiedCat").css('height', '75px');
            $("#boxSelectModifiedSex").show();
            $("#showMoreSex").show();
            $("#boxSelectModifiedDiet").show();
            $("#showMoreDiet").show();
            $("#boxSelectAge").css({ height: 'auto', opacity: '100' });
            $("#boxSelectDistance").css({ height: 'auto', opacity: '100' });
            $(this).html('<i style=\'font-size:18px;color:white\' class=\'fas\'>&#xf103;</i>');
        } else {
            $("#boxSelectModifiedCat").css('height', 'auto');
            $("#boxSelectModifiedSex").hide();
            $("#showMoreSex").hide();
            $("#boxSelectModifiedDiet").hide();
            $("#showMoreDiet").hide();
            $("#boxSelectAge").css({ height: '0', opacity: '0' });
            $("#boxSelectDistance").css({ height: '0', opacity: '0' });
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
        if ($(this).val() > $("#ageRangemax").val()) {
            $(this).val($("#ageRangemax").val());
            let value = $(this).val();
            $("#valueAgeMin").html(value);
        }
    });
    $("#ageRangemax").mouseleave('input', function () {
        if ($(this).val() < $("#ageRangemin").val()) {
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
        $.each($("input[name='sex']:checked"), function () {
            sexSelect.push($(this).attr('id'));
        });
        //alert("Vous avez selectionne : " + sexSelect.join(", "));

        let dietSelect = [];
        $.each($("input[name='diet']:checked"), function () {
            dietSelect.push($(this).attr('id'));
        });
        //  alert("Vous avez selectionne : " + dietSelect.join(", "));

        let relationSelect = [];
        $.each($("input[name='relation']:checked"), function () {
            relationSelect.push($(this).attr('id'));
        });
        //  alert("Vous avez selectionne : " + relationSelect.join(", "));

        $.post("/ajax.php?entity=user&action=filter",
            {
                distanceMax: distanceMax,
                ageRangemin: ageRangemin,
                ageRangemax: ageRangemax,
                sexSelect: sexSelect,
                dietSelect: dietSelect,
                relationSelect: relationSelect,
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
    //AFFICHER PROFILE
    $('.seeProfil:last').click(function () {
        $('.watchProfile').css({opacity: '100%','pointer-events':'all','transform': 'translate(0px,0)'});
        $('#blockButtons').css({'pointer-events':'none'}).fadeOut('slow');
        $('.moveOpenProfil').css({'transform': 'translate(0px,0)'});
    });
    $('#closeProfileBtn').click(function () {
        $('.watchProfile').css({opacity: '0%','pointer-events':'none','transform':' translate(-160px,0)'});
        $('#blockButtons').css({'pointer-events':'all'}).fadeIn('slow');
        $('.moveOpenProfil').css({'transform': 'translate(150px,0)'});
    });
    // SWIPE

    $('#miamBtn').click(function () {
        $(this).css('pointer-events','none');
        $("#beurkBtn").css('pointer-events','none');
        let actualUser = $('.buddy:last');
        if (!actualUser.is(':first-child')) {
            actualUser.append('<div class="status miam">Miam!</div>');
            actualUser.addClass('rotate-left').delay(500);
            setTimeout(function () {
                $('.buddy:last').remove();
                $(this).css('pointer-events','all');
                $("#beurkBtn").css('pointer-events','all');
            }, 1000);
        }
    });
    $('#beurkBtn').click(function () {
        $(this).css('pointer-events','none');
        $("#miamBtn").css('pointer-events','none');
        let actualUser = $('.buddy:last');
        if (!actualUser.is(':first-child')) {
            actualUser.append('<div class="status beurk">Beurk!</div>');
            actualUser.addClass('rotate-right').delay(500);
            setTimeout(function () {
                $('.buddy:last').remove();
                $(this).css('pointer-events','all');
                $("#miamBtn").css('pointer-events','all');

            }, 1000);
        }
    });

});

