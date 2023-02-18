<?php
    function register($username, $password, $password_repeat, $name, $bio) {
        include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php");
        $db = getDB();
        // get user id
        $stm = $db->prepare("SELECT id FROM login WHERE username=:username");
        $stm->bindValue("username", $username);
        if($stm->execute()->fetchArray(SQLITE3_NUM)) {
            echo "Username already taken!";
            http_response_code(401);
            return;
        };

        if(strlen($username)>16 || strlen($username)<3) {
            echo "The username must be between 3 and 16 characters!";
            http_response_code(401);
            return;
        };

        if(strlen($password)>16 || strlen($password)<3) {
            echo "The password must be between 3 and 16 characters!";
            http_response_code(401);
            return;
        };

        if($password != $password_repeat) {
            echo "The paswords do not match!";
            http_response_code(401);
            return;
        };

        if(strlen($name)>40 || strlen($name)<3) {
            echo "The name must be between 3 and 40 characters!";
            http_response_code(401);
            return;
        };

        if(strlen($bio)<1 || strlen($bio)>500) {
            echo "The bio must be between 1 and 500 characters!";
            http_response_code(401);
            return;
        };
        
        $stm = $db->prepare("INSERT INTO login (username, password) VALUES(:username, :password)");
        $stm->bindValue("username", $username);
        $stm->bindValue("password", $password);
        $stm->execute();

        $stm = $db->prepare("SELECT id FROM login WHERE username=:username");
        $stm->bindValue("username", $username);
        $user_id = $stm->execute()->fetchArray(SQLITE3_NUM)[0];

        $stm = $db->prepare("INSERT INTO user (user_id, bio, name, picture) VALUES(:user_id, :bio, :name, :picture)");
        $stm->bindValue("user_id", $user_id);
        $stm->bindValue("bio", $bio);
        $stm->bindValue("name", $name);
        $stm->bindValue("picture", "/img/user-96.png");
        $stm->execute();

        echo "";
        http_response_code(200);
        return;
    }

    if(array_key_exists("username", $_POST) && array_key_exists("password", $_POST) && array_key_exists("password-repeat", $_POST) && array_key_exists("name", $_POST) && array_key_exists("bio", $_POST)) {
        register($_POST["username"], $_POST["password"], $_POST["password-repeat"], $_POST["name"], $_POST["bio"]);    
    }
?>