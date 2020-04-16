<?php
    $isCurrentUser = $this->data['isCurrentUser'];
    $infoUser = $this->data['user'];
    $hobbies = $this->data['hobbies'];
    $personalities = $this->data['personalities'];
    $favoriteDish = $this->data['favoriteDish'];
    $photos = $this->data['photos'];
?>

<div>


    <div style="width:200px; height:200px" id="photos">
        <?php include_once('CarouselPhoto.php'); ?>
    </div>


    <?php 
        if($isCurrentUser){
            echo '<button>Editer le profil </button>';
        }
    ?>

    <div id="info">
        <p>Nom : <?= $infoUser['lastname']?></p>
        <p>Prenom : <?= $infoUser['firstname']?></p>
        <p>Age : <?= $infoUser['age']?></p>
        <p>description : <?= $infoUser['description']?></p>
        <p>sexe : <?= $infoUser['sex']?></p>
        <p>ville : <?= $infoUser['city'].' ('. $infoUser['zipcode']. ')' ?> </p>
        <p>admin : <?= $infoUser['isadmin']?></p>
    </div>

    <div id="hobbies">
        <h3> Mes hobby </h3>
        <?php foreach($hobbies as $hobby): ?>
            <div style="width: 150px" class="alert alert-primary" role="alert">
                <?= $hobby['name'] ?>
            </div>
        <?php endforeach ?>
    </div>


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

</div>