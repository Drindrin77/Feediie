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

    public function __construct($viewPath, $data)
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
            include_once '../src/View/Layout/header.php'; 
          }
          ?>
          <div class="pageContainer">
            <?php include_once '../src/View/'.$this->viewPath.'.php' ?>
          </div>
          <?php
          if ($this->shouldShowHeaders()) {
            include_once '../src/View/Layout/footer.php';
          }
          ?>
        </html>
        <?php
    }
    
    private function shouldShowHeaders()
    {
        return $this->currentUser !== null;
    }



}