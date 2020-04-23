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

