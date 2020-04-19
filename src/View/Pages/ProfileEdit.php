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
?>

<div class="container">
    <div class="row justify-content-md-center">
        <div>
            <h3>Mes photos</h3>
            <?php foreach($photos as $photo): ?>
                <div class="containerPhoto">
                    <?= '<img src="'.$photo['url'].'">'; ?>
                    <div class="overlay"></div>
                    <div class="btnGroupPhoto">
                        <div class="containerBtnPhoto"><button class="btn btn-primary"><i class="fas fa-expand"></i></button></div>
                        <div class="containerBtnPhoto delete"><button class="btn btnTrash"><i class="fa fa-trash"></i></button></div>
                    </div>
                </div>
            <?php endforeach ?>
            <?php for($i = count($photos); $i < MAX_USER_PHOTO; $i++){ ?>
                <div class="containerPhoto">
                    <div class="emptyPhoto"></div>
                    <div class="containerBtnAddPhoto">
                        <button class="btn btn-primary btnAddPhoto"><i class="fas fa-plus"></i> Ajouter une photo</button>
                    </div>
                </div>
            <?php } ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="photo" id="uploadInput" style="display:none" />
            </form>
        </div>
    </div>

    <div class="row">
        <div id="info" style="border: 1px solid red">
            <h3>Mes informations</h3>
            <p>Nom : <?= '<input type="text" id="lastname" value="'.$infoUser['lastname'].'"'?></p>
            <p>Prenom : <?= '<input type="text" id="firstname" value="'.$infoUser['firstname'].'"'?></p>
            <p>Date de naissance: <?= '<input type="date" id="birthday" value="'.$infoUser['birthday'].'"'?></p>
            <p>description : <?= '<input type="textarea" id="description" value="'.$infoUser['description'].'"'?></p>


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
                <label for="cityControl">Ville</label>
                <select class="form-control" id="cityControl">
                    <?php foreach($allCities as $city): 
                        if($infoUser['city']==$city['name']){
                            echo '<option selected>'.$city['name'].' ('. $city['zipcode']. ')</option>';
                        }else{
                            echo '<option>'.$city['name'].' ('. $city['zipcode']. ')</option>';
                        }
                    endforeach ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
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
    </div>

    <div class="row">

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
    </div>
    <div class="row">

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
</div>