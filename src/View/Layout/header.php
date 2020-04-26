<?php
    $firstName = $this->headerInfo['firstName'];
    $uniqID = $this->headerInfo['uniqID'];
    $photo = empty($this->headerInfo['photo'])?PATH_DEFAULT_USER_PHOTO:$this->headerInfo['photo']['url'];
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

    <ul class="navbar-nav mr-auto"></ul>
    <form class="form-inline my-2 my-lg-0">

        <button id="btnChat" type="button" style="margin-right: 50px" class="btn btn-primary">
            <i class="far fa-comments"></i>
            <div id="containerNotif">
                <span id="nbNotif">8</span>
            </div>
        </button>

        <div id="containerHeaderPhoto">
            <?php echo '<img id="headerProfilePhoto" onclick="window.location=\'/profile/'.$uniqID.'\';" src="'.$photo.'">';?>
        </div>

        <div id="dropdown" class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $firstName; ?>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <?php echo '<a class="dropdown-item" href="/profile/'.$uniqID.'">Voir le profil</a>';?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Se déconnecter</a>
                </div>
            </div>
        </div>

    </form>



        
    

</nav>