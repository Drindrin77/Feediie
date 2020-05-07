<?php

class UserDetails{

  private $user;

  public function __construct($user=null) {
    $this->user = $user;
  }
  public function setUser($user){
    $this->user = $user;
  }
  
  public function render(){

      ?>

        <link rel="stylesheet" href="/Style/UserDetails.css">

        <div class="row" style="margin-top: 15px;"> 
            <div class="col">
                <div id="containerDescription" style="word-wrap:break-word">
                    <i class="fa fa-quote-left"></i> <?= $this->user['description'] ?> <i class="fa fa-quote-right"></i>
                </div>
            </div>
        </div>

        <div class="row">
                <div class="col-md-auto">
                    <h5 class="titleSection">Information: </h5>
                    <div id="titleGeneralInfo">
                        <p>Age: </p>
                        <p>Sexe: </p>
                        <p>Ville:</p>
                    </div>
                    <div id="responseGeneralInfo">
                        <p><?= $this->user['age']==null? '-':$this->user['age']. ' ans'?></p>
                        <p><?= $this->user['sex']==null? '-':$this->user['sex'] ?></p>
                        <p><?= $this->user['city']==null? '-': $this->user['city'].' ('. $this->user['zipcode']. ')' ?> </p>
                    </div>
                </div>

                <?php if(!empty($this->user['hobbies'] )) {?>
                <div class="col-md-12">
                    <div id="containerTitleHobby">
                        <h5 class="titleSection">Mes hobby: </h5>
                    </div>      
                    <?php foreach($this->user['hobbies'] as $hobby): ?>
                        <div class="containerHobby">
                            <?= $hobby['name'] ?>
                        </div>
                    <?php endforeach ?>
                </div>
                <?php } ?>
            </div>

            <div class="row" style="margin-top:40px">
                <?php if(!empty($this->user['diets'])) {?>
                    <div class="col">
                        <div id="containerTitleHobby">
                            <h5 class="titleSection">Mes régimes alimentaires: </h5>
                        </div>      
                        <?php foreach($this->user['diets'] as $diet): ?>
                            <div class="containerDiet">
                                <?= $diet ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php } ?>
            </div>

            <div class="row" style="margin-top:40px">
                <?php if(!empty($this->user['personalities'])) {?>
                    <div class ="col-md-auto">
                        <div id="personalities">
                        <h5 class="titleSection">Ma personnalité: </h5>
                            <?php foreach($this->user['personalities'] as $personality): ?>
                                <div class="card cardPersonality">
                                    <div class="cardImage">
                                        <img class="image" src=<?=$personality['iconurl']?> class="card-img-top" alt="...">
                                    </div>      
                                    <div class="card-header titleCard"><?= $personality['name']?></div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="row" style="margin-top:40px">

                <?php if(!empty($this->user['favoriteDish'])) {?>
                    <div class ="col-md-auto">
                        <div id="likeeat">
                            <h5 class="titleSection" >Mes plats préférés: </h5>
                            <?php foreach($this->user['favoriteDish'] as $favorite): ?>
                                <div class="card cardFavorite">
                                    <div class="cardImage">
                                        <img class="image" src=<?=$favorite['iconurl']?> class="card-img-top" alt="...">
                                    </div> 
                                    <div class="card-header titleCard"><?= $favorite['name']?></div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
    <?php

    }

}
?>

