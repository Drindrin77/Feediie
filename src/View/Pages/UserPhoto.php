<?php

class UserPhoto{

  private $photos;

  public function __construct($photos=null) {
    $this->photos = $photos;
  }
  public function setPhoto($photos){
    $this->photos = $photos;
  }
  
  public function render(){
    if(count($this->photos)>1){?>
      <div id="carouselPhoto" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <?php foreach($this->photos as $photo):
            if($photo['priority']===true){
              echo '<li data-target="#carouselPhoto" class="active"></li>';
            }
            else{
              echo '<li data-target="#carouselPhoto" ></li>';
            }
            ?>
          <?php endforeach ?>
        </ol>
        <div class="carousel-inner">
          <?php foreach($this->photos as $photo):
              if($photo['priority']===true){
                echo '<div class="carousel-item active">';
              }
              else{
                echo '<div class="carousel-item">';
              }
              echo '<img class="w-100 h-100" src="'.$photo['url'].'">';
            ?>
            </div>
          <?php endforeach ?>
        </div>

        <a class="carousel-control-prev" href="#carouselPhoto" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#carouselPhoto" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>

        </a>
      </div>

    <?php }else{
      $url = count($this->photos)==0? PATH_DEFAULT_USER_PHOTO: $this->photos[0]['url'];
      echo '<img style="height:100%; width:100%;border-radius:30px" src="'.$url.'">';
    }
  }

}

