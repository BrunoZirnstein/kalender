<?php
    include_once "tools.php";
?>
<!DOCTYPE html />
<html>
    <head>
        <meta charset="utf-8" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="styles.css" />
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
        <h4 class="itwc"><?php echo $row["title"]; ?></h4>
        <p class="itwc"><?php
        echo $row["description"].'<br /><br />';
        echo '<label class="itwc">Datum</label>'.getDateToDisplay($row["start"]).' - '.getDateToDisplay($row["finish"]).'<br /><br />';
        echo '<label class="itwc">Ort</label>'.$row["place"].'<br /><br />';
        echo '<label class="itwc">Ansprechpartner</label>'.$ansprechpartner["name"].' '.$ansprechpartner["lastname"].'<br /><br />';
        echo '<a href="mailto: '.$ansprechpartner["email"].'">'.$ansprechpartner["email"].'</a>';
        ?></p>

    </body>
</html>