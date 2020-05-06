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
$toggleDiet = isset($this->data['toggleDiet']) ? $this->data['toggleDiet'] : null;
$dishs = isset($this->data['dishs']) ? $this->data['dishs'] : null;
$distance = $userSelectDistance;

include_once('../src/View/Pages/UserDetails.php');
$ageMin = $userSelectAge['agemin'];
$ageMax = $userSelectAge['agemax'];
include_once('../src/View/Pages/UserPhoto.php');
?>
<div class="container-fluid background">
    <div class="buttonParameter"><h4>Paramètres</h4><img src="/Images/Icon/parameters.png" alt=""/></div>
    <div class="animationParameters">
        <div id="closeBtn" class="buttonsClose"><img src="/Images/Icon/croix.png" alt=""/></div>
        <div id="parameters" class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-9" id="containerParameter">
                    <div class="blockParameters">
                        <div>
                            <div class="titleParameter"><h5>Je veux voir</h5></div>
                            <div id="boxSelectModifiedSex" class="boxSelectModified">
                                <?php foreach ($sexs as $sex): ?>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input Feediie-custom-input"
                                               name="sex"
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
                                <label id="distanceLabel" for="distanceMax"><span id="valueDistance"><?= $distance ?></span>
                                    km</label>
                                <input type="range" class="custom-range" min="0" max="200" value="<?= $distance ?>"
                                       id="distanceMax">
                            </div>
                            <div class="titleParameter"><h5>Age</h5></div>
                            <div id="boxSelectAge" class="boxSelect">
                                <div id="slider-range"></div>

                                <label id="ageRangeLabel" for="ageRangemin"><span id="valueAgeMin"><?= $ageMin ?></span> ans - <span
                                            id="valueAgeMax"><?= $ageMax ?></span> ans</label>
                                <input type="range" class="custom-range" min="18" max="60" value="<?= $ageMin ?>"
                                       id="ageRangemin">
                                <input type="range" class="custom-range" min="18" max="60" value="<?= $ageMax ?>"
                                       id="ageRangemax">
                            </div>
                            <div class="titleParameter"><h5>Régime Alimentaire</h5></div>
                        
                            <div id="boxSelectModifiedDiet" class="boxSelectModified">
                                <?php foreach ($diets as $diet): ?>
                                <div>
                                        <input type="range" style="width: 80px;margin-right: 5px;" min="0" max="2" name="diet"
                                               id="<?= $diet['iddiet'] ?>" 
                                            <?php 
                                                $value = '1';
                                                $class = '"custom-range';
                                                foreach ($userSelectedDiet as $userdiet) {
                                                    if ($userdiet['iddiet'] == $diet['iddiet']) {
                                                        if ($userdiet['status']=== false){
                                                            $value = '0';
                                                            $class .= ' custom-range-hide';
                                                        }
                                                        else{
                                                            $value = '2';
                                                            $class .= ' custom-range-show';
                                                        }
                                                    }
                                                }
                                                echo 'class='.$class.'" value='.$value;
                                            ?>>
                                    <label style="transform: translate(0,-5px)" for="<?= $diet['name'] ?>"><?= $diet['name'] ?></label>
                                </div>
                                <? endforeach; ?>
                            </div>
                            <div id="showMoreDiet" class="showMoreBtn"><i class='fas'>&#xf103;</i>
                            </div>
                        </div>
                    </div>
                    <button id="submitParameter" type="button" class="btn btn-primary btn-parameters">Valider
                        les
                        réglages
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 ">
                <div class="relationPanel">
                    <?php foreach ($relations as $relation): ?>
                        <div id="<?= $relation['idrelationtype'] ?>" class="relationCase selectRelationCase cursorPointer" 
                        <?php 
                        
                        if (!empty($userSelectedRelationType) && in_array($relation['idrelationtype'], $userSelectedRelationType)) {
                                echo 'data-selected="true"';
                        }else{
                                echo 'data-selected="false"';
                        }
                        ?>
                            data-toggle="popover" title="<?= $relation['name'] ?>"
                             data-content="<?= $relation['description'] ?>"><img src="<?= $relation['iconurl'] ?>"
                                                                                 alt=""/></div>
                    <? endforeach; ?>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 moveOpenProfil" style="z-index: 20">
                <div class="row">
                    <div id="card">
                        <div class="buddy buddyEnd" style="display: block"><img src="/Images/Icon/endofbuddy.png"
                                                                                alt=""/></div>
                        <?php if (!empty($users)) {
                            foreach ($users as $user): ?>
                                <div id=<?= $user['iduser'] ?> class="buddy" style="display: block">
                                    <div class="avatar">
                                        <?php
                                        $userPhoto = new UserPhoto($user['photos']);
                                        $userPhoto->render(); ?>
                                    </div>
                                    <div class="name"><?= $user['firstname'] . ' ' . $user['age']?> 
                                        ans
                                        <div class="iconcard cursorPointer seeProfil">
                                            <img src="/Images/Icon/eye.png" alt=""/>
                                        </div>
                                        <div class="iconcard cursorPointer reportUser">
                                            <img src="/Images/Icon/alert.png" alt=""/>
                                        </div>
                                    </div>
                                    <div class="description"><?= $user['description'] ?> ...</div>
                                    <div class="meat">


                                    <?php foreach ($relations as $relation): 
                                        
                                        ?>

                                        <div class="meatCase"
                                        <?php 
                                        
                                        if (in_array($relation['idrelationtype'], $user['relations'])) {
                                                echo 'data-selected="true"';
                                        }else{
                                                echo 'data-selected="false"';
                                        }
                                        ?>
                                            ><img src="<?= $relation['iconurl'] ?>"
                                                           alt=""/></div>
                                    <? endforeach; ?>

                                    </div>
                                </div>

                            <?php endforeach;
                        } ?>
                    </div>
                    <div id="blockButtons">
                        <div id="beurkBtn" class="buttons"><img src="/Images/Icon/beurk.png" alt=""/></div>
                        <div id="miamBtn" class="buttons"><img src="/Images/Icon/miam.png" alt=""/></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 watchProfile">
                <div id="closeProfileBtn" class="buttonsClose"><img src="/Images/Icon/croix.png" alt=""/></div>
                <div class="moreinfoUser">
                    <div class="container-fluid">
                        <?php
                            foreach($users as $user){
                                echo '<div class="containerUserDetails" data-hidden="true" data-userID="'.$user['iduser'].'">';
                                    $userDetails = new UserDetails($user);
                                    $userDetails->render();
                                echo '</div>';
                            }
                        ?>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


