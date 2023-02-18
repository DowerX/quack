<?php
    function checkLoggedIn() {
        include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php");
        // do we have a cookie?
        if(array_key_exists("auth", $_COOKIE)) {
            // is it valid?
            $db = getDB();
            $stm = $db->prepare("SELECT user_id FROM auth WHERE cookie=:cookie");
            $stm->bindValue("cookie", $_COOKIE["auth"]);
            $result = $stm->execute();
            if($result->fetchArray(SQLITE3_ASSOC)) {
                return;
            } else {
                header("Location: /php/login.php");
                exit();
            }
        } else {
            header("Location: /php/login.php");
            exit();
        }
    }
?>