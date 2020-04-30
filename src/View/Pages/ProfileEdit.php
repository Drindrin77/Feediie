<?php
    $infoUser = $this->data['user'];
    $hobbies = $this->data['hobbies'];
    $allHobbies = $this->data['allHobbies'];
    $allSexs = $this->data['allSexs'];
    $allCities = $this->data['allCities'];
    $personalities = $this->data['personalities'];
    $allPersonalities = $this->data['allPersonalities'];
    $favoriteDish = $this->data['favoriteDish'];
    $allDish = $this->data['allDish'];
    $photos = $this->data['photos'];

    $passwordPolicy = isset($this->data['policy']) ? $this->data['policy'] : null;
?>

<div id="background">
    <div id="containerProfile">

        <button id="btnViewProfile" class="btn btn-primary" uniqID=<?= $infoUser['uniqid'] ?>>
            <i class="fas fa-reply"></i><span id="spanViewProfile"> Voir le profil</span>
        </button>
        

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <span class="nav-link active activeNav" id="firstTab" targetIDContent='contentPhoto'>Photo</span>
                </li>
                <li class="nav-item">
                    <span class="nav-link" targetIDContent='contentInfo'>Info</span>
                </li>
                <li class="nav-item">
                    <span class="nav-link" targetIDContent='contentHobby'>Hobby</span>
                </li>
                <li class="nav-item">
                    <span class="nav-link" targetIDContent='contentPersonality'>Personnalité</span>
                </li>
                <li class="nav-item">
                    <span class="nav-link" targetIDContent='contentDish'>Plats</span>
                </li>
            </ul>

            <div class="modal" id="modalResetPassword" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reinitialiser le mot de passe</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="passwordInput">Ancien mot de passe</label>
                                <br>
                                <input class="w-75" required type="password" id="oldPassword" name="password" placeholder="Mot de passe">
                                <br>
                                <span id="errorOldPassword" class="errorPassword invisible"></span>

                            </div>

                            <div class="form-group">
                                <label for="passwordInput">Nouveau mot de passe</label> 
                                <span  id="passwordpopup" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" data-content=<?php echo "\"".$passwordPolicy."\"" ?>>
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <br>
                                <input class="w-75" required type="password" id="newPassword" name="password" placeholder="Mot de passe">
                                <br>
                                <span id="errorNewPassword" class="errorPassword invisible"></span>
                            </div>
                            <div class="form-group">
                                <label for="confirmedPasswordInput">Confirmer le mot de passe</label>
                                <br>
                                <input class="w-75" required type="password" id="confirmPassword" name="confirmedPasswordInput" id="confirmedPasswordInput" placeholder="Confirmation du mot de passe">
                                <br>
                                <span id="errorConfirmPassword" class="errorPassword invisible"></span>
                            
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnConfirmReset" class="btn btn-primary">Confirmer</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
        

            <div class="modal"  id="modalConfirm" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Attention !</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Des données modifiées n'ont pas été sauvegardées. Etes-vous sûr de vouloir quitter cette page ?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"  data-dismiss="modal">Revoir les modifications</button>
                            <button type="button" class="btn btn-secondary" onclick="location.href = '/profile/<?= $infoUser['uniqid'];?>';" >Quitter la page</button>
                        </div>
                    </div>
                </div>
            </div>

        <div id="navContentContainer">
            <div class="navContent" id="contentPhoto">

                <h3 class="titleSection">Mes photos</h3>
                <?php
                if(empty($this->data['photos'])){
                    echo '<div id="alertEmptyPhoto" class="alert alert-warning" role="alert">
                        N\'hésitez pas à rajouter une photo ! Certaines personnes n\'apprécient pas le goût du risque !
                        </div>';
                }
            ?>
                <div class="alert alert-danger invisible" role="alert" id="alerteMsgErrorUpload">
                    
                </div>

                <div class="row justify-content-center" id="containerPhotos">
                    <?php foreach($photos as $photo): ?>
                    <div class="containerPhoto containerNotEmptyPhoto">
                        <img class="image" priority=<?= $photo['priority']?"true":"false"?> src=<?= $photo['url']?>>
                        
                        <div class="containerPriority" data-priority="<?= $photo['priority']?"true":"false"?>">
                            <i class="fa fa-star"></i>
                        </div>
                        
                        <div class="overlay"></div>

                        <div class="btnGroupPhoto">
                            <div class="containerBtnPhoto"><button class="btn btn-primary"><i class="fas fa-expand"></i></button></div>
                            <div class="containerBtnPhoto delete"><button class="btn btnTrash"><i class="fa fa-trash"></i></button></div>
                        </div>
                    </div>
                    <?php endforeach ?>

                    <?php for($i = count($photos); $i < MAX_USER_PHOTO; $i++){ ?>
                    <div class="containerPhoto containerEmptyPhoto">
                        <div class="emptyPhoto"></div>

                        <div class="containerSpinner invisible spinner-border text-primary" role="status"></div>

                        <div class="containerBtnAddPhoto">
                            <button class="btn btn-primary btnAddPhoto"><i class="fas fa-plus"></i> Ajouter une photo</button>
                        </div>

                    </div> <?php } ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="file" name="photo" id="uploadInput" style="display:none" />
                    </form>
                </div>
            </div>
            <div class="navContent" id="contentInfo">
                <h3 class="titleSection">Mes informations</h3>

                <div id="titleGeneralInfo">
                    <p>Prénom: </p>
                    <p>Date de naissance: </p>
                </div>
                <div id="responseGeneralInfo">
                    <p><?= '<input type="text" id="firstname" value="'.$infoUser['firstname'].'"'?></p>
                    <p><?= '<input type="date" id="birthday" value="'.$infoUser['birthday'].'"'?></p>
                    
                </div>

                <div>
                    <button id="btnOpenModalResetPassword" class="btn btn-primary">
                            Reinitialiser le mot de passe
                    </button>   
                </div>
                <div class="form-group" id="sex">
                    <label for="sexControl">Sexe</label>
                    <select class="form-control" id="sexControl">
                        <?php foreach($allSexs as $sex): 
                            if($infoUser['sex']==$sex['name']){
                                echo '<option selected>'.$sex['name'].'</option>';
                            }else{
                                echo '<option>'.$sex['name'].'</option>';
                            }
                        endforeach ?>
                    </select>
                </div>

                <div class="form-group" id="city">
                    <label class="labelSelect" for="cityControl">Ville</label>
                    <select class="form-control controlSelect" id="cityControl">
                        <?php foreach($allCities as $city): 
                            if($infoUser['city']==$city['name']){
                                echo '<option selected value='.$city['idcity'].'>'.$city['name'].' ('. $city['zipcode']. ')</option>';
                            }else{
                                echo '<option value='.$city['idcity'].'>'.$city['name'].' ('. $city['zipcode']. ')</option>';
                            }
                        endforeach ?>
                    </select>
                </div>
                <h5 class="titleSection">Description : </h5>                         

                <textarea class="form-control" id="description" rows="6"><?= $infoUser['description'] ?></textarea>
                <div class="btn btn-primary" id="submitInfo">Valider les modifications</div>
                <span class="clear"></span>

            </div>

            <div class="navContent" id="contentHobby">
                <h5 class="titleSection titleAddElement">Mes hobby: </h5> 

                <button type="button" class="btn btn-primary btnAddElement" id="btnHobbyPopOver"><i class="fas fa-plus"></i> Ajouter un hobby</button>
                
                <div id="containerUnpracticedHobby" class="invisible"><?php
                    foreach($allHobbies as $hobby): 
                        echo '<div id='.$hobby['idhobby'].' class=\'containerHobby hobbiesUnpracticed\'>
                        <i class="fas fa-plus addHobbyIcon"></i><span> '.$hobby['name'].'</span>
                        </div>';
                    endforeach?>
                </div>

                <div id="containerPracticedHobby">
                    <?php foreach($hobbies as $hobby): ?>
                        <div class="containerHobby practicedHobby" id="<?= $hobby['idhobby']?>">
                        <i class="fas fa-ban deleteHobbyIcon"></i><span> <?= $hobby['name'] ?></span>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="navContent" id="contentPersonality">
                <div id="personalities">
                    <h5 class="titleSection titleAddElement">Ma personnalité </h5> 
                    <button id="btnPersonalityPopOver" class="btn btn-primary btnAddElement"><i class="fas fa-plus"></i> Ajouter une personnalité</button>

                    <div style="margin-top:30px" id="containerUnusedPersonality" class="invisible"><?php
                        foreach($allPersonalities as $personality): ?>
                            <div class="card cardPersonality">
                                <div class="cardImage">
                                    <img src=<?=$personality['iconurl']?> class="card-img-top image" alt="...">
                                </div>
                                <div class="overlay"></div>
                                <div class="containerBtnOverlay containerAddBtn">
                                    <button data-url=<?=$personality['iconurl']?> data-name="<?= $personality['name']?>" data-iddish=<?=$personality['iddish']?> class="btn btnAdd addPersonality"><i class="fa fa-plus"></i> Ajouter</button>
                                </div>
                                <div class="card-header titleCard"><?= $personality['name']?></div>
                            </div>
                        <?php endforeach?>
                    </div>  

                    <div style="margin-top:30px"  id="containerUsedPersonality">
                        <?php foreach($personalities as $personality): ?>
                        <div class="card cardPersonality">
                            <div class="cardImage">
                                <img src=<?=$personality['iconurl']?> class="card-img-top image" alt="...">
                            </div>      
                            <div class="overlay"></div>
                            <div class="containerBtnOverlay containerDeleteBtn">
                                    <button data-url=<?=$personality['iconurl']?> data-name="<?= $personality['name']?>"  data-iddish=<?=$personality['iddish']?> class="btn btnDelete deletePersonality"><i class="fa fa-trash"></i> Supprimer</button>
                                </div>
                            <div class="card-header titleCard"><?= $personality['name']?></div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div class="navContent" id="contentDish">
                <div id="likeeat">
                    <h5 class="titleSection titleAddElement">Mes plats préférés </h5>
                    <button id="btnDishPopOver" class="btn btn-primary btnAddElement"><i class="fas fa-plus"></i> Ajouter un plat</button>

                    <div style="margin-top:30px" id="containerUnusedDish" class="invisible"><?php
                        foreach($allDish as $dish): ?>

                            <div class="card cardPersonality">
                                <div class="cardImage">
                                    <img src=<?=$dish['iconurl']?> class="card-img-top image" alt="...">
                                </div> 
                                <div class="overlay"></div>
                                <div class="containerBtnOverlay containerAddBtn">
                                    <button data-url=<?=$dish['iconurl']?> data-name="<?= $dish['name']?>"  data-iddish=<?=$dish['iddish']?> class="btn btnAdd addDish"><i class="fa fa-plus"></i> Ajouter</button>
                                </div>
                                <div class="card-header titleCard"><?= $dish['name']?></div>
                            </div>  
                        <?php endforeach?>
                    </div>  

                    <div style="margin-top:30px"  id="containerUsedDish">
                        <?php foreach($favoriteDish as $dish): ?>
                            <div class="card cardPersonality">
                                <div class="cardImage">
                                    <img src=<?=$dish['iconurl']?> class="card-img-top image" alt="...">
                                </div> 
                                <div class="overlay"></div>
                                <div class="containerBtnOverlay containerDeleteBtn">
                                    <button data-url=<?=$dish['iconurl']?> data-name="<?= $dish['name']?>" data-iddish=<?=$dish['iddish']?> class="btn btnDelete deleteDish"><i class="fa fa-trash"></i> Supprimer</button>
                                </div>

                                <div class="card-header titleCard"><?= $dish['name']?></div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>