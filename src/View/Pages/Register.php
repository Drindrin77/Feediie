<?php
    $cities = isset($this->data['cities']) ? $this->data['cities'] : null;
    $sexs = isset($this->data['sexs']) ? $this->data['sexs'] : null;
?>

<div class="container col-xl-8 justify-content-center">
    <div class="col mt-4 mb-4">
        <div class="border rounded border-primary pl-4 pt-2">
            
            <p class="error" id='matchError' hidden>L'email est déjà utilisé</p>
            <p class="error" id='emailError' hidden>L'adresse mail n'est pas valide</p>
                <div class="form-group">
                    <label for="emailInput">Email</label>
                    <br>
                    <input type="email" id="email" name="email" required size="50" class="form-control w-75" placeholder="email@mail.com" value=<?php $mail?>>
                </div>
                <div class="form-group">
                    <label for="passwordInput">Mot de passe</label>
                    <br>
                    <input class="w-75" required type="password" name="password" id="password" placeholder="Mot de passe">
                </div>

                <p class="error" id='passwordError' hidden>Le mot de passe n'est pas bien renseigné</p>
                <div class="form-group">
                    <label for="confirmedPasswordInput">Confirmer le mot de passe</label>
                    <br>
                    <input class="w-75" required type="password" name="confirmedPasswordInput" id="confirmedPasswordInput" placeholder="Confirmation du mot de passe">
                </div>

                <div class="form-group">
                    <label for="firstName">Prénom</label>
                    <br>
                    <input type="text" id="firstname" required size="50" class="form-control w-75">
                </div>

                <div class="form-group">
                    <label for="lastName">Nom</label>
                    <br>
                    <input type="text" id="name" required size="50" class="form-control w-75">
                </div>

                <div class="form-group">
                <div class=' date' id='datetimepicker1'>
                    <label>Date de naissance:</label>
                    <input type='date' id="birthday" class="form-control w-25"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                </div>

                <div class="form-group">
                <label for="sex"> Sexe:</label>
                    <select class="btn btn-secondary dropdown-toggle">
                        <?php foreach($sexs as $sex): ?>
                            <option><?= $sex['name']?></option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="form-group">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sexe
                        </button>

                        <div class="dropdown-menu" id="sex" aria-labelledby="dropdownMenuButton">
                            <?php foreach($sexs as $sex): ?>
                                <a class="dropdown-item"><?= $sex['name'] ?></a>
                            <?php endforeach?>
                        </div>
                    </div>
                </div>

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

                <input type="button" id="btnSubmit" value="Connexion" required class="btn btn-primary"/>
        </div>
    </div>
</div> 
