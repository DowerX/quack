<?php
    include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php");
    $db = getDB();
    $stm = $db->prepare("SELECT COUNT(login.id) FROM login");
    $users = $stm->execute()->fetchArray(SQLITE3_NUM)[0];
    $stm = $db->prepare("SELECT COUNT(post.id) FROM post");
    $posts = $stm->execute()->fetchArray(SQLITE3_NUM)[0];
    $stm = $db->prepare("SELECT COUNT(reply.id) FROM reply");
    $replies = $stm->execute()->fetchArray(SQLITE3_NUM)[0];
    $stm = $db->prepare("SELECT COUNT(*) FROM likes");
    $likes = $stm->execute()->fetchArray(SQLITE3_NUM)[0];
    $stm = $db->prepare("SELECT COUNT(image.id) FROM image");
    $images = $stm->execute()->fetchArray(SQLITE3_NUM)[0];

    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode(array("users"=>$users, "posts"=>$posts, "replies"=>$replies, "likes"=>$likes, "images"=>$images));
?>