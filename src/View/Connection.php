
<?php
    include 'header.php';
    $mail = "";
    if(isset($_POST['email'])){
        $mail = $_POST['email'];
    }
?>
<div class="container col-xl-8">
    <div class="row">
        <div class="col">
            <img class="w-100" src="https://cdn.pratico-pratiques.com/app/uploads/sites/3/2018/08/20193108/gateau-mousse-aux-trois-chocolat.jpeg" alt="Gateau au chocolat">
        </div>
        <div class="col mt-4 mb-4">
            <div class="border rounded border-primary pl-4 pt-2">
                <form method="post" action="/verifyConnection" enctype="x-www-form-urlencoded">
                    <div class="form-group">
                        <!-- Connection-->
                        <label for="emailInput">Email</label>
                        <br>
                        <input type="email" id="email" required size="50" class="form-control w-75" placeholder="email@mail.com" value=<?php $mail?>>
                    </div>
                    <div class="form-group">
                        <label for="passwordInput">Mot de passe</label>
                        <br>
                        <input class="w-75" required type="password" id="password" placeholder="Mot de passe">
                    </div>
                    <input type="submit" id="btnSubmit" value="Connexion" required class="btn btn-primary"/>
                </form>

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
                            <form action="/forgottenPassword" enctype="x-www-form-urlencoded">
                                <label for="emailForgottenPassword">Email</label><br>
                                <input type="email" required placeholder="email@mail.com">
                                <button type="submit" class="btn btn-danger">Envoyer le mail</button>
                            </form>
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
            <div class="mt-4 p-4 border rounded border-primary">
                <p class="d-flex justify-content-center"> 
                    Pas encore de compte ? <a href="/register"> Inscrivez-vous</a> 
                </p>
            </div>
        </div>
    </div>
</div> 
<?php
    include 'footer.php';
?>