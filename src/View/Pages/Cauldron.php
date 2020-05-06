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


    <div class="container-fluid">
        <div class="row">
            <div id="matchedUserContainer" class="col-md-3 col-9 collapse">
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

            <div id="selectedChatContainer" class="col-12 col-md-9">
                <div class="container-fluid">
                    <div id="chatSelectedContact" class="row align-items-center"
                         data-uniqId="<?php echo $usersMatchedArray[0]['uniq_id'] ?>">
                        <a class="col-9 col-md-12" href="/profile/<?php echo $usersMatchedArray[0]['uniq_id'] ?>">
                            <div class="row align-items-center">
                                <div class="col-md-2 col-4">
                                    <img id="selectedContactPhoto"
                                         src="<?php echo $usersMatchedArray[0]['photo_url'] ?>">
                                </div>
                                <span id="selectedContactName" class="col-3">
                                    <?php echo $usersMatchedArray[0]["name"] ?>
                                </span>
                                <span id="selectedContactAge"
                                      class="col-md-2"><?php echo $usersMatchedArray[0]["age"] ?> ans</span>
                                <span id="selectedContactMatchDate"
                                      class="col-md-4">Match le <?php echo $usersMatchedArray[0]["date_match"] ?></span>
                            </div>
                        </a>
                        <div id="displayMatchListButton" class="col-3 col-md-0">
                            <button data-toggle="collapse" data-target="#matchedUserContainer" class="btn btn-primary"
                                    type="button">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                    </div>

                    <div id="chatBox" class="row">
                        <div id="messageListContainer" class="container-fluid">
                            <?php
                            for ($i = sizeof($defaultDiscussion) - 1; $i >= 0; $i--) {
                                $message = $defaultDiscussion[$i];

                                if ($message["uniqid"] === $userUniqId) { //si utilisateur courant
                                    ?>
                                    <div class="messageContainer row">
                                        <div class="userMessage col-md-9 offset-md-2 col-6 offset-3">
                                            <div class="container-fluid">
                                                <span class="row messageContent">
                                                    <?php echo htmlspecialchars($message["message"]) ?>
                                                </span>
                                                <span class="row messageDate">
                                                    <?php echo $message["datemessage"] ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-3 ">
                                            <img class="chatImage float-right" src="<?php echo $userPhoto ?>">
                                        </div>
                                    </div>
                                    <?php
                                } else {//si destinataire
                                    ?>
                                    <div class="messageContainer row">
                                        <div class="col-md-1 col-3">
                                            <img class="chatImage"
                                                 src="<?php echo $usersMatchedArray[0]['photo_url'] ?>">
                                        </div>
                                        <div class="contactMessage col-md-9 col-6">
                                            <div class="container-fluid">
                                                <span class="row messageContent">
                                                    <?php echo htmlspecialchars($message["message"]) ?>
                                                </span>
                                                <span class="row messageDate">
                                                    <?php echo $message["datemessage"] ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div id="userMessageArea" class="row align-items-center">
                        <textarea id="inputMessage" class="col-10 col-md-11 form-control" maxlength="500" rows="1"
                                  placeholder="Entrez votre message ici..."></textarea>
                        <div class="col-2 col-md-1 text-center">
                            <button id="sendMessageButton" class="btn btn-primary" type="button"><i
                                        class="fas fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
