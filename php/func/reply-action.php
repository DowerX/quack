<?php
    function makeReply($content, $post_id, $auth) {
        include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php");
        $db = getDB();
        // get user id
        $stm = $db->prepare("SELECT user_id FROM auth WHERE cookie=:cookie");
        $stm->bindValue("cookie", $auth);
        $user_id = $stm->execute()->fetchArray(SQLITE3_NUM)[0];
        
        if(strlen($content)>500 || strlen($content)==0) return;

        $stm = $db->prepare("INSERT INTO reply (user_id, content, post_id) VALUES(:user_id, :content, :post_id)");
        $stm->bindValue("content", $content);
        $stm->bindValue("post_id", $post_id);
        $stm->bindValue("user_id", $user_id);
        $stm->execute();
    }

    if(array_key_exists("auth", $_COOKIE) && array_key_exists("content", $_POST) && array_key_exists("id", $_POST)) {
        makeReply($_POST["content"], $_POST["id"], $_COOKIE["auth"]);    
    }
?>