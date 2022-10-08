<?php
    session_start();
    require_once("database.php");

    if (isset($_GET['ID'])) {
        $ID = $_SESSION["ID"];
        $contact_id = $_GET['ID'];
        if ($ID == $contact_id) {
            header("Location: search.php");
            die;
        }
        echo $ID . "<br>";
        echo $contact_id;
        $db->insert_contact($ID, $contact_id);
        header("Location: contacts.php");
        die;
    }
    else {
        header("Location: search.php");
        die;
    }
?>