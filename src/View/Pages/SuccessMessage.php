<?php
class SuccessMessage{

    public function __construct() {
    }

    public function render(){?>
        <div id="containerMessageSuccess">
            <div id="subContainerMessageSuccess">
                <div id="containerImgSuccess">
                    <img id="image" src="/Images/Icon/success.png">
                </div>
                <span id="messageSuccess" ></span>
            </div>
        </div>
<?php
    }

}?>

