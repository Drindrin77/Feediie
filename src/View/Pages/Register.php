<?php
    $cities = isset($this->data['cities']) ? $this->data['cities'] : null;
    $sexs = isset($this->data['sexs']) ? $this->data['sexs'] : null;
    $passwordPolicy = isset($this->data['policy']) ? $this->data['policy'] : null;
?>

<div id="background" class="container-fluid">
    <div class="row justify-content-center" id="rowLogo">
        <div id="containerLogo">

            <img src="/Images/Icon/logofull.png" alt="Feediie" id="logo">

        </div>
    </div>

    <div class="row justify-content-center" id="rowRegister">


        <div class="col-lg-6 col-md-auto col-sm-auto" id="containerRegister">             

            <div class="row " id="rowTop">
                <div class="form-group col-lg-6 col-md-8 col-sm-11" id="containerEmail">
                    <p class="error" id='emailError' hidden>L'adresse mail n'est pas valide</p>
                    <p class="error" id='createError' hidden>L'email est déjà utilisé</p>
                    <label for="emailInput">Email</label>
                    <br>
                    <input type="email" id="email" name="email" required class="form-control" placeholder="email@mail.com" value=<?php $mail?>>
                </div>

                <div class="form-group col-lg-6 col-md-8 col-sm-11" id="containerName">
                    <p class="error" id='fNameError' hidden>Veuillez renseigner votre prénom/surnom </p>
                    <label for="firstName">Prénom</label>
                    <input type="text" id="firstname" required class="form-control" placeholder="Prénom ou surnom">
                </div>

            </div>

            <div class="row " id="rowMiddle">
                <div class="form-group col-lg-6 col-md-8 col-sm-11">
                    <p class="error" id='passwordError' hidden>Le mot de passe n'est pas bien renseigné</p>
                    <label for="passwordInput">Mot de passe</label>
                    <span  id="passwordpopup" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" data-content=<?php echo "\"".$passwordPolicy."\"" ?>>
                        <i class="fas fa-info-circle"></i>
                    </span>
                    <br>
                    <input required type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
                    <i id="seePassword" style="margin-left:5px" class="far fa-eye"></i>
                </div>
                <div class="form-group col-lg-6 col-md-8 col-sm-11">
                    <p class="error" id='matchPwdError' hidden>Les mots de passe n'est pas identique</p>
                    <label for="confirmedPassword">Confirmer le mot de passe</label>
                    <br>
                    <input required type="password" class="form-control" name="confirmedPassword" id="confirmedPassword" placeholder="Confirmation du mot de passe">
                </div>
            
            </div>

            <div class="row" id="rowBottom">
                
                <div class="form-group col-lg-6 col-md-8 col-sm-11">
                    <p class="error" id='birthdayError' hidden>La date n'a pas le bon format</p>

                    <div class='date' id='datetimepicker1'>
                        <label>Date de naissance:</label>
                        <input type='date' id="birthday" class="form-control"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
        

                <div class="form-group col-lg-6 col-md-8 col-sm-11">
                    <p class="error" id='sexError' hidden>Le format ne correspond pas</p>
                    <label for="sex">Sexe: </label>
                    <br>
                    <select class="form-control custom-select" id="sex">
                        <?php foreach($sexs as $sex): 
                            echo '<option value='.$sex['name'].'>'.$sex['name'].'</option>';
                        ?>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6 col-md-8 col-sm-11" id="containerCity">

                    <p class="error" id='cityError' hidden>Le format ne correspond pas</p>
                    <label for="city">Ville: </label>
                    <br>
                    <select class="custom-select" id="city">
                        <?php foreach($cities as $city): ?>
                            <option value=<?= $city['idcity']?>><?= $city['name'].' ('. $city['zipcode']. ')' ?></option>
                        <?php endforeach?>
                    </select>
                </div>


            </div>

            <input type="button" id="btnSubmit" value="S'inscrire" required class="btn btn-primary m-3"/>
        </div>
    </div> 

    <div class="row justify-content-center" >
        <div class="col-lg-6 col-md-6 col-sm-11" id="containerConnection">
            <p class="d-flex justify-content-center"> 
                Déjà un compte ? <a href="/" style="margin-left:5px;"> Connecte-toi</a> 
            </p>
        </div>
    </div>
</div>