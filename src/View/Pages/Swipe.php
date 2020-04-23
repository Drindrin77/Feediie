<?php
$users = isset($this->data['users']) && !empty($this->data['users']) ? $this->data['users'] : null;

?>
<div class="container-fluid background">
    <div class="backgroundOverlay">
        <div class="container">
            <div class="row">
                <div id="profilCloseBtn" class="buttons"><img src="Images/Icon/croix.png" alt=""/></div>
                <div id="overlayProfil"></div>
            </div>
        </div>
    </div>
    <div id="parameters" class="container">
        <div id="spaceBlock">
        </div>
        <div id="blockParameters">
            <div id="closeBtn" class="buttons"><img src="/Images/Icon/croix.png" alt=""/></div>
            <div>
                <div class="titleParameter"><h5>Montrer moi</h5></div>

                <div class="boxSelectModified">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="men">
                        <label class="custom-control-label" for="men">Hommes</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="women">
                        <label class="custom-control-label" for="women">Femmes</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="other">
                        <label class="custom-control-label" for="other">Autre</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="other">
                        <label class="custom-control-label" for="other">Autre</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="other">
                        <label class="custom-control-label" for="other">Autre</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="other">
                        <label class="custom-control-label" for="other">Autre</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="other">
                        <label class="custom-control-label" for="other">Autre</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="other">
                        <label class="custom-control-label" for="other">Autre</label>
                    </div>
                </div>
                <div class="showMoreBtn"><i style='font-size:18px;color:white' class='fas'>&#xf103;</i></div>
                <div class="titleParameter"><h5>Distance</h5></div>
                <div class="boxSelect">
                    <label id="distanceLabel" for="distance">X km</label>
                    <input type="range" class="custom-range" min="0" max=10" id="distance">
                </div>
                <div class="titleParameter"><h5>Age</h5></div>
                <div class="boxSelect">
                    <label id="ageRangeLabel" for="ageRangemin">X ans - Y ans</label>
                    <input type="range" class="custom-range" min="18" max="60" id="ageRangemin">
                    <input type="range" class="custom-range" min="18" max="60" id="ageRangemax">
                </div>
                <div class="titleParameter"><h5>Régime Alimentaire</h5></div>
                <div class="boxSelectModified">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="vegetarien">
                        <label class="custom-control-label" for="vegetarien">Végétarien</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="noGluten">
                        <label class="custom-control-label" for="noGluten">Sans gluten</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="halal">
                        <label class="custom-control-label" for="halal">Halal</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="vegan">
                        <label class="custom-control-label" for="vegan">Végan</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="noarachide">
                        <label class="custom-control-label" for="noarachide">Sans arachide</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="other">
                        <label class="custom-control-label" for="other">Autre</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="other">
                        <label class="custom-control-label" for="other">Autre</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="other">
                        <label class="custom-control-label" for="other">Autre</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="other">
                        <label class="custom-control-label" for="other">Autre</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="other">
                        <label class="custom-control-label" for="other">Autre</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="other">
                        <label class="custom-control-label" for="other">Autre</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="other">
                        <label class="custom-control-label" for="other">Autre</label>
                    </div>
                </div>
                <div class="showMoreBtn"><i style='font-size:18px;color:white' class='fas'>&#xf103;</i></div>
            </div>
            <button type="button" class="btn btn-primary" style="width:100%">Valider les réglages !</button>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8 swipe">
                <div id="card">
                    <!-- <div id="parametersBtn" class="buttons"><img src="../../../public/Images/Icon/cookie.png" alt=""/></div>-->
                    <div class="buddy buddyEnd" style="display: block">Plus de plats en stock !</div>
                    <?php foreach ($users as $user): ?>
                        <div class="buddy" style="display: block">
                            <div class="avatar"
                                 style="display: block;width:275px;height: 275px"><?php include_once('UserPhoto.php'); ?></div>
                            <div class="name"><?= $user['firstname'] ?>
                                , <?= date_diff(date_create(($user['birthday'])), date_create('today'))->y ?></div>
                            <div class="description"><?= $user['description'] ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <div id="profilLink">Afficher le profil</div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div id="blockButtons">
                        <div id="beurkBtn" class="buttons"><img src="/Images/Icon/beurk.png" alt=""/></div>
                        <div id="parametersBtn" class="buttons"><img src="/Images/Icon/parameter.png" alt=""/></div>
                        <div id="miamBtn" class="buttons"><img src="/Images/Icon/miam.png" alt=""/></div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</div>
<script>
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
</script>
<script>
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

</script>
<script>
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
</script>
<script>
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
</script>
