<?php
    $firstName = $this->headerInfo['firstName'];
    $uniqID = $this->headerInfo['uniqID'];
    $isAdmin = $this->headerInfo['isAdmin'];
    $photo = $this->headerInfo['photo'];
    if(is_array($photo))
        $photo = $photo['url'];
?>


<nav id="navbar" class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="/">
        <img src="/Images/Icon/logo.png" width="150" height="30" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="true" aria-label="Toggle navigation">
        <i class="fa fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <?php if($isAdmin){ ?>
                <li class="nav-item">
                <a class="nav-link" href="/admin">Admin</a>
            </li>
            <?php } ?>  
        </ul>

        <form class="form-inline my-2 my-lg-0">


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary"  style="margin-right: 30px" data-toggle="modal" data-target="#modalIdea">
            <i class="fas fa-lightbulb"></i> Suggestion
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalIdea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Suggestion d'idée</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="alert alert-danger invisible" role="alert" id="alerteMsgError">
                        
                        </div>
                            <div class="form-group">
                                <textarea class="form-control" id="textIdea" rows="5" placeholder="Exemple: Ajout du hobby [nom] "></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnConfirm" class="btn btn-primary">Confirmer</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>


            <button id="btnChat" type="button" style="margin-right: 30px" class="btn btn-primary">
                <i class="far fa-comments"></i>
                <div id="containerNotif">
                    <span id="nbNotif">8</span>
                </div>
            </button>


            <div id="containerHeaderPhoto">
                <?php echo '<img id="headerProfilePhoto" onclick="window.location=\'/profile/'.$uniqID.'\';" src="'.$photo.'">';?>
            </div>

            <div id="dropdownProfilContainer" class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="btnDropdownProfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $firstName; ?>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <?php echo '<a class="dropdown-item" href="/profile/'.$uniqID.'">Voir le profil</a>';?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/connection/signout">Se déconnecter</a>
                    </div>
                </div>
            </div>

        </form>
 
    </div>
</nav>