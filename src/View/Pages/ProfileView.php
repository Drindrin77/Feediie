<?php
    $isCurrentUser = $this->data['isCurrentUser'];
    $user = $this->data['user'];
    
    include_once('../src/View/Pages/UserPhoto.php');
    $userPhoto = new UserPhoto($user['photos']);

    include_once('../src/View/Pages/UserDetails.php');
    $userDetails = new UserDetails($user);
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
                    <span id="name"><?= $user['firstname']?></span>      
                </div>
            </div>

            <?php
                if(empty($user['photos']) && $isCurrentUser){
                    echo '<div class="alert alert-warning" role="alert">
                        N\'hésitez pas à rajouter une photo ! Certaines personnes n\'apprécient pas le goût du risque !
                        </div>';
                }
            ?>

            <div>
                <?php $userDetails->render() ?>
            </div>


        </div>
    </div>
</div>