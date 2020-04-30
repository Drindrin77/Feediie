<?php
$users = isset($this->data['users']) && !empty($this->data['users']) ? $this->data['users'] : null;
$sexs = isset($this->data['sexs']) ? $this->data['sexs'] : null;
$diets = isset($this->data['diets']) ? $this->data['diets'] : null;
$relations = isset($this->data['relations']) ? $this->data['relations'] : null;
$userSelectedDiet = isset($this->data['userSelectedDiet']) ? $this->data['userSelectedDiet'] : null;
$userSelectedGender = isset($this->data['userSelectedGender']) ? $this->data['userSelectedGender'] : null;
$userSelectDistance = isset($this->data['userSelectDistance']) ? $this->data['userSelectDistance'] : null;
$userSelectAge = isset($this->data['userSelectAge']) ? $this->data['userSelectAge'] : null;
$userSelectedRelationType = isset($this->data['userSelectedRelationType']) ? $this->data['userSelectedRelationType'] : null;
if (!empty($userSelectDistance)) {
    foreach ($userSelectDistance as $userDistance) {
        $distance = $userDistance['distance'];
    }
} else {
    $distance = '50';
}
if (!empty($userSelectAge)) {
    foreach ($userSelectAge as $userAges) {
        $ageMin = $userAges['agemin'];
        $ageMax = $userAges['agemax'];
    }
} else {
    $ageMin = '20';
    $ageMax = '25';
}
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
            <div class="row">
                <div class="col-3"></div>
                <div class="col-9">
                    <div id="blockParameters container" class="overflow-auto">
                        <div id="closeBtn" class="buttons"><img src="/Images/Icon/croix.png" alt=""/></div>
                        <div>
                            <div class="titleParameter"><h5>Je veux voir</h5></div>
                            <div id="boxSelectModifiedSex" class="boxSelectModified">
                                <?php foreach ($sexs as $sex): ?>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="sex"
                                               id="<?= $sex['name'] ?>"
                                            <?php if (!empty($userSelectedGender)) {
                                                foreach ($userSelectedGender as $usergender) {
                                                    if ($usergender['name'] == $sex['name']) {
                                                        echo 'checked';
                                                    }
                                                }
                                            } ?>>
                                        <label class="custom-control-label"
                                               for="<?= $sex['name'] ?>"><?= $sex['name'] ?></label>
                                    </div>
                                <? endforeach; ?>
                            </div>
                            <div id="showMoreSex" class="showMoreBtn"><i style='font-size:18px;color:white' class='fas'>&#xf103;</i>
                            </div>
                            <div class="titleParameter"><h5>Distance</h5></div>
                            <div id="boxSelectDistance" class="boxSelect">
                                <label id="distanceLabel" for="distanceMax"><span id="valueDistance">NC</span>
                                    km</label>
                                <input type="range" class="custom-range" min="0" max="200" value="<?= $distance ?>"
                                       id="distanceMax">
                            </div>
                            <div class="titleParameter"><h5>Age</h5></div>
                            <div id="boxSelectAge" class="boxSelect">
                                <div id="slider-range"></div>

                                <label id="ageRangeLabel" for="ageRangemin"><span id="valueAgeMin">NC</span> ans - <span
                                            id="valueAgeMax">NC</span> ans</label>
                                <input type="range" class="custom-range" min="18" max="60" value="<?= $ageMin ?>"
                                       id="ageRangemin">
                                <input type="range" class="custom-range" min="18" max="60" value="<?= $ageMax ?>"
                                       id="ageRangemax">
                            </div>
                            <div class="titleParameter"><h5>Je suis intéressé par</h5></div>
                            <div id="boxSelectModifiedSex" class="boxSelectModified">
                                <?php foreach ($relations as $relation): ?>
                                    <div id="relationCheckbox" class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="relation"
                                               id="<?= $relation['nom'] ?>"
                                            <?php if (!empty($userSelectedRelationType)) {
                                                foreach ($userSelectedRelationType as $userrelation) {
                                                    if ($userrelation['idrelationtype'] == $relation['idrelationtype']) {
                                                        echo 'checked';
                                                    }
                                                }
                                            } ?>>
                                        <label class="custom-control-label"
                                               for="<?= $relation['nom'] ?>"><?= $relation['nom'] ?></label>
                                    </div>
                                <? endforeach; ?>
                            </div>
                            <div id="showMoreCat" class="showMoreBtn"><i class='fas'>&#xf103;</i>
                            </div>
                            <div class="titleParameter"><h5>Régime Alimentaire</h5></div>
                            <div id="boxSelectModifiedDiet" class="boxSelectModified">
                                <?php foreach ($diets as $diet): ?>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="diet"
                                               id="<?= $diet['name'] ?>"
                                            <?php if (!empty($userSelectedDiet)) {
                                                foreach ($userSelectedDiet as $userdiet) {
                                                    if ($userdiet['iddiet'] == $diet['iddiet']) {
                                                        echo 'checked';
                                                    }
                                                }
                                            } ?>
                                        >
                                        <label class="custom-control-label"
                                               for="<?= $diet['name'] ?>"><?= $diet['name'] ?></label>
                                    </div>
                                <? endforeach; ?>
                            </div>
                            <div id="showMoreDiet" class="showMoreBtn"><i class='fas'>&#xf103;</i>
                            </div>
                        </div>
                    </div>
                    <button id="submitParameter" type="button" class="btn btn-primary">Valider
                        les
                        réglages
                    </button>
                </div>
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
                                 style="display: block;width:275px;height: 275px"><?php $this->data['photos'] = $user['photos'];
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


