<?php
    function makePost($content, $image, $auth) {
        include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php");
        $db = getDB();
        // get user id
        $stm = $db->prepare("SELECT user_id FROM auth WHERE cookie=:cookie");
        $stm->bindValue("cookie", $auth);
        $user_id = $stm->execute()->fetchArray(SQLITE3_NUM)[0];
        
        if(strlen($content)>500) return;
        if(strlen($content)==0 && strlen($image)==0) return;

        // can't use 'RETURNING id' bc the SQLITE3 class in PHP is busted ;-)
        // causes double rows
        $image_id = -1;
        if (strlen($image)!=0) {
            $stm = $db->prepare("INSERT INTO image (data) VALUES(:image)");
            $stm->bindValue("image", $image);
            $stm->execute();
            $stm = $db->prepare("SELECT id FROM image WHERE data=:image ORDER BY id DESC LIMIT 1");
            $stm->bindValue("image", $image);
            $image_id = $stm->execute()->fetchArray(SQLITE3_ASSOC)["id"];
        }

        $stm = $db->prepare("INSERT INTO post (user_id, content, image) VALUES(:user_id, :content, :image_id)");
        $stm->bindValue("content", $content);
        $stm->bindValue("user_id", $user_id);
        $stm->bindValue("image_id", $image_id);
        $stm->execute();
    }

    if(array_key_exists("auth", $_COOKIE) && array_key_exists("content", $_POST) && array_key_exists("image", $_POST)) {
        makePost($_POST["content"], $_POST["image"], $_COOKIE["auth"]);    
    }
?>