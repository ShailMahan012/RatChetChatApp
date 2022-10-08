<?php
    class MyDB extends SQLite3 {
        function __construct() {
            $this->open('database.db');
        }
        // Insert user and return true if given email does not exit else return false
        function insert_user($username, $email, $password) {
            $sql = "SELECT email FROM users WHERE email=\"$email\";";
            $ret = $this->query($sql)->fetchArray(SQLITE3_ASSOC);
            
            if (!$ret) {
                $sql = "INSERT INTO users (username, email, password) VALUES(\"$username\", \"$email\", \"$password\");";
                $ret = $this->query($sql);
                return true;
            }
            return false;
        }

        // Get user using id
        function get_user($ID) {
            $sql = "SELECT * FROM users WHERE ID=\"$ID\";";
            $ret = $this->query($sql)->fetchArray(SQLITE3_ASSOC);
            return $ret;
        }

        // Find user and return ID and username. Used to login user and store ID and username in session
        function find($email, $password) {
            $sql = "SELECT ID, username FROM users where email=\"$email\" AND password=\"$password\";";
            $ret = $this->query($sql)->fetchArray(SQLITE3_ASSOC);
            return $ret;
        }

        // Search users using text. Used to find contacts to add
        function search_user($name) {
            $sql = "SELECT ID, username, email FROM users WHERE username LIKE \"%$name%\";";
            $ret = $this->query($sql);
            return $ret;
        }

        // create new contact
        function insert_contact($ID, $contact_id) {
            $ret = $this->check_contact($ID, $contact_id);
            if (!$ret) {
                $sql = "INSERT INTO contacts (user_id, contact_id) VALUES($ID, $contact_id);";
                $this->query($sql);
            }
        }

        // Just check if currect user and contact id are contacts
        function check_contact($ID, $contact_id) {
            $sql = "SELECT ID FROM contacts WHERE user_id=$ID AND contact_id=$contact_id;";
            $ret = $this->query($sql)->fetchArray(SQLITE3_ASSOC);
            if ($ret) return true;
            return false;
        }

        // return all contacts of user $ID
        function get_contact($ID) {
            $sql = "SELECT contact_id FROM contacts WHERE user_id=$ID;";
            $ret = $this->query($sql);
            return $ret;
        }

        // Return list of contacts of user with id $ID. It will give list of users
        function get_contact_data($ID) {
            $result = $this->get_contact($ID);
            $contacts = Array();
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $contact_id = $row["contact_id"];
                $user = $this->get_user($contact_id);
                array_push($contacts, $user);
            }
            return $contacts;
        }
    }

    $db = new MyDB();
    if(!$db) {
      echo $db->lastErrorMsg();
    }


?>