<?php
$usersMatchedArray = $this->data["usersMatched"];

foreach ($usersMatchedArray as $matchedUser) {
    ?>
    <p>Match avec <?php echo $matchedUser["name"] ?>, <?php echo $matchedUser["age"] ?> ans,
        le <?php echo $matchedUser["date_match"] ?>  </p>
    <?php
}

?>

