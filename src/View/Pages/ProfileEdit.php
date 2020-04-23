<?php
    $infoUser = $this->data['user'];
    $hobbies = $this->data['hobbies'];
    $allHobbies = $this->data['allHobbies'];

    // $allHobbies = array(array('name'=>'Musique'),array('name'=>'Jeux-vidéos'),array('name'=>'Dessin')
    // ,array('name'=>'Badminton'),array('name'=>'Musique'),array('name'=>'Musique'));
    $allSexs = $this->data['allSexs'];
    $allCities = $this->data['allCities'];
    $personalities = $this->data['personalities'];
    $allPersonalities = $this->data['allPersonalities'];
    $favoriteDish = $this->data['favoriteDish'];
    $allDish = $this->data['allDish'];
    $photos = $this->data['photos'];
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
        

        <div id="navContentContainer">
            <div class="navContent" id="contentPhoto">
                <h3 class="titleSection">Mes photos</h3>
                <div class="row justify-content-center">
                <?php foreach($photos as $photo): ?>
                <div class="containerPhoto containerNotEmptyPhoto">
                    <?= '<img src="'.$photo['url'].'">'; ?>
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
                    <p>Nom: </p>
                    <p>Prénom: </p>
                    <p>Date <br>de naissance: </p>
                </div>
                <div id="responseGeneralInfo">
                    <p><?= '<input type="text" id="lastname" value="'.$infoUser['lastname'].'"'?></p>
                    <p><?= '<input type="text" id="firstname" value="'.$infoUser['firstname'].'"'?></p>
                    <p><?= '<input type="date" id="birthday" value="'.$infoUser['birthday'].'"'?></p>
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
                
                    <div class="" id='containerUnpracticedHobby'><?php
                        foreach($allHobbies as $hobby): 
                            echo '<div id='.$hobby['idhobby'].' class=\'containerHobby hobbiesUnpracticed\'>
                            <i class="fas fa-plus addHobbyIcon"></i><span> '.$hobby['name'].'</span>
                            </div>';
                        endforeach?>
                    </div>

                <div id="containerPracticedHobby">
                    <?php foreach($hobbies as $hobby): ?>
                        <div class="containerHobby practicedHobby" id="<?= $hobby['idhobby']?>">
                        <i class="fas fa-ban deleteHobbyIcon"></i><span><?= $hobby['name'] ?></span>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="navContent" id="contentPersonality">
                <?php if(!empty($personalities)) {?>
                <div id="personalities">
                    <h5 class="titleSection titleAddElement">Ma personnalité </h5> 
                    <button class="btn btn-primary btnAddElement"><i class="fas fa-plus"></i> Ajouter une personnalité</button>

                        <?php foreach($personalities as $personality): ?>
                        <div class="card">
                            <div class="cardImage">
                                <img src=<?=$personality['iconurl']?> class="card-img-top" alt="...">
                            </div>      
                            <div class="card-header titleCard"><?= $personality['name']?></div>
                        </div>
                    <?php endforeach ?>
                </div>
                <?php } ?>
            </div>
            <div class="navContent" id="contentDish">
            <?php if(!empty($favoriteDish)) {?>
                <div id="likeeat">
                    <h5 class="titleSection titleAddElement">Mes plats préférés </h5>
                    <button class="btn btn-primary btnAddElement"><i class="fas fa-plus"></i> Ajouter un plat</button>

                    <?php foreach($favoriteDish as $favorite): ?>
                        <div class="card cardFavorite">
                            <div class="cardImage">
                                <img src=<?=$favorite['iconurl']?> class="card-img-top" alt="...">
                            </div> 
                            <div class="card-header titleCard"><?= $favorite['name']?></div>
                        </div>
                    <?php endforeach ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>