<?php
  $photos = $this->data['photos'];
?>

<?php 
  if(count($photos)>1){?>
      <div id="carouselPhoto" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <?php foreach($photos as $photo):

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
          <?php foreach($photos as $photo):

              if($photo['priority']===true){
                echo '<div class="carousel-item active">';
              }
              else{
                echo '<div class="carousel-item">';
              }
                echo '<img style="height:100%; width:100%" src="'. $photo['url'].'">';
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


  <?php }else{
    $url = count($photos)==0? PATH_DEFAULT_USER_PHOTO: $photos[0]['url'];
    echo '<img style="height:100%; width:100%" src="'.$url.'">';
  }

