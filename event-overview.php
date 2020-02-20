<!DOCTYPE html />
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="event-overview-styles.css" />
        <link rel="stylesheet" href="general.css" />
    </head>
    <body>
        <h4 class="itwc">Events</h4>
        <?php

        if($_SESSION["rank"]){
            ?>
            <button id="form">+</button>
            <?php
        }

        $link = new mysqli('localhost', 'root', '', 'itwc20');
        mysqli_set_charset($link, 'utf8');
        if ($link->connect_error) {
            die("linkection failed: " . $link->linkect_error);
        }

        $sql = "SELECT * FROM event";
        $result = $link->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $count = 0;
                $participant_sql = "SELECT * FROM participant WHERE eid = ".$row["eid"];
                $participant_result = $link->query($participant_sql);

                if ($participant_result->num_rows > 0) {
                    while($participants = $participant_result->fetch_assoc()){
                        $count++;
                    }
                }
                echo '<a class="itwc" href="event-detail.php?eid='.$row["eid"].'"><div class="itwc event">';
                    echo $row["title"];
                    echo '<div id="right">';
                        echo '<div style="margin-right: 10px;">'.$count.'/'.$row["size"].'</div>';
                        echo '<button href="#" class="itwc">Teilnehmen</button>';
                    echo '</div>';
                echo '</div></a>';
            }
        } else {
            echo "0 results";
        }

        ?>

    </body>
</html>