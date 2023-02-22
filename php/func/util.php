<?php
    function getDB() {
        return new SQLite3($_SERVER["DOCUMENT_ROOT"]."/php/func/data.db");
    }

    function getClientID() {
        $db = getDB();
        $stm = $db->prepare("SELECT user_id FROM auth WHERE cookie=:cookie");
        $stm->bindValue("cookie", $_COOKIE["auth"]);
        $result = $stm->execute();
    
        if($val = $result->fetchArray(SQLITE3_ASSOC)) {
            return $val["user_id"];
        }  
    }

    function getPostLimit() {
        return 10;
    }

    class User {
        public $id;
        public $name;
        public $bio;
        public $picture;

        function __construct($id) {
            $this->id = $id;
            $db = getDB();
            $stm = $db->prepare("SELECT * FROM user WHERE user_id=:id");
            $stm->bindValue("id", $id);
            $result = $stm->execute();
            if($values = $result->fetchArray(SQLITE3_ASSOC)) {
                $this->name = $values["name"];
                $this->bio = $values["bio"];
                $this->picture = $values["picture"]!=SQLITE3_NULL ? "/php/image.php?id=".$values["picture"] : "";
            }
        }

        public static function idFromUsername($username) {
            $db = getDB();
            $stm = $db->prepare("SELECT id FROM login WHERE username=:username");
            $stm->bindValue("username", $username);
            $result = $stm->execute();
            if($values = $result->fetchArray(SQLITE3_ASSOC)) {
                return $values["id"];
            }
            return false;
        }

        function getPosts($limit = -1, $offset = 0) {
            $posts = [];
            $db = getDB();
            $stm = $db->prepare("SELECT id FROM post WHERE user_id=:id ORDER BY id DESC LIMIT :limit OFFSET :offset");
            $stm->bindValue("id", $this->id);
            $stm->bindValue("limit", $limit);
            $stm->bindValue("offset", $offset);
            $result = $stm->execute();
            while ($post = $result->fetchArray(SQLITE3_ASSOC)) {
                array_push($posts, new Post($post["id"]));
            }
            return $posts;
        }

        function isFollowedBy($id) {
            $db = getDB();
            $stm = $db->prepare("SELECT * FROM follow WHERE target_id=:this_id AND user_id=:id");
            $stm->bindValue("id", $id);
            $stm->bindValue("this_id", $this->id);
            $result = $stm->execute();
            if($result->fetchArray(SQLITE3_ASSOC)) return true;
            return false;
        }
    }

    class Post {
        public $content;
        public $id;
        public $user_id;
        public $image;

        function __construct($id) {
            $this->id = $id;
            $db = getDB();
            $stm = $db->prepare("SELECT * FROM post WHERE id=:id");
            $stm->bindValue("id", $id);
            $result = $stm->execute();
            if($values = $result->fetchArray(SQLITE3_ASSOC)) {
                $this->content = $values["content"];
                $this->image = $values["image"]!=-1 ? "/php/image.php?id=".$values["image"] : "";
                $this->user_id = $values["user_id"];
            }
        }

        function getStats() {
            $db = getDB();
            $stm = $db->prepare("SELECT
            (SELECT COUNT(*) FROM likes WHERE post_id=:id) AS likes,
            (SELECT COUNT(*) FROM reply WHERE post_id=:id) AS replies");
            $stm->bindValue("id", $this->id);
            return $stm->execute()->fetchArray(SQLITE3_ASSOC);
        }

        function getUser() {
            return new User($this->user_id);
        }

        function getReplies($limit = -1, $offset = 0) {
            $posts = [];
            $db = getDB();
            $stm = $db->prepare("SELECT id FROM reply WHERE post_id=:id ORDER BY id DESC LIMIT :limit OFFSET :offset");
            $stm->bindValue("id", $this->id);
            $stm->bindValue("limit", $limit);
            $stm->bindValue("offset", $offset);
            $result = $stm->execute();
            while ($reply = $result->fetchArray(SQLITE3_ASSOC)) {
                array_push($posts, new Reply($reply["id"]));
            }
            return $posts;
        }

        function isLikedBy($id) {
            $db = getDB();
            $stm = $db->prepare("SELECT * FROM likes WHERE post_id=:this_id AND user_id=:id");
            $stm->bindValue("id", $id);
            $stm->bindValue("this_id", $this->id);
            $result = $stm->execute();
            if($result->fetchArray(SQLITE3_ASSOC)) return true;
            return false;
        }
    }

    class Reply {
        public $user_id;
        public $id;
        public $post_id;
        public $content;

        function __construct($id) {
            $this->id = $id;
            $db = getDB();
            $stm = $db->prepare("SELECT * FROM reply WHERE id=:id");
            $stm->bindValue("id", $id);
            $result = $stm->execute();
            if($values = $result->fetchArray(SQLITE3_ASSOC)) {
                $this->content = $values["content"];
                $this->post_id = $values["post_id"];
                $this->user_id = $values["user_id"];
            }
        }

        function getUser() {
            return new User($this->user_id);
        }
    }
?>