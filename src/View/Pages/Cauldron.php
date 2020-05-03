<?php
$usersMatchedArray = $this->data["usersMatched"];
$defaultDiscussion = $this->data["defaultDiscussion"];
$userUniqId = $this->data["uniqId"];
$userPhoto = $this->data["userPhoto"];

if (sizeof($usersMatchedArray) === 0) {
    ?>
    <span>Vous n'avez aucun match pour le moment</span>
    <?php
} else {


    ?>


    <div class="container-fluid col-md-10">
        <div class="row">
            <div id="matchedUserContainer" class="col-md-3">
                <div id="matchedUserList" class="container-fluid">
                    <?php
                    $isFirst = true;
                    foreach ($usersMatchedArray as $matchedUser) {
                        ?>
                        <div id="user-<?php echo $matchedUser['uniq_id'] ?>"
                             class="row <?php echo $isFirst ? "selectedMatchedUser" : "matchedUser" ?> align-items-center"
                             data-uniqId="<?php echo $matchedUser['uniq_id'] ?>"
                             data-matchDate="<?php echo $matchedUser["date_match"] ?>"
                             data-age="<?php echo $matchedUser["age"] ?>">
                            <div class="col-3">
                                <img id="photo-<?php echo $matchedUser['uniq_id'] ?>"
                                     src="<?php echo $matchedUser['photo_url'] ?>"
                                     alt="Photo de profil de <?php echo $matchedUser["name"] ?>">
                            </div>
                            <span id="name-<?php echo $matchedUser['uniq_id'] ?>"
                                  class="col-7"><?php echo $matchedUser["name"] ?></span>


                            <?php

                            $messageNumber = $matchedUser["unreadmessages"];
                            ?>
                            <div id="notif-<?php echo $matchedUser['uniq_id'] ?>"
                                 class="col-2 <?php echo $messageNumber === 0 || $isFirst ? 'invisible' : 'visible' ?>">
                                <span class="matchNotification"><?php echo $messageNumber ?></span>
                            </div>


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
                        <div class="col-2">
                            <img id="selectedContactPhoto"
                                 src="<?php echo $usersMatchedArray[0]['photo_url'] ?>">
                        </div>
                        <span id="selectedContactName"
                              class="col-3"><?php echo $usersMatchedArray[0]["name"] ?>
                        </span> <span id="selectedContactAge"
                                      class="col-2"><?php echo $usersMatchedArray[0]["age"] ?> ans</span>
                        <span id="selectedContactMatchDate"
                              class="col-4">Match le <?php echo $usersMatchedArray[0]["date_match"] ?></span>
                    </a>
                    <div id="chatBox" class="row">
                        <div id="messageListContainer" class="container-fluid">
                            <?php
                            for ($i = sizeof($defaultDiscussion) - 1; $i >= 0; $i--) {
                                $message = $defaultDiscussion[$i];

                                if ($message["uniqid"] === $userUniqId) { //si utilisateur courant
                                    ?>
                                    <div class="messageContainer row">
                                        <div class="userMessage col-9 offset-2">
                                            <?php echo htmlspecialchars($message["message"]) ?>
                                        </div>
                                        <div class="col-1">
                                            <img class="chatImage" src="<?php echo $userPhoto ?>">
                                        </div>
                                    </div>
                                    <?php
                                } else {//si destinataire
                                    ?>
                                    <div class="messageContainer row">
                                        <div class="col-1">
                                            <img class="chatImage"
                                                 src="<?php echo $usersMatchedArray[0]['photo_url'] ?>">
                                        </div>
                                        <div class="contactMessage col-9">
                                            <?php echo htmlspecialchars($message["message"]) ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div id="userMessageArea" class="row ">
                        <input id="inputMessage" class="col-10 form-control" maxlength="500">
                        <button id="sendMessageButton" class="col-2 btn btn-primary" type="button">Envoyer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
