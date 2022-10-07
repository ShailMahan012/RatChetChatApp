<?php
    class MyDB extends SQLite3 {
        function __construct() {
            $this->open('database.db');
        }
        function insert($username, $email, $password) {
            $sql = "SELECT email FROM users WHERE email=\"$email\";";
            $ret = $this->query($sql)->fetchArray(SQLITE3_ASSOC);
            
            if (!$ret) {
                $sql = "INSERT INTO users (username, email, password) VALUES(\"$username\", \"$email\", \"$password\");";
                $ret = $this->query($sql);
                return true;
            }
            return false;
        }
        function find($email, $password) {
            $sql = "SELECT username from users where email=\"$email\" AND password=\"$password\"";
            $ret = $this->query($sql)->fetchArray(SQLITE3_ASSOC);
            return $ret;
        }
    }

    $db = new MyDB();
    if(!$db) {
      echo $db->lastErrorMsg();
    }


?>