<?php
$users = isset($this->data['users']) && !empty($this->data['users']) ? $this->data['users'] : null;
$sexs = isset($this->data['sexs']) ? $this->data['sexs'] : null;
$diets = isset($this->data['diets']) ? $this->data['diets'] : null;
$userSelectedDiet = isset($this->data['userSelectedDiet']) ? $this->data['userSelectedDiet'] : null;
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
    <div>
        <div id="parameters" class="container">
            <div id="spaceBlock">
            </div>
            <div id="blockParameters">
                <div id="closeBtn" class="buttons"><img src="/Images/Icon/croix.png" alt=""/></div>
                <div>
                    <div class="titleParameter"><h5>Je veux voir</h5></div>
                    <div id="boxSelectModified1"class="boxSelectModified">
                        <?php foreach($sexs as $sex): ?>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="<?= $sex['name'] ?>">
                            <label class="custom-control-label" for="<?= $sex['name'] ?>"><?= $sex['name'] ?></label>
                        </div>
                        <? endforeach;?>
                    </div>
                    <div id="showMore1" class="showMoreBtn"><i style='font-size:18px;color:white' class='fas'>&#xf103;</i></div>
                    <div class="titleParameter"><h5>Distance</h5></div>
                    <div class="boxSelect">
                        <label id="distanceLabel" for="distance"><span id="valueDistance">50</span>km</label>
                        <input type="range" class="custom-range" min="0" max=10" id="distance">
                    </div>
                    <div class="titleParameter"><h5>Age</h5></div>
                    <div class="boxSelect">
                    <div id="slider-range"></div>

                        <label id="ageRangeLabel" for="ageRangemin"><span id="valueAgeMin">50</span> ans - <span id="valueAgeMax">50</span> ans</label>
                        <input type="range" class="custom-range" min="18" max="60" id="ageRangemin">
                        <input type="range" class="custom-range" min="18" max="60" id="ageRangemax">
                    </div>
                    <div class="titleParameter"><h5>Régime Alimentaire</h5></div>
                    <div id="boxSelectModified2" class="boxSelectModified">
                        <?php foreach($diets as $diet): ?>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="<?= $diet['name'] ?>">
                                <label class="custom-control-label" for="<?= $diet['name'] ?>"><?= $diet['name'] ?></label>
                            </div>
                        <? endforeach;?>
                    </div>
                    <div id="showMore2" class="showMoreBtn"><i style='font-size:18px;color:white' class='fas'>&#xf103;</i></div>
                </div>
                <button id="submitParameter" type="button" class="btn btn-primary" style="width:100%">Valider les réglages !</button>
            </div>
        </div>
</div>
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8 swipe">
                <div id="card">
                    <div class="buddy buddyEnd" style="display: block">Plus de plats en stock !</div>
                    <?php foreach ($users as $user): ?>
                        <div class="buddy" style="display: block">
                            <div class="avatar"
                                 style="display: block;width:275px;height: 275px"><?php $this->data['photos']=$user['photos'];
                                 include_once('UserPhoto.php'); ?></div>
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
                        <div id="miamBtn" class="buttons"><img src="/Images/Icon/miam.png" alt=""/></div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</div>


