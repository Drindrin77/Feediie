<?php
    $cities = isset($this->data['cities']) ? $this->data['cities'] : null;
    $sexs = isset($this->data['sexs']) ? $this->data['sexs'] : null;
    $passwordPolicy = isset($this->data['policy']) ? $this->data['policy'] : null;
?>

<nav class="navbar navbar-light" id="navbarHead">
  <span class="navbar-brand mb-0 h1 mx-auto"><img src="/Images/Icon/logo.png" alt="Feediie" height=25px></span>
</nav>


<div class="container col-xl-8 justify-content-center">
    <a href="/" class="btn btn-primary mt-3" ><i class="fas fa-arrow-left"></i> Retour</a>
    <div class="col mt-4 mb-4">
        <div class="border rounded pl-4 pt-2" id="main" >
            
            <p class="error" id='createError' hidden>L'email est déjà utilisé</p>
            <p class="error" id='emailError' hidden>L'adresse mail n'est pas valide</p>
                <div class="form-group">
                    <label for="emailInput">Email</label>
                    <br>
                    <input type="email" id="email" name="email" required size="50" class="form-control w-75" placeholder="email@mail.com" value=<?php $mail?>>
                </div>
                <p class="error" id='passwordError' hidden>Le mot de passe n'est pas bien renseigné</p>
                <div class="form-group">
                    <label for="passwordInput">Mot de passe</label>
                    <span  id="passwordpopup" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" data-content=<?php echo "\"".$passwordPolicy."\"" ?>>
                        <i class="fas fa-info-circle"></i>
                    </span>
                    <br>
                    <input class="w-75" required type="password" name="password" id="password" placeholder="Mot de passe"><i id="seePassword" class="far fa-eye"></i>
                </div>
                <p class="error" id='matchPwdError' hidden>Les mots de passe n'est pas identique</p>
                <div class="form-group">
                    <label for="confirmedPassword">Confirmer le mot de passe</label>
                    <br>
                    <input class="w-75" required type="password" name="confirmedPassword" id="confirmedPassword" placeholder="Confirmation du mot de passe">
                </div>
                
                <p class="error" id='fNameError' hidden>Veuillez renseigner votre prénom/surnom </p>
                <div class="form-group">
                    <label for="firstName">Prénom</label>
                    <input type="text" id="firstname" required size="50" class="form-control w-50" placeholder="Prénom ou surnom">

                    <p class="error" id='birthdayError' hidden>La date n'a pas le bon format</p>

                    <div class='date' id='datetimepicker1'>
                        <label>Date de naissance:</label>
                        <input type='date' id="birthday" class="form-control w-50"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
               
                <div class="form-group">
                    
                </div>

                <p class="error" id='sexError' hidden>Le format ne correspond pas</p>
                <div class="form-group">
                    <label for="sex">Sexe: </label>
                    <select class="form-control custom-select w-25" id="sex">
                        <?php foreach($sexs as $sex): 
                            echo '<option value='.$sex['name'].'>'.$sex['name'].'</option>';
                        ?>
                        <?php endforeach ?>
                    </select>
                    <p class="error" id='cityError' hidden>Le format ne correspond pas</p>
                    <label class="mr-sm-2 m-3" for="city">Ville: </label>
                    <select class="custom-select mr-sm-2 w-25" id="city">
                        <?php foreach($cities as $city): ?>
                            <option value=<?= $city['idcity']?>><?= $city['name'].' ('. $city['zipcode']. ')' ?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <input type="button" id="btnSubmit" value="S'inscrire" required class="btn btn-primary m-3"/>
        </div>
    </div>
</div> 