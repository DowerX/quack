<?php
    include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/check-logged-in.php"); checkLoggedIn();
    if(array_key_exists("id", $_GET)) {
        include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php");
        $db = getDB();
        $stm = $db->prepare("SELECT data FROM image WHERE id=:id");
        $stm->bindValue("id", $_GET["id"]);
        $result = $stm->execute();
        if($values = $result->fetchArray(SQLITE3_ASSOC)) {
            $data = $values["data"];
            $split = explode(";", $data,2);
            header("Content-type: ".substr($split[0], 6));
            echo base64_decode(substr($split[1], 6));
        } else {
            return http_response_code(404);
        }
    }
?>