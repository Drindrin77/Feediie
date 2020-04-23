<?php
    $isCurrentUser = $this->data['isCurrentUser'];
    $infoUser = $this->data['user'];
   // $hobbies = $this->data['hobbies'];
    $personalities = $this->data['personalities'];
    $favoriteDish = $this->data['favoriteDish'];
    $hobbies = array(array('name'=>'Musique'),array('name'=>'Jeux-vidéos'),array('name'=>'Dessin')
    ,array('name'=>'Badminton'),array('name'=>'Musique'),array('name'=>'Musique'));

    $favoriteDish = array(array('name'=>'Pizza','iconurl'=>'/Images/Dish/pizza.png'),
    array('name'=>'Pizza','iconurl'=>'/Images/Dish/pizza.png'),
    array('name'=>'Pizza','iconurl'=>'/Images/Dish/pizza.png'),
    array('name'=>'Pizza','iconurl'=>'/Images/Dish/pizza.png'),
    array('name'=>'Pizza','iconurl'=>'/Images/Dish/pizza.png'),);


    $personalities = array(array('name'=>'Sportif','iconurl'=>'/Images/Dish/salad.png'),
    array('name'=>'Sportif','iconurl'=>'/Images/Dish/salad.png'),
    array('name'=>'Sportif','iconurl'=>'/Images/Dish/salad.png'),
    array('name'=>'Sportif','iconurl'=>'/Images/Dish/salad.png'),
    array('name'=>'Sportif','iconurl'=>'/Images/Dish/salad.png'),);
?>

<div id="background">
    <div id="containerProfile" style="background-color:white">
        <div class="container-fluid">
            <!-- BUTTON EDIT SHOW ONLY IF IT IS THE CURRENT USER-->
            <?php if($isCurrentUser){?>
                <button id="edit" class="btn btn-primary" onclick="location.href='/profile/edit'">
                    <i class="fas fa-edit"></i> <span id="editProfileText">Modifier le profil</span>
                </button>
            <?php } ?>

            <div class="row">
                <div class="col-md-auto">
                    <div id="userphoto">
                        <?php include_once('UserPhoto.php'); ?>
                    </div>
                </div>
                <div id="containerName" class="col">
                    <span id="name"><?= $infoUser['lastname'] .' '. $infoUser['firstname']?></span>      
                </div>
            </div>

            <hr class="solid">

            <div class="row">
                <div class="col">
                    <div id="containerDescription">
                        <i class="fa fa-quote-left"></i> <?= $infoUser['description'] ?> <i class="fa fa-quote-right"></i>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <h5 class="titleSection">Information: </h5>
                    <div id="titleGeneralInfo">
                        <p>Age: </p>
                        <p>Sexe: </p>
                        <p>Ville:</p>
                    </div>
                    <div id="responseGeneralInfo">
                        <p><?= $infoUser['age']?> ans</p>
                        <p><?= $infoUser['sex']?></p>
                        <p><?= $infoUser['city'].' ('. $infoUser['zipcode']. ')' ?> </p>
                    </div>
                </div>

                <?php if(!empty($hobbies)) {?>
                <div class="col-md-8">
                    <div id="containerTitleHobby">
                        <h5 class="titleSection">Mes hobby: </h5>
                    </div>      
                    <?php foreach($hobbies as $hobby): ?>
                        <div class="containerHobby">
                            <?= $hobby['name'] ?>
                        </div>
                    <?php endforeach ?>
                </div>
                <?php } ?>
            </div>

            <div class="row" style="margin-top:40px">
                <?php if(!empty($personalities)) {?>
                    <div class ="col-md-auto">
                        <div id="personalities">
                        <h5 class="titleSection">Ma personnalité: </h5>
                            <?php foreach($personalities as $personality): ?>
                                <div class="card cardPersonality">
                                    <div class="cardImage">
                                        <img src=<?=$personality['iconurl']?> class="card-img-top" alt="...">
                                    </div>      
                                    <div class="card-header titleCardPerso"><?= $personality['name']?></div>
                                    <!-- <div class="card-body">
                                        <p class="card-text"><?= $personality['description']?></p>
                                    </div> -->
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="row" style="margin-top:40px">

                <?php if(!empty($favoriteDish)) {?>
                    <div class ="col-md-auto">
                        <div id="likeeat">
                            <h5 class="titleSection" >Mes plats préférés: </h5>
                            <?php foreach($favoriteDish as $favorite): ?>
                                <div class="card cardFavorite">
                                    <div class="cardImage">
                                        <img src=<?=$favorite['iconurl']?> class="card-img-top" alt="...">
                                    </div> 
                                    <div class="card-header titleCardPerso"><?= $favorite['name']?></div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>