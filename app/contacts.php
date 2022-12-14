<?php
   require_once("check_login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/contacts.css">
    <title>Contacts</title>
</head>
<body>
    <div class="container">
        <div class="inner-container">
            <form action="search.php" method="POST">
                <div class="input-group mb-3">
                    <input name="name" type="text" class="form-control" placeholder="Search User" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary" type="button">Search</button>
                    </div>
                </div>
            </form>
            <div class="form-group">
                <button id="logout_btn" class="btn btn-outline-danger btn-sm btn-block">LOGOUT</button>
            </div>
        </div>
        <div class="inner-container" id="contacts_div">
            <h3 style="text-align: center;">Your Contacts</h3>
        </div>
    </div>
    <script src="js/logout.js"></script>
    <script src="js/contacts.js"></script>
    <script>
        const parent_page = "contacts"; // constant used in display_contact function
        <?php
            require_once("database.php");

            $contacts = $db->get_contact_data($_SESSION["ID"]);

            foreach($contacts as $contact) {
                $contact_ID = $contact["ID"];
                $username = $contact["username"];
                $email = $contact["email"];
                echo "display_contact($contact_ID, \"$username\", \"$email\");\n";
            }
        ?>
    </script>
</body>
</html>