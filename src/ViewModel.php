<?php

class ViewModel {
    
    /**
     * @var string
     */
    private $viewPath;

    /**
     * @var array
     */
    private $data;

    /**
     * @var array
     */
    private $currentUser;

    public function __construct($viewPath, $data=null)
    {
        $this->viewPath = $viewPath;
        $this->data = $data;
    }

    public function setUser($user)
    {
        $this->currentUser = $user;
        return $this;
    }

    public function render()
    {
        ?>

        <html>
        
        <head>
          <title>Feediie</title>
        </head>
        
        <body>
          
          <?php 
          if ($this->shouldShowHeaders()) {
            include_once 'View/Layout/header.php'; 
          }
          ?>
          <div class="pageContainer">
            <?php include_once 'View/'.$this->viewPath.'.php' ?>
          </div>
          <?php
          if ($this->shouldShowHeaders()) {
            include_once 'View/Layout/footer.php';
          }
          ?>
        </html>
        <?php
    }
    
    private function shouldShowHeaders()
    {
        //return $this->currentUser !== null;
        return true;
    }



}