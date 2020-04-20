<?php
$users = isset($this->data['users']) && !empty($this->data['users']) ? $this->data['users'] : null;

?>
<?php foreach($users as $user ): ?>
<div><?= $user['firstname'] ?> à <?= date_diff(date_create(($user['birthday'])), date_create('today'))->y ?> ans</div>
<?php endforeach?>

<div class="container-fluid background">
    <div class="container">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-3 swipe">
                <div id="card">
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div id="blockButtons">
                    <div id="beurk" class="buttons"><img src="/Images/Icon/beurk.png" alt=""/></div>
                    <div id="miam" class="buttons"><img src="/Images/Icon/miam.png" alt=""/></div>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>

</div>
