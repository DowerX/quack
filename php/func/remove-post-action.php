<?php
    function removePost($id, $auth) {
        include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php");
        $db = getDB();
        // get user id
        $stm = $db->prepare("SELECT user_id FROM auth WHERE cookie=:cookie");
        $stm->bindValue("cookie", $auth);
        $user_id = $stm->execute()->fetchArray(SQLITE3_NUM)[0];

        $stm = $db->prepare("SELECT id FROM post WHERE user_id=:user_id AND id=:id");
        $stm->bindValue("id", $id);
        $stm->bindValue("user_id", $user_id);
        $result = $stm->execute();
        if($values = $result->fetchArray(SQLITE3_ASSOC)) {
            $stm = $db->prepare("DELETE FROM post WHERE id=:post_id");
            $stm->bindValue("post_id", $id);
            $stm->execute();
            $stm = $db->prepare("DELETE FROM likes WHERE post_id=:post_id");
            $stm->bindValue("post_id", $id);
            $stm->execute();
            $stm = $db->prepare("DELETE FROM reply WHERE post_id=:post_id");
            $stm->bindValue("post_id", $id);
            $stm->execute();
        }
    }

    if(array_key_exists("auth", $_COOKIE) && array_key_exists("id", $_POST)) {
        removePost($_POST["id"], $_COOKIE["auth"]);    
    }
?>