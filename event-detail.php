<?php
    include_once "tools.php";
?>
<!DOCTYPE html />
<html>
    <head>
        <meta charset="utf-8" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="event-detail-styles.css" />
    </head>
    <body>
        <?php
            $link = new mysqli('localhost', 'root', '', 'itwc20');
            mysqli_set_charset($link, 'utf8');
            if ($link->connect_error) {
                die("linkection failed: " . $link->linkect_error);
            }
    
            $sql = "SELECT * FROM event WHERE eid = ".$_GET["eid"];
            $result = $link->query($sql);
    
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                $sql = "SELECT * FROM user WHERE uid = ".$row["uid"];
                $result = $link->query($sql);
        
                if($result->num_rows == 1) {
                    $ansprechpartner = $result->fetch_assoc();
                }

            } else {
                echo "0 results";
            }
        ?>
        <a id="back" href="event-overview.php"><i class="material-icons">arrow_back</i>alle Events</a>
        <h1><?php echo $row["title"]; ?></h1>
        <p><?php
        echo 'Datum: '.getDateToDisplay($row["start"]).' - '.getDateToDisplay($row["finish"]).'<br />';
        echo 'Ort: '.$row["place"].'<br />';
        echo 'Ansprechpartner: '.$ansprechpartner["name"].' '.$ansprechpartner["lastname"].'<br />';
        echo $row["description"];
        ?></p>

    </body>
</html>