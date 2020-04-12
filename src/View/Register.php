<?php
    $mail = "";
    if(isset($_GET['email'])){
        $mail = $_GET['email'];
    }
?>
<div class="container col-xl-8 justify-content-center">
    <div class="col mt-4 mb-4">
        <div class="border rounded border-primary pl-4 pt-2">
            <form method="post" action="/Register/addUser" enctype="x-www-form-urlencoded">
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
                <div class="form-group">
                    <label for="confirmedPasswordInput">Mot de passe</label>
                    <br>
                    <input class="w-75" required type="password" name="confirmedPasswordInput" id="confirmedPasswordInput" placeholder="Confirmation du mot de passe">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                    <label class="form-check-label" for="rememberMe">Se rappeler de moi</label>
                </div>
                <input type="submit" id="btnSubmit" value="Connexion" required class="btn btn-primary"/>
            </form>
        </div>
    </div>
</div> 