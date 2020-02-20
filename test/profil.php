<?php

function getDateToDisplay($date){
    $dateDisplay = date("d.m.Y", strtotime($date));
    return $dateDisplay;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itwc20";

$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conn, 'utf8');

$sql = "SELECT * FROM user WHERE uid = ".$_GET["uid"];
$result = mysqli_query($conn, $sql);

if ($result->num_rows == 1) {
    $user = mysqli_fetch_assoc($result);
}

$sql = "SELECT * FROM company WHERE cid = ".$user['cid'];
$result = mysqli_query($conn, $sql);

if ($result->num_rows == 1) {
    $comp = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html />
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Profil</title>
    </head>
    <body>
        <h1>Profil</h1>
        <div class="itwc">
            <label>Name: </label><?php echo $user["salutation"].' '.$user["name"].' '.$user["lastname"] ?><br />
            <label>Email: </label><?php echo '<a href="mailto:'.$user["email"].'">'.$user["email"].'</a>' ?><br />
            <label>Unternehmen: </label><?php echo $comp["name"] ?><br />
            <label>Studium/Ausbildung: </label><?php echo $user["label"] ?><br />
            <label>Studienstart: </label><?php echo getDateToDisplay($user["start"]) ?><br />
            <label>Studienende: </label><?php echo getDateToDisplay($user["finish"]) ?><br />
            <div><a href="#">Passwort ändern</a></div>
        </div>
    </body>
</html>