<?php
    $isCurrentUser = $this->data['isCurrentUser'];
    $infoUser = $this->data['user'];
    $hobbies = $this->data['hobbies'];
    $personalities = $this->data['personalities'];
    $favoriteDish = $this->data['favoriteDish'];
    $diets = $this->data['diets'];
    include_once('../src/View/Pages/UserPhoto.php');
    $userPhoto = new UserPhoto($this->data['photos']);
?>

<div id="background">
    <div id="containerProfile">
        <div class="container-fluid">
            <!-- BUTTON EDIT SHOW ONLY IF IT IS THE CURRENT USER-->
            <?php if($isCurrentUser){?>
                <button id="edit" class="feediieBtn btn btn-primary" onclick="location.href='/profile/edit'">
                    <i class="fas fa-edit"></i> <span id="editProfileText">Modifier le profil</span>
                </button>
            <?php } ?>




            <div class="modal" id="modalphoto" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <?php $userPhoto->render() ?>
                        </div>
                    </div>
                </div>
            </div>

                


            <div class="row">
                <div class="col-md-auto">
                    <div id="userphoto">
                        <?php $userPhoto->render() ?>
                    </div>
                </div>
                <div id="containerName" class="col">
                    <span id="name"><?= $infoUser['firstname']?></span>      
                </div>
            </div>

            <?php
                if(empty($this->data['photos']) && $isCurrentUser){
                    echo '<div class="alert alert-warning" role="alert">
                        N\'hésitez pas à rajouter une photo ! Certaines personnes n\'apprécient pas le goût du risque !
                        </div>';
                }
            ?>

            <div class="row" style="margin-top: 15px;"> 
                <div class="col">
                    <div id="containerDescription" style="word-wrap:break-word">
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
                        <p><?= $infoUser['age']==null? '-':$infoUser['age']. ' ans'?></p>
                        <p><?= $infoUser['sex']==null? '-':$infoUser['sex'] ?></p>
                        <p><?= $infoUser['city']==null? '-': $infoUser['city'].' ('. $infoUser['zipcode']. ')' ?> </p>
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
                <?php if(!empty($diets)) {?>
                    <div class="col">
                        <div id="containerTitleHobby">
                            <h5 class="titleSection">Mes régimes alimentaires: </h5>
                        </div>      
                        <?php foreach($diets as $diet): ?>
                            <div class="containerDiet">
                                <?= $diet ?>
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
                                        <img class="image" src=<?=$personality['iconurl']?> class="card-img-top" alt="...">
                                    </div>      
                                    <div class="card-header titleCard"><?= $personality['name']?></div>
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
                                        <img class="image" src=<?=$favorite['iconurl']?> class="card-img-top" alt="...">
                                    </div> 
                                    <div class="card-header titleCard"><?= $favorite['name']?></div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>