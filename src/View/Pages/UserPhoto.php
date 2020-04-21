<?php
  $photos = $this->data['photos'];
  $showOnlyFirst = isset($this->data['showOnlyFirst'])?$this->data['showOnlyFirst']:false;

  if(count($photos)>1 && !$showOnlyFirst){?>
      <div id="carouselPhoto" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <?php foreach($photos as $photo):

            if($photo['priority']===1){
              echo '<li data-target="#carouselPhoto" data-slide-to="0" class="active"></li>';
            }
            else{
              echo '<li data-target="#carouselPhoto" data-slide-to="1"></li>';
            }
            ?>
          <?php endforeach ?>
        </ol>
        <div class="carousel-inner">
          <?php foreach($photos as $photo):

              if($photo['priority']===1){
                echo '<div class="carousel-item active">';
              }
              else{
                echo '<div class="carousel-item">';
              }
                echo '<img class="d-block w-100" style="border-radius:15px;width:100%;heigth:auto;"src="'. $photo['url'].'">';
            ?>
            </div>
          <?php endforeach ?>
        </div>

        <a class="carousel-control-prev" href="#carouselPhoto" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselPhoto" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
  <?php

  }else{
      $photo = count($photos)==0? PATH_DEFAULT_USER_PHOTO: $photos[0]['url'];
      echo '<img style="width:100%" src="'.$photo.'">';
  }?>
