<?php

class ViewModel {

    private $page;
    private $title;
    private $path = '/var/www/html/src/View/';
    private $data;
    private $headerInfo;

    public function __construct($page, $data=null, $title='Feediie')
    {
        $this->page = $page;
        $this->title = $title;
        $this->data = $data;
    }

    public function render(){
        ?>

        <html>

          <head>

              <!-- Required meta tags -->
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

              <!-- Bootstrap CSS -->
              <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
                    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
                    crossorigin="anonymous">

              <!-- ICON -->
              <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
                integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

           <style>
                <?php 
                  if(file_exists($this->path.'Style/'.$this->page.'.css')){
                    include 'Style/'.$this->page.'.css';
                  }
                  if($this->shouldShowHeaders()){
                    include 'Style/header.css';
                  }
                ?>
              </style>


            <title><?= $this->title ?></title>
          </head>

          <body>
            
            <?php 
            if ($this->shouldShowHeaders()) {
              include_once 'Layout/header.php'; 
            }
            ?>
            <div class="pageContainer">
              <?php include 'Pages/'.$this->page.'.php' ?>
            </div>

            <?php
              if ($this->shouldShowHeaders()) {
               // include_once 'Layout/footer.php';
              }
            ?>

          </body>



              <!-- $.post needed -->
              <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

          <!-- jQuery first, then Popper.js, then Bootstrap JS -->

          <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
          <script src="http:////cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
          <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
          <script>
                <?php 
                  if(file_exists($this->path.'Script/'.$this->page.'.js')){
                   // echo '<script src="'.$this->path.'Script/'.$this->page.'.js">';
                    include 'Script/'.$this->page.'.js';
                  }
                  if($this->shouldShowHeaders()){
                    include 'Script/header.js';
                  }
                ?>
              </script>  
 
        </html>
    <?php
    }

    private function shouldShowHeaders()
    {
        if(AuthService::isAuthenticated()){
          $user = AuthService::getCurrentUser();
          $this->headerInfo = array('firstName'=>$user['firstname'], 
                                    'photo'=>PhotoModel::getPriorityPhoto($user['iduser']),
                                    'uniqID'=> $user['uniqid']);
          return true;
        }
        return false;
    }
}
?>