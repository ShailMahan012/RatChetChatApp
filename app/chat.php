<?php
    require_once("check_login.php");
    require_once("database.php");

    function goBack() {
        header("Location: contacts.php");
        die;
    }

    if (isset($_GET['ID'])) {
        $ID = $_SESSION["ID"];
        $contact_id = $_GET['ID'];
        $is_contact = $db->check_contact($ID, $contact_id);
        if (!$is_contact) goBack();

        $contact_data = $db->get_user($contact_id);

        $user = $db->get_user($contact_id);
        if (!$user) goBack();
    }
    else  goBack();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/chat.css">
    <title>Chat Application</title>
</head>
<body>
    <div class="container">
        <div class="chat-container" id="chats">
            <h3 style="text-align: center;">Message <span style="font-weight: bolder;"><?php echo $contact_data["username"]  ?></span></h3>
        </div>
        <div class="chat-container">
            <div class="form-group">
                <input id="msg_input" type="text" class="form-control" placeholder="Enter Message">
            </div>
            <div class="form-group">
                <button id="send_btn" onclick="send_msg()" class="btn btn-success btn-sm btn-block" disabled>SEND</button>
            </div>
            <div class="form-group">
                <a href="contacts.php" class="btn btn-secondary btn-sm btn-block" style="color: white;">CONTACTS</a>
            </div>
            <div class="form-group">
                <button id="logout_btn" class="btn btn-outline-danger btn-sm btn-block">LOGOUT</button>
            </div>
        </div>
    </div>
    <script>
        // This function is used in chat.js to retreive ID and username 
        function getUserData() {
            return <?php 
                echo sprintf('{ID: "%s", username: "%s", contact_id: "%s"}', $_SESSION["ID"], $_SESSION["username"], $contact_id);
            ?>
        }
    </script>
    <script src="js/chat.js"></script>
    <script src="js/logout.js"></script>
</body>
</html>