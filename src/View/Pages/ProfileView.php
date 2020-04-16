<?php
    $isCurrentUser = $this->data['isCurrentUser'];
    $infoUser = $this->data['user'];
?>

<div>

<?php 
    if($isCurrentUser){
        echo '<button>Editer le profil </button>';
    }
?>

<div style="width:200px; height:200px">

    <?php include_once('CarouselPhoto.php'); ?>

</div>
<div>
    <p>Nom : <?= $infoUser['lastname']?></p>
    <p>Prenom : <?= $infoUser['firstname']?></p>
    <p>Age : <?= $infoUser['age']?></p>
    <p>description : <?= $infoUser['description']?></p>
    <p>sexe : <?= $infoUser['sex']?></p>
    <p>ville : <?= $infoUser['city'].' ('. $infoUser['zipcode']. ')' ?> </p>
    <p>admin : <?= $infoUser['isadmin']?></p>

</div>

likeEat
looklike
pratice

</div>