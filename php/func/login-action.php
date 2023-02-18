<?php
    include_once("util.php");
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    if(array_key_exists("username", $_POST) && array_key_exists("password", $_POST)) {
        // are the credentials valid?
        $db = getDB();
        $stm = $db->prepare("SELECT id FROM login WHERE username=:username AND password=:password");
        $stm->bindValue("username", $_POST["username"]);
        $stm->bindValue("password", $_POST["password"]);
        $result = $stm->execute();
        if($values = $result->fetchArray(SQLITE3_ASSOC)) {
            // valid creds
            // delete old cookie
            $user_id = $values["id"];
            $stm = $db->prepare("DELETE FROM auth WHERE user_id = :id");
            $stm->bindValue("id", $user_id, SQLITE3_TEXT);
            $stm->execute();
            // make new
            $auth_cookie = generateRandomString(32);
            $stm = $db->prepare("INSERT INTO auth (user_id, cookie) VALUES (:id, :cookie)");
            $stm->bindValue("id", $user_id);
            $stm->bindValue("cookie", $auth_cookie);
            $stm->execute();
            setcookie("auth", $auth_cookie, 0, "/", $_SERVER["HOST_NAME"], false, false);
            // redirect
            header("Location: /php/feed.php");
            exit();
        }
    }
    // failed
    header("Location: /php/login.php");
?>