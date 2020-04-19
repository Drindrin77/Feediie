<?php
    $cities = isset($this->data['cities']) ? $this->data['cities'] : null;
    $sexs = isset($this->data['sexs']) ? $this->data['sexs'] : null;
?>

<div class="container col-xl-8 justify-content-center">
    <div class="col mt-4 mb-4">
        <div class="border rounded border-primary pl-4 pt-2">
            
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
                    <br>
                    <input class="w-75" required type="password" name="password" id="password" placeholder="Mot de passe">
                </div>
                <p class="error" id='matchPwdError' hidden>Les mots de passe n'est pas identique</p>
                <div class="form-group">
                    <label for="confirmedPassword">Confirmer le mot de passe</label>
                    <br>
                    <input class="w-75" required type="password" name="confirmedPassword" id="confirmedPassword" placeholder="Confirmation du mot de passe">
                </div>

                <p class="error" id='fNameError' hidden>Veuillez renseigner votre prénom </p>
                <div class="form-group">
                    <label for="firstName">Prénom</label>
                    <br>
                    <input type="text" id="firstname" required size="50" class="form-control w-75">
                </div>

                <p class="error" id='nameError' hidden>Veuillez renseigner votre nom </p>
                <div class="form-group">
                    <label for="lastName">Nom</label>
                    <br>
                    <input type="text" id="name" required size="50" class="form-control w-75">
                </div>

                <p class="error" id='birthdayError' hidden>La date n'a pas le bon format</p>
                <div class="form-group">
                <div class=' date' id='datetimepicker1'>
                    <label>Date de naissance:</label>
                    <input type='date' id="birthday" class="form-control w-25"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                </div>

                <p class="error" id='sexError' hidden>Le format ne correspond pas</p>
                <div class="form-group" id="sex">
                    <label for="sex">Sexe: </label>
                    <select class="form-control custom-select w-25" id="sex">
                        <?php foreach($sexs as $sex): 
                            echo '<option value='.$sex['name'].'>'.$sex['name'].'</option>';
                        ?>
                        <?php endforeach ?>
                    </select>
                </div>

                <p class="error" id='cityError' hidden>Le format ne correspond pas</p>
                <div class="form-group">
                    <div class="col-auto my-1">
                    <label class="mr-sm-2" for="city">Ville: </label>
                    <select class="custom-select mr-sm-2 w-50" id="city">
                        <?php foreach($cities as $city): ?>
                            <option value=<?= $city['idcity']?>><?= $city['name'].' ('. $city['zipcode']. ')' ?></option>
                        <?php endforeach?>
                    </select>
                    </div>
                </div>

                <input type="button" id="btnSubmit" value="S'inscrire" required class="btn btn-primary m-3"/>
        </div>
    </div>
</div> 
