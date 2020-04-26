<?php
$usersMatchedArray = $this->data["usersMatched"];
?>

<div class="container-fluid col-md-10">
    <div class="row">
        <div id="matchedUserContainer" class="col-md-3">
            <div class="container-fluid">
                <?php
                $isFirst = true;
                foreach ($usersMatchedArray as $matchedUser) {
                    ?>
                    
                    
                    <div id="user-<?php echo $matchedUser['uniq_id'] ?>" class="row <?php echo $isFirst ?  "selectedMatchedUser" : "matchedUser" ?> align-items-center" data-uniqId="<?php echo $matchedUser['uniq_id'] ?>">
                        <img id="photo-<?php echo $matchedUser['uniq_id'] ?>" class="col-md-3 rounded-circle" src="<?php echo $matchedUser['photo_url'] ?>"
                             alt="Photo de profil de <?php echo $matchedUser["name"] ?>">
                        <span id="name-<?php echo $matchedUser['uniq_id'] ?>" class="col-md-5"><?php echo $matchedUser["name"] ?></span>
                        <span class="col-md-4"><?php echo $matchedUser["age"] ?> ans</span>
                        <span class="col-md-12">Match le <?php echo $matchedUser["date_match"] ?> </span>
                    </div>

                    <?php
                    $isFirst = false;
                }
                ?>
            </div>
        </div>
        <div class=" col-md-9">
            <div class="container-fluid">
                <a id="chatSelectedContact" class=" row align-items-center"
                   href="/profile/<?php echo $usersMatchedArray[0]['uniq_id'] ?>"
                   data-uniqId="<?php echo $usersMatchedArray[0]['uniq_id'] ?>">
                    <img id="selectedContactPhoto" class="col-2 rounded-circle" src="<?php echo $usersMatchedArray[0]['photo_url'] ?>">
                    <span id="selectedContactName" class="col-8 offset-1"><?php echo $usersMatchedArray[0]["name"] ?></span>
                </a>
                <div id="chatBox" class="row"></div>
                <div id="userMessageArea" class="row ">
                    <input class="col-10 form-control">
                    <button class="col-2 btn btn-primary" type="button">Envoyer</button>
                </div>
            </div>
        </div>
    </div>

</div>


