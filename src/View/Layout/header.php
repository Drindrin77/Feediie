<?php
    $firstName = $this->headerInfo['firstName'];
    $uniqID = $this->headerInfo['uniqID'];
    $photo = empty($this->headerInfo['photo'])?PATH_DEFAULT_USER_PHOTO:$this->headerInfo['photo']['url'];
?>


<nav class="navbar navbar-expand-lg" style="background-color: orange">
    <nav class="navbar">
    <a class="navbar-brand" href="/">
        <img src="/Images/Icon/logo.png" width="150" height="30" class="d-inline-block align-top" alt="">
    </a>
    </nav>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>


    <button type="button" style="margin-right: 50px" class="btn btn-primary">
        Chat <span class="badge badge-light">9</span>
        <span class="sr-only">unread messages</span>
    </button>


    <div id="parent">
        <div id="photo" style="width:50px; height:50px">
            <?php echo '<img style="width:100%" src="'.$photo.'">';?>
        </div>

        <div id="dropdown" class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $firstName; ?>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <?php echo '<a class="dropdown-item" href="/profile/'.$uniqID.'">Voir le profil</a>';?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/connection/signout">Se déconnecter</a>
                </div>
            </div>
        </div>
    </div>
    
</nav>

<style>
#photo,#dropdown{
    display:inline-block;
    vertical-align: bottom;
}

</style>