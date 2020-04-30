<nav class="navbar navbar-light" id="navbarHead">
  <span class="navbar-brand mb-0 h1 mx-auto"><img src="/Images/Icon/logo.png" alt="Feediie" height=25px></span>
</nav>

<div class="container col-xl-8">
    <div class="row h-100">
            <p class="w-100 text-center h1 pt-4" id="slogan">Trouve ton plat ! Miam !</p>
        <div class="col mt-4 mb-4">
            <div class="border rounded bg-light pl-4 pt-2">
            
            <p class="error" id='matchError' hidden>L'email ou le mot de passe est incorrect</p>
            <p class="error" id='emailError' hidden>L'adresse mail n'est pas valide</p>
                <div class="form-group">
                    <!-- Connection-->
                    <label for="emailInput">Email</label>
                    <br>
                    <input type="email" id="email" name="email" required size="50" class="form-control w-75" placeholder="email@mail.com">
                
                </div>
                <p class="error" id='passwordError' hidden>Veuillez renseigner votre mot de passe</p>
                <div class="form-group">
                    <label for="passwordInput">Mot de passe</label>
                    <br>
                    <input class="w-75" required type="password" name="password" id="password" placeholder="Mot de passe"><i id="seePassword" class="far fa-eye"></i>
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
                        <div class="modal-footer">
                        </div>
                        </div>
                    </div>
                </div>
                <p class="p-3">
                    <small type="button" class="" data-toggle="modal" data-target="#forgottenPassword" style="border: none;text-decoration: underline;color: blue;">
                        Mot de passe oublié ?
                    </small>
                </p>
            </div>
            <div class="mt-4 p-4 border rounded bg-light">
                <p class="d-flex justify-content-center"> 
                    Pas encore de compte ? <a href="/register"> Inscrivez-vous</a> 
                </p>
            </div>
        </div>
    </div>
</div> 