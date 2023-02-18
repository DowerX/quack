<?php
    function logout($auth) {
        include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php");
        // is it valid?
        $db = getDB();
        $stm = $db->prepare("DELETE FROM auth WHERE cookie=:cookie");
        $stm->bindValue("cookie", $auth);
        $result = $stm->execute();
        header("Location: /php/login.php");
    }

    if(array_key_exists("auth", $_COOKIE)) {
        logout($_COOKIE["auth"]);
    }
?>