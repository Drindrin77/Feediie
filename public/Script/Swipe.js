
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

$(document).ready(function () {
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
});

$(document).ready(function () {
    $('#parametersBtn').on('click',function () {
        $('#parameters').toggleClass('active');
    });
    $('#parameters').toggleClass('active');
    $('#closeBtn').on('click', function () {
        $('#parameters').toggleClass('active');
    });
});
function refreshing() {
    inputValues();
    ageValues();
}
function inputValues() {
    let distance = document.getElementById("distance").value;
    document.getElementById("distanceLabel").innerHTML = distance+' km';
}
function ageValues() {
    let ageRangemin = document.getElementById("ageRangemin").value;
    let ageRangemax = document.getElementById("ageRangemax").value;
    if(ageRangemin >= ageRangemax)
    {
        ageRangemin = ageRangemax;
    }
    document.getElementById("ageRangeLabel").innerHTML = ageRangemin+' ans - '+ageRangemax+' ans';
}
window.setInterval("refreshing()", 50);

function openSelection() {
    let showMoreBtn = document.querySelectorAll(".showMoreBtn");
    let boxSelectModified = document.querySelectorAll(".boxSelectModified");
    let boxSelect = document.querySelectorAll(".boxSelect");
    showMoreBtn[0].onclick = function () {
        if(opened[0]===false) {
            this.innerHTML = "<i style='font-size:18px;color:white' class='fas'>&#xf102;</i>";
            boxSelectModified[0].style.height = "auto";
            boxSelectModified[0].style.transition = "all 2s";
            for(let i=0;i<nbBoxselect;i++)
            {
                boxSelect[i].style.display ="none";
            }
            boxSelectModified[1].style.display = "none";
            showMoreBtn[1].style.display = "none";
            opened[0]=true;
        }
        else
        {
            this.innerHTML = "<i style='font-size:18px;color:white' class='fas'>&#xf103;</i>";
            boxSelectModified[0].style.height = "75px";
            boxSelectModified[0].style.transition = "all 2s";
            for(let i=0;i<nbBoxselect;i++)
            {
                boxSelect[i].style.display ="block";
            }
            boxSelectModified[1].style.display = "block";
            showMoreBtn[1].style.display = "block";
            opened[0]=false;

        }
    };
    showMoreBtn[1].onclick = function () {
        if(opened[1]===false) {
            this.innerHTML = "<i style='font-size:18px;color:white' class='fas'>&#xf102;</i>";
            boxSelectModified[1].style.height = "auto";
            boxSelectModified[1].style.transition = "all 2s";
            for(let i=0;i<nbBoxselect;i++)
            {
                boxSelect[i].style.display ="none";
            }
            boxSelectModified[0].style.display = "none";
            showMoreBtn[0].style.display = "none";
            opened[1]=true;
        }
        else
        {
            this.innerHTML = "<i style='font-size:18px;color:white' class='fas'>&#xf103;</i>";
            boxSelectModified[1].style.height = "75px";
            boxSelectModified[1].style.transition = "all 2s";
            for(let i=0;i<nbBoxselect;i++)
            {
                boxSelect[i].style.display ="block";
            }
            boxSelectModified[0].style.display = "block";
            showMoreBtn[0].style.display = "block";
            opened[1]=false;
        }
    }
}
let opened = [];
let nbBoxselectionModified = 2;
let nbBoxselect = 2;
for(let i=0;i<nbBoxselectionModified;i++) {
    opened[i] = false;
}
openSelection();