<!DOCTYPE html />
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="event-overview-styles.css" />
        <link rel="stylesheet" href="styles.css" />
    </head>
    <body>
        <h4 class="itwc">Events</h4>
        <?php

        $link = new mysqli('localhost', 'root', '', 'itwc20');
        mysqli_set_charset($link, 'utf8');
        if ($link->connect_error) {
            die("linkection failed: " . $link->linkect_error);
        }

        $sql = "SELECT * FROM event";
        $result = $link->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                echo '<a href="event-detail.php?eid='.$row["eid"].'"><div class="event">';
                    echo $row["title"];
                    echo '<button href="#" class="itwc">Teilnehmen</button>';
                echo '</div></a>';
            }
        } else {
            echo "0 results";
        }

        ?>

    </body>
</html>