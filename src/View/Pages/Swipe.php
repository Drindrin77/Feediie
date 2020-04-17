<?php
$users = isset($this->data['users']) && !empty($this->data['users']) ? $this->data['users'] : null;

?>
<div class="container-fluid background">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div id="parameters"class="float-left">
                    <div>Montrez moi </div>
                    <div>
                        <input type="checkbox" id="man" name="man"
                               checked>
                        <label for="scales">Homme</label>
                    </div>
                    <div>
                        <input type="checkbox" id="woman" name="woman">
                        <label for="horns">Femme</label>
                    </div>
                    <div>Distance</div>

                </div>
            </div>
            <div class="col-lg-3 swipe">
                <div id="card">
                    <div class="buddy buddyEnd" style="display: block">Plus de plats en stock !</div>
                    <?php foreach ($users as $user): ?>
                        <div class="buddy" style="display: block"> <div class="avatar" style="display: block; background-image: url('https://i1.rgstatic.net/ii/profile.image/299428121464838-1448400635747_Q512/Alain_Faye.jpg')"></div><div class="name"><?= $user['firstname'] ?>, <?= date_diff(date_create(($user['birthday'])), date_create('today'))->y ?></div><div class="description"><?= $user['description'] ?></div></div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div id="blockButtons">
                    <div id="beurkBtn" class="buttons"><img src="../Images/Icon/beurk.png" alt=""/></div>
                    <div id="miamBtn" class="buttons"><img src="../Images/Icon/miam.png" alt=""/></div>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</div>

