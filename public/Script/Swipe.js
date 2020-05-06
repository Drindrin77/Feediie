$(document).ready(function () {

    let statusBtnParameter = 'closed';

    let windowHeight = $(window).height();
    let windowWidth = $(window).width();
    $(window).on('resize',function(){
        windowHeight = $(window).height();
        windowWidth = $(window).width();
    });

    if (windowHeight < 500 || windowWidth < 900) {
        $(".buttonParameter").css('transform', 'translate(-260px,20px)');
    } else {
        $(".animationParameters").css('transform', 'translate(-120px,0)');
        statusBtnParameter = 'opened';
    }

    $(".seeProfil").click(function () {
        let id = $(this).parent().parent().attr("id")
        $(".moreinfoUser").find("div[data-userID=" + id + "]").attr("data-hidden", "false")
    })

    $(".reportUser").click(function () {
        let idReportedUser = $(this).parent().parent().attr("id")

        $.post("/ajax.php?entity=user&action=report",
            {
                idReportedUser: idReportedUser
            })
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == 'success') {
                    $("#messageSuccess").html("Cet utilisateur a bien été signalé")
                    $('#containerMessageSuccess').show(200).delay(2000).hide(200)
                }
            })

    });
    $(".buttonParameter").click(function () {
        if (statusBtnParameter === 'closed') {
            $(".buttonParameter").css('transform', 'translate(-450px,20px)');
            setTimeout(function () {

                $(".animationParameters").css('transform', 'translate(-120px,0)');
            }, 400);


            statusBtnParameter = 'opened';
        }
    });
    $("#closeBtn").click(function () {
        if (statusBtnParameter === 'opened') {
            $(".animationParameters").css('transform', 'translate(-450px,0)');
            setTimeout(function () {
                $(".buttonParameter").css('transform', 'translate(-260px,20px)');
            }, 400);

            statusBtnParameter = 'closed';
        }
    });
    //AFFICHER LES DIFFERENTES RELATIONS
    $('[data-toggle="popover"]').popover({trigger: 'hover'});

    $("#showMoreSex").click(function () {
        if (document.getElementById("boxSelectModifiedSex").style.height === "auto") {
            $("#boxSelectModifiedSex").css('height', '75px');
            $("#boxSelectModifiedDiet").show();
            $("#showMoreDiet").show();
            $("#boxSelectModifiedCat").show();
            $("#showMoreCat").show();
            $("#boxSelectAge").css({height: 'auto', opacity: '100'});
            $("#boxSelectDistance").css({height: 'auto', opacity: '100'});
            $(this).html('<i style=\'font-size:18px;color:white\' class=\'fas\'>&#xf103;</i>');
        } else {
            $("#boxSelectModifiedSex").css('height', 'auto');
            $("#boxSelectModifiedDiet").hide();
            $("#showMoreDiet").hide();
            $("#boxSelectModifiedCat").hide();
            $("#showMoreCat").hide();
            $("#boxSelectAge").css({height: '0', opacity: '0'});
            $("#boxSelectDistance").css({height: '0', opacity: '0'});
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
            $("#boxSelectAge").css({height: 'auto', opacity: '100'});
            $("#boxSelectDistance").css({height: 'auto', opacity: '100'});
            $(this).html('<i style=\'font-size:18px;color:white\' class=\'fas\'>&#xf103;</i>');
        } else {
            $("#boxSelectModifiedDiet").css('height', 'auto');
            $("#boxSelectModifiedSex").hide();
            $("#showMoreSex").hide();
            $("#boxSelectModifiedCat").hide();
            $("#showMoreCat").hide();
            $("#boxSelectAge").css({height: '0', opacity: '0', margin: 0});
            $("#boxSelectDistance").css({height: '0', opacity: '0', margin: 0});
            $(this).html('<i style=\'font-size:18px;color:white\' class=\'fas\'>&#xf102;</i>');
        }
    });

    $('input[name="diet"]').each(function () {
        if ($(this).val() === '0') {
            $(this).removeClass();
            $(this).addClass('custom-range');
            $(this).addClass('custom-range-hide');
        } else if ($(this).val() === '2') {
            $(this).removeClass();
            $(this).addClass('custom-range');
            $(this).addClass('custom-range-show');
        } else {
            $(this).removeClass();
            $(this).addClass('custom-range');
        }
    });
    $('input[name="diet"]').click(function () {
        if ($(this).val() === '0') {
            $(this).removeClass();
            $(this).addClass('custom-range');
            $(this).addClass('custom-range-hide');
        } else if ($(this).val() === '2') {
            $(this).removeClass();
            $(this).addClass('custom-range');
            $(this).addClass('custom-range-show');
        } else {
            $(this).removeClass();
            $(this).addClass('custom-range');
        }
    });

    //ON RECUPERE LA RELATION SELECTIONNEE
    $('.selectRelationCase').click(function () {
        let selected = $(this).attr("data-selected");
        selected = selected == "true" ? "false" : "true";
        $(this).attr("data-selected", selected);
        let id = $(this).attr("id");

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


    let initialSelectedSex = Array()

    $('input[name="sex"]:checked').each(function () {
        initialSelectedSex.push($(this).attr('id'));
    });

    let changesSex = Array()

    $('input[name="sex"]').change(function () {
        let id = this.id
        let status = this.checked

        //FOUND
        if (jQuery.inArray(id, initialSelectedSex) !== -1) {
            if (!status) {
                changesSex.push({id: id, status: false})
            } else {
                changesSex = $.grep(changesSex, function (e) {
                    return e.id != id;
                });
            }
        }
        //NOT FOUND
        else {
            if (status) {
                changesSex.push({id: id, status: true})
            } else {
                changesSex = $.grep(changesSex, function (e) {
                    return e.id != id;
                });
            }
        }
    })

    let initialDistance = $("#distanceMax").val();
    let initialAgeMin = $("#ageRangemin").val();
    let initialAgeMax = $("#ageRangemax").val();

    $("#submitParameter").click(function () {

        let argsJSON = {
            valuesDiet: []
        };

        let newDistance = $("#distanceMax").val();
        let newAgeMin = $("#ageRangemin").val();
        let newAgeMax = $("#ageRangemax").val();

        if (newDistance != initialDistance) {
            argsJSON.distance = newDistance
        }
        if (newAgeMax != initialAgeMax) {
            argsJSON.ageMax = newAgeMax
        }
        if (newAgeMin != initialAgeMin) {
            argsJSON.ageMin = newAgeMin
        }

        $('input[name="diet"]').each(function () {
            let id = $(this).attr('id')
            let value = $(this).val()
            if (value != 1) {
                value = value == 0 ? false : true
                argsJSON.valuesDiet.push({id: id, value: value})
            }
        })

        if (changesSex.length != 0) {

            argsJSON.changesSex = []
            for (var i = 0; i < changesSex.length; i++) {
                argsJSON.changesSex.push(changesSex[i]);
            }
        }

        $.post("/ajax.php?entity=user&action=editFilter", argsJSON)
            .fail(function (e) {
                console.log("fail", e)
            })
            .done(function (e) {
                let data = JSON.parse(e)
                if (data.status == 'success') {
                    $("#messageSuccess").html("Modification validée")
                    $('#containerMessageSuccess').show(200).delay(2000).hide(200)
                    location.reload();
                }

            })
    })

    //AFFICHER PROFILE
    $('.seeProfil').click(function () {
        if ($('.watchProfile').css('opacity') === '0') {
            if(windowWidth<800){
                $('.watchProfile').css({opacity: '100%', 'pointer-events': 'all','transform': ' translate(-400px,0)'});
                $('#blockButtons').css({'pointer-events': 'none'}).fadeOut('slow');
            }
            else {
            $('.watchProfile').css({opacity: '100%', 'pointer-events': 'all', 'transform': 'translate(0px,0)'});
            $('#blockButtons').css({'pointer-events': 'none'}).fadeOut('slow');
            $('.moveOpenProfil').addClass('profilopen');
            }
        } else {
            if(windowWidth<800){
                $('.watchProfile').css({opacity: '0%', 'pointer-events': 'none','transform': ' translate(-400px,0)'});
                $('#blockButtons').css({'pointer-events': 'all'}).fadeIn('slow');
                $('.moreinfoUser').find(".containerUserDetails").attr("data-hidden", "true")
            }
            else {
                $('.watchProfile').css({opacity: '0%', 'pointer-events': 'none', 'transform': ' translate(-160px,0)'});
                $('#blockButtons').css({'pointer-events': 'all'}).fadeIn('slow');
                $('.moveOpenProfil').removeClass('profilopen');
                $('.moreinfoUser').find(".containerUserDetails").attr("data-hidden", "true")
            }
        }
    });
    $(window).on('resize',function(){
            $('.watchProfile').css({opacity: '0%', 'pointer-events': 'none'});
            $('#blockButtons').css({'pointer-events': 'all'}).fadeIn('slow');
            $(".animationParameters").css('transform', 'translate(-450px,0)');
        setTimeout(function () {
            $(".buttonParameter").css('transform', 'translate(-260px,20px)');
        }, 400);
            statusBtnParameter = 'closed';
    });
    $('#closeProfileBtn').click(function () {
        if(windowWidth<700) {
            $('.watchProfile').css({opacity: '0%', 'pointer-events': 'none'});
            $('#blockButtons').css({'pointer-events': 'all'}).fadeIn('slow');
            $('.moreinfoUser').find(".containerUserDetails").attr("data-hidden", "true")
        }
        else
        {
            $('.watchProfile').css({opacity: '0%', 'pointer-events': 'none'}).removeClass('profilsecondopen');
            $('#blockButtons').css({'pointer-events': 'all'}).fadeIn('slow');
            $('.moveOpenProfil').removeClass('profilopen');
            $('.moreinfoUser').find(".containerUserDetails").attr("data-hidden", "true")
        }
    });
    // SWIPE

    $('#miamBtn').click(function () {
        $(this).css('pointer-events', 'none');
        $("#beurkBtn").css('pointer-events', 'none');
        let actualUser = $('.buddy:last');
        if (!actualUser.is(':first-child')) {

            let idLikedUser = actualUser.attr("id")
            console.log(idLikedUser)

            $.post("/ajax.php?entity=user&action=like",
                {
                    idLikedUser: idLikedUser
                })
                .fail(function (e) {
                    console.log("fail", e)
                })
                .done(function (e) {
                    let data = JSON.parse(e)

                })

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

            let idDislikedUser = actualUser.attr("id")

            $.post("/ajax.php?entity=user&action=dislike",
                {
                    idDislikedUser: idDislikedUser
                })
                .fail(function (e) {
                    console.log("fail", e)
                })
                .done(function (e) {
                    let data = JSON.parse(e)

                })
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

