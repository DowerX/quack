<?php
    function editProfilePicture($picture, $auth) {
        include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php");
        $db = getDB();
        // get user id
        $stm = $db->prepare("SELECT user_id FROM auth WHERE cookie=:cookie");
        $stm->bindValue("cookie", $auth);
        $user_id = $stm->execute()->fetchArray(SQLITE3_NUM)[0];
        
        // can't use 'RETURNING id' bc the SQLITE3 class in PHP is busted ;-)
        // causes double rows
        $stm = $db->prepare("INSERT INTO image (data) VALUES(:image)");
        $stm->bindValue("image", $picture);
        $stm->execute();
        $stm = $db->prepare("SELECT id FROM image WHERE data=:image ORDER BY id DESC LIMIT 1");
        $stm->bindValue("image", $picture);
        $image_id = $stm->execute()->fetchArray(SQLITE3_ASSOC)["id"];

        $stm = $db->prepare("UPDATE user SET picture=:image_id WHERE user_id=:user_id");
        $stm->bindValue("image_id", $image_id);
        $stm->bindValue("user_id", $user_id);
        $stm->execute();
    }
    function editBio($bio, $auth) {
        if(strlen($bio)<1 || strlen($bio)>500) {
            echo "The bio must be between 1 and 500 characters!";
            http_response_code(401);
            return;
        };

        include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php");
        $db = getDB();
        // get user id
        $stm = $db->prepare("SELECT user_id FROM auth WHERE cookie=:cookie");
        $stm->bindValue("cookie", $auth);
        $user_id = $stm->execute()->fetchArray(SQLITE3_NUM)[0];
        
        $stm = $db->prepare("UPDATE user SET bio=:bio WHERE user_id=:user_id");
        $stm->bindValue("bio", $bio);
        $stm->bindValue("user_id", $user_id);
        $stm->execute();
    }
    function editName($name, $auth) {
        if(strlen($name)>40 || strlen($name)<3) {
            echo "The name must be between 3 and 40 characters!";
            http_response_code(401);
            return;
        };

        include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php");
        $db = getDB();
        // get user id
        $stm = $db->prepare("SELECT user_id FROM auth WHERE cookie=:cookie");
        $stm->bindValue("cookie", $auth);
        $user_id = $stm->execute()->fetchArray(SQLITE3_NUM)[0];
        
        $stm = $db->prepare("UPDATE user SET name=:name WHERE user_id=:user_id");
        $stm->bindValue("name", $name);
        $stm->bindValue("user_id", $user_id);
        $stm->execute();
    }

    if(array_key_exists("auth", $_COOKIE) && array_key_exists("picture", $_POST)) {
        editProfilePicture($_POST["picture"], $_COOKIE["auth"]);
    }
    if(array_key_exists("auth", $_COOKIE) && array_key_exists("name", $_POST)) {
        editName($_POST["name"], $_COOKIE["auth"]);
    }
    if(array_key_exists("auth", $_COOKIE) && array_key_exists("bio", $_POST)) {
        editBio($_POST["bio"], $_COOKIE["auth"]);
    }
?>