<?php
    function likePost($id, $auth) {
        include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php");
        $db = getDB();
        // get user id
        $stm = $db->prepare("SELECT user_id FROM auth WHERE cookie=:cookie");
        $stm->bindValue("cookie", $auth);
        $user_id = $stm->execute()->fetchArray(SQLITE3_NUM)[0];
        
        $stm = $db->prepare("SELECT post_id FROM likes WHERE user_id=:user_id AND post_id=:id");
        $stm->bindValue("id", $id);
        $stm->bindValue("user_id", $user_id);
        $result = $stm->execute();
        if($values = $result->fetchArray(SQLITE3_ASSOC)) {
            $stm = $db->prepare("DELETE FROM likes WHERE user_id=:user_id AND post_id=:post_id");
            $stm->bindValue("post_id", $id);
            $stm->bindValue("user_id", $user_id);
            $stm->execute();
        } else {
            $stm = $db->prepare("INSERT INTO likes (user_id, post_id) VALUES(:user_id, :post_id)");
            $stm->bindValue("post_id", $id);
            $stm->bindValue("user_id", $user_id);
            $stm->execute();
        }
    }

    if(array_key_exists("auth", $_COOKIE) && array_key_exists("id", $_POST)) {
        likePost($_POST["id"], $_COOKIE["auth"]);    
    }
?>