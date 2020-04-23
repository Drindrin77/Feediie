<?php
$usersMatchedArray = $this->data["usersMatched"];
?>

<div class="container-fluid col-md-10">
    <div class="row">
        <div id="matchedUserContainer" class="col-md-3">
            <div class="container-fluid">
                <?php
                foreach ($usersMatchedArray as $matchedUser) {
                    ?>
                    <div class="row matchedUser align-items-center" data-uniqId="<?php echo $matchedUser['uniq_id'] ?>">
                        <img class="col-md-3 rounded-circle" src="<?php echo $matchedUser['photo_url'] ?>"
                             alt="Photo de profil de <?php echo $matchedUser["name"] ?>">
                        <span class="col-md-5"><?php echo $matchedUser["name"] ?></span>
                        <span class="col-md-4"><?php echo $matchedUser["age"] ?> ans</span>
                        <span class="col-md-12">Match le <?php echo $matchedUser["date_match"] ?> </span>
                    </div>

                    <?php
                }
                ?>
            </div>
        </div>
        <div class="border col-md-9">
            <div class="container-fluid">
                <a id="chatSelectedContact" class="border row align-items-center"
                   href="/profile/<?php echo $usersMatchedArray[0]['uniq_id'] ?>"
                   data-uniqId="<?php echo $usersMatchedArray[0]['uniq_id'] ?>">
                    <img class="col-2 rounded-circle" src="<?php echo $usersMatchedArray[0]['photo_url'] ?>">
                    <span class="col-8 offset-1"><?php echo $usersMatchedArray[0]["name"] ?></span>
                </a>
            </div>
        </div>
    </div>

</div>


