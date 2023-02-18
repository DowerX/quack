<?php
    function follow($id, $auth) {
        include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php");
        $db = getDB();
        // get user id
        $stm = $db->prepare("SELECT user_id FROM auth WHERE cookie=:cookie");
        $stm->bindValue("cookie", $auth);
        $user_id = $stm->execute()->fetchArray(SQLITE3_NUM)[0];
        
        $stm = $db->prepare("SELECT user_id FROM follow WHERE user_id=:user_id AND target_id=:id");
        $stm->bindValue("id", $id);
        $stm->bindValue("user_id", $user_id);
        $result = $stm->execute();
        if($values = $result->fetchArray(SQLITE3_ASSOC)) {
            $stm = $db->prepare("DELETE FROM follow WHERE user_id=:user_id AND target_id=:target_id");
            $stm->bindValue("target_id", $id);
            $stm->bindValue("user_id", $user_id);
            $stm->execute();
        } else {
            $stm = $db->prepare("INSERT INTO follow (user_id, target_id) VALUES(:user_id, :target_id)");
            $stm->bindValue("target_id", $id);
            $stm->bindValue("user_id", $user_id);
            $stm->execute();
        }
    }

    if(array_key_exists("auth", $_COOKIE) && array_key_exists("id", $_POST)) {
        follow($_POST["id"], $_COOKIE["auth"]);    
    }
?>