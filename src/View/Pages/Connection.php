<!-- <nav class="navbar navbar-light" id="navbarHead">
  <span class="navbar-brand mb-0 h1 mx-auto"><img src="/Images/Icon/logo.png" alt="Feediie" height=25px></span>
</nav> -->

<?php
    $relations = $this->data['relations'];
?>

<div  id="background" class="container-fluid">
    <div class="row justify-content-center" id="rowLogo">
        <div id="containerLogo">

            <img src="/Images/Icon/logofull.png" alt="Feediie">

        </div>
    </div>

    <div class="row justify-content-center" id="rowBottom">

        <div class="col-lg-5 col-md-9" id="colRelations">
            <div>
                <div id="containerTitleRelation">
                    <h3 class="title">Commande ce qu'il te plait !</h3>
                </div>
                    <?php 
                        foreach($relations as $relation){?>
                        <div class="containerRelation row">
                            <div class="col-md-auto">
                                <div class="containerRelationImg">
                                    <img src="<?= $relation['iconurl']?>" />
                                </div>
                            </div>
                            <div class="containerDescriptionRelation col">
                                <h3><?= $relation['name']?></h3>
                                <p><?= $relation['description']?></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-9" id="containerBottom">
            <div class="containerConnection">
                <h3 class="title">Se connecter</h3>
                
                <p class="error" id='matchError' hidden>L'email ou le mot de passe est incorrect</p>
                <p class="error" id='emailError' hidden>L'adresse mail n'est pas valide</p>
                <div class="form-group inputs">
                    <!-- Connection-->
                    <label for="emailInput">Email</label>
                    <br>
                    <input type="email" id="email" name="email" required class="form-control" placeholder="email@mail.com">
                
                </div>
                <p class="error" id='passwordError' hidden>Veuillez renseigner votre mot de passe</p>
                <div class="form-group inputs">
                    <label for="passwordInput">Mot de passe</label>
                    <br>
                    <div class="passwordContainer">
                        <input required type="password" name="password" class="form-control" id="password" placeholder="Mot de passe">
                        <i id="seePassword" class="far fa-eye"></i>
                    </div>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                    <label class="form-check-label" for="rememberMe">Se rappeler de moi</label>
                </div>

                <input type="submit" id="btnSubmit" value="Connexion" required class="btn btn-primary"/>

                <div class="modal fade" id="forgottenPassword" tabindex="-1" role="dialog" aria-labelledby="forgottenPassword" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Mot de passe oublié</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label for="emailForgottenPassword">Email</label><br>
                                <input type="email" name="emailForgotten" id="emailForgotten" required placeholder="email@mail.com">
                                <button type="submit" id="btnForgotten" class="btn btn-danger">Envoyer le mail</button>
                            </div>
                            <div class="modal-footer"></div>
                        </div>
                    </div>
                </div>
                <p class="p-3">
                    <small type="button" class="" data-toggle="modal" data-target="#forgottenPassword" style="border: none;text-decoration: underline;color: blue;">
                        Mot de passe oublié ?
                    </small>
                </p>
            </div>
            <div class="mt-4 p-4 border rounded bg-light" style="margin-bottom:30px;">
                <p class="d-flex justify-content-center"> 
                    Pas encore de compte ? <a href="/register" style="margin-left:5px;"> Inscris-toi</a> 
                </p>
            </div>

        </div>
    </div>
</div>