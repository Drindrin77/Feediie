<?php

class ViewModel {

    private $page;
    private $title;
    private $data;
    private $headerInfo;
    private $showHeader = false;

    public function __construct($page, $data=null, $title='Feediie')
    {
        $this->page = $page;
        $this->title = $title;
        $this->data = $data;
        if(AuthService::isAuthenticated()){
          $this->showHeader = true;
          $this->setHeaderInfo();
        }
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
                  if(file_exists('Style/'.$this->page.'.css')){
                    //echo '<link rel="stylesheet" href="/Style/'.$this->page.'.css">';
                    include_once('Style/'.$this->page.'.css');
                  }
                  if($this->showHeader){
                    //echo '<link rel="stylesheet" href="/Style/header.css">';
                    include_once('Style/header.css');
                    include_once('Style/footer.css');
                  }
                ?>
                </style>
              <title><?= $this->title ?></title>
          </head>

          <body>
            
            <?php 
            if ($this->showHeader) {
              include_once 'Layout/header.php'; 
            }
            ?>
            <div id="pageContainer">
              <?php include 'Pages/'.$this->page.'.php' ?>
            </div>

            <?php
              if ($this->showHeader) {
                include_once 'Layout/footer.php';
              }
            ?>

          </body>

              <!-- $.post needed -->
              <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

          <!-- jQuery first, then Popper.js, then Bootstrap JS -->

              <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
                      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
                      crossorigin="anonymous"></script>
                      
              <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

              <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                      crossorigin="anonymous"></script>

              <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
                      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
                      crossorigin="anonymous"></script>

                <script>

                  
                <?php 

                  if(file_exists('Script/'.$this->page.'.js')){
                    include_once('Script/'.$this->page.'.js');
                    
                    //echo '<script type="text/javascript"  src="/Script/'.$this->page.'.js"></script>';
                  }
                  if($this->showHeader){
                    //echo '<script type="text/javascript" src="/Script/header.js"></script>';
                    include_once('Script/footer.js');
                  }
                  ?>
                  </script>

        </html>
    <?php
    }

    private function setHeaderInfo(){
      $user = AuthService::getCurrentUser();
      $this->headerInfo = array('firstName'=>$user['firstname'], 
                                'photo'=>PhotoModel::getPriorityPhoto($user['iduser']),
                                'uniqID'=> $user['uniqid']);
    }
}
?>