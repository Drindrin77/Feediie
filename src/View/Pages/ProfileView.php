<?php
    $isCurrentUser = $this->data['isCurrentUser'];
    $infoUser = $this->data['user'];
    $hobbies = $this->data['hobbies'];
    $personalities = $this->data['personalities'];
    $favoriteDish = $this->data['favoriteDish'];
    //            <p>admin : <?= $infoUser['isadmin']
?>

<div>

    <div id="parentTop">

        <div id="photos">
            <?php include_once('UserPhoto.php'); ?>
        </div>

        <div id="info">
            <p>Nom : <?= $infoUser['lastname']?></p>
            <p>Prenom : <?= $infoUser['firstname']?></p>
            <p>Age : <?= $infoUser['age']?></p>
            <p>description : <?= $infoUser['description']?></p>
            <p>sexe : <?= $infoUser['sex']?></p>
            <p>ville : <?= $infoUser['city'].' ('. $infoUser['zipcode']. ')' ?> </p>
        </div>

        <?php 
            if($isCurrentUser){
                ?>
                    <div id="edit"><button onclick="location.href='/profile/edit'">Editer le profil </button></div>
                <?php
            }
        ?>
    </div>

    <?php if(!empty($hobbies)) {?>
        <div id="hobbies">
            <h3> Mes hobby </h3>
            <?php foreach($hobbies as $hobby): ?>
                <div style="width: 150px" class="alert alert-primary" role="alert">
                    <?= $hobby['name'] ?>
                </div>
            <?php endforeach ?>
        </div>
    <?php } ?>

    <?php if(!empty($personalities)) {?>
        <div id="personalities">
            <h3> Ma personnalité </h3>
            <?php foreach($personalities as $personality): ?>
                <div class="card" style="width: 150px;">
                    <img src=<?=$personality['iconurl']?> class="card-img-top" alt="...">
                    <h5 class="card-title"><?= $personality['name']?></h5>
                    <div class="card-body">
                        <p class="card-text"><?= $personality['description']?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php } ?>

    <?php if(!empty($favoriteDish)) {?>

        <div id="likeeat">
            <h3> Ce que j'aime manger </h3>
            <?php foreach($favoriteDish as $favorite): ?>
                <div class="card" style="width: 150px;">
                    <img src=<?=$favorite['iconurl']?> class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text"><?= $favorite['name']?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php } ?>

</div>