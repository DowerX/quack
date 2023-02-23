<?php
    function changePassword($username, $oldpassword, $newpassword, $password_repeat) {
        include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php");
        $db = getDB();
        // get user id
        $stm = $db->prepare("SELECT id FROM login WHERE username=:username AND password=:oldpassword");
        $stm->bindValue("username", $username);
        $stm->bindValue("oldpassword", $oldpassword);
        if(!$stm->execute()->fetchArray(SQLITE3_NUM)) {
            echo "User doesn't exist with these credentials!";
            http_response_code(401);
            return;
        };

        if(mb_strlen($newpassword)>16 || mb_strlen($newpassword)<3) {
            echo "The new password must be between 3 and 16 characters!";
            http_response_code(401);
            return;
        };

        if($newpassword != $password_repeat) {
            echo "The paswords do not match!";
            http_response_code(401);
            return;
        };
        
        $stm = $db->prepare("UPDATE login SET  password=:newpassword WHERE username=:username AND password=:oldpassword");
        $stm->bindValue("username", $username);
        $stm->bindValue("newpassword", $newpassword);
        $stm->bindValue("oldpassword", $oldpassword);
        $stm->execute();

        echo "";
        http_response_code(200);
        return;
    }

    if(array_key_exists("username", $_POST) && array_key_exists("old-password", $_POST) && array_key_exists("new-password", $_POST) && array_key_exists("password-repeat", $_POST)) {
        changePassword($_POST["username"], $_POST["old-password"], $_POST["new-password"], $_POST["password-repeat"]);    
    }
?>