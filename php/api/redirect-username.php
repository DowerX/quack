<?php
    include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/check-logged-in.php"); checkLoggedIn();
    include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php");

    if (array_key_exists("username", $_GET)) {
        if ($id = User::idFromUsername($_GET["username"])) {
            header("Location: /php/profile.php?id=".$id);
            exit();
        }
        http_response_code(400);
        exit();
    }
    http_response_code(422);
    exit();
?>