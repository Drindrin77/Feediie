$(document).ready(function () {
    console.log("ready");

    let statusBtnParameter = 'opened';

    function replaceFilteredUser(user) {

        //INSERT AFTER BUDDY END
        let content = '<div class="buddy" style="display: block"><div class="avatar">'

        let photos = ''

        let card = '<div class="name">' + user.firstname + ' ' + user.age + ' ans<div class="iconcard seeProfil"><img src="/Images/Icon/eye.png" alt="" /></div><div id="report" class="iconcard"><img src="/Images/Icon/alert.png" alt="" /></div></div><div class="description"> ' + user.description + ' ...</div><div class="meat">'
        //FAVORITE DISH ? 

        //INSERT AFTER MOREINFOUSER
        //USER DETAILS

    }



    $(document).on('click', '.seeProfil', function () {
        let id = $(this).data("targetid")
        console.log($(".moreinfoUser").find(".containerUserDetails[data-userID=" + id + "]"))
        $(".moreinfoUser").find("div[data-userID=" + id + "]").attr("data-hidden", "false")
    })





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
    $('[data-toggle="popover"]').popover({ trigger: 'hover' });

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
            $("#boxSelectAge").css({ height: '0', opacity: '0', margin: 0 });
            $("#boxSelectDistance").css({ height: '0', opacity: '0', margin: 0 });
            $(this).html('<i style=\'font-size:18px;color:white\' class=\'fas\'>&#xf102;</i>');
        }
    });

    //ON AFFICHE OU NON DIET S'IL EST ACTIVE
    if ($('#togglediet').is(':checked')) {
        $("#boxSelectModifiedDiet").show();
        $("#showMoreDiet").show();
    } else {
        $("#boxSelectModifiedDiet").hide();
        $("#showMoreDiet").hide();
    }
    $('#togglediet').change(function () {
        if ($(this).is(':checked')) {
            $("#boxSelectModifiedDiet").show();
            $("#showMoreDiet").show();
            $('#lblToggleDiet').html('Désactiver la recherche');
        } else {
            $("#boxSelectModifiedDiet").hide();
            $("#showMoreDiet").hide();
            $('#lblToggleDiet').html('Activer la recherche');
            if (document.getElementById("boxSelectModifiedDiet").style.height === "auto") {
                $("#boxSelectModifiedDiet").css('height', '75px');
                $("#boxSelectModifiedSex").show();
                $("#showMoreSex").show();
                $("#boxSelectModifiedCat").show();
                $("#showMoreCat").show();
                $("#boxSelectAge").css({ height: 'auto', opacity: '100' });
                $("#boxSelectDistance").css({ height: 'auto', opacity: '100' });
                $(this).html('<i style=\'font-size:18px;color:white\' class=\'fas\'>&#xf103;</i>');
            }
        }
    });


    //ON RECUPERE LA RELATION SELECTIONNEE
    $('.relationCase').click(function () {
        let selected = $(this).attr("data-selected")
        selected = selected == "true" ? "false" : "true"
        $(this).attr("data-selected", selected)
        let id = $(this).attr("id")

        $.post("/ajax.php?entity=user&action=updateInterestedRelation",
            {
                value: selected,
                id: id
            })
            .fail(function (e) {
                console.log("fail", e);
            })
            .done(function (e) {
                let data = JSON.parse(e);
                if (data.status === 'success') {
                    console.log(data);
                    $("#messageSuccess").html("Relation bien enregistrés !");
                    $('#containerMessageSuccess').show(200).delay(2000).hide(200);
                }
            });

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

        let dietactive;
        if ($('#togglediet').is(':checked')) {
            dietactive = true;
        }
        else {
            dietactive = false;
        }
        $.post("/ajax.php?entity=user&action=filter",
            {
                dietactive: dietactive,
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
    $('.seeProfil').click(function () {
        $('.watchProfile').css({ opacity: '100%', 'pointer-events': 'all', 'transform': 'translate(0px,0)' });
        $('#blockButtons').css({ 'pointer-events': 'none' }).fadeOut('slow');
        $('.moveOpenProfil').css({ 'transform': 'translate(0px,0)' });
    });
    $('#closeProfileBtn').click(function () {
        $('.watchProfile').css({ opacity: '0%', 'pointer-events': 'none', 'transform': ' translate(-160px,0)' });
        $('#blockButtons').css({ 'pointer-events': 'all' }).fadeIn('slow');
        $('.moveOpenProfil').css({ 'transform': 'translate(150px,0)' });
        $('.moreinfoUser').find(".containerUserDetails").attr("data-hidden", "true")
    });
    // SWIPE

    $('#miamBtn').click(function () {
        $(this).css('pointer-events', 'none');
        $("#beurkBtn").css('pointer-events', 'none');
        let actualUser = $('.buddy:last');
        if (!actualUser.is(':first-child')) {
            actualUser.append('<div class="status miam">Miam!</div>');
            actualUser.addClass('rotate-left').delay(500);
            setTimeout(function () {
                $('.buddy:last').remove();
                $("#miamBtn").css('pointer-events', 'all');
                $("#beurkBtn").css('pointer-events', 'all');
            }, 1000);
        }
    });
    $('#beurkBtn').click(function () {

        $(this).css('pointer-events', 'none');
        $("#miamBtn").css('pointer-events', 'none');
        let actualUser = $('.buddy:last');
        if (!actualUser.is(':first-child')) {
            actualUser.append('<div class="status beurk">Beurk!</div>');
            actualUser.addClass('rotate-right').delay(500);
            setTimeout(function () {
                $('.buddy:last').remove();
                $("#beurkBtn").css('pointer-events', 'all');
                $("#miamBtn").css('pointer-events', 'all');

            }, 1000);
        }
    });

});

