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

                $event_sql = "SELECT * FROM `participant` JOIN event ON participant.eid = event.eid WHERE participant.uid = ".$_SESSION["user"];
                $event_result = $link->query($event_sql);

                if($event_result->num_rows > 0){
                    $available = true;
                    while($teilnehmer = $event_result->fetch_assoc()){
                        if(strtotime($row["start"]) >= strtotime($teilnehmer["start"]) && strtotime($row["start"]) <= strtotime($teilnehmer["finish"])){
                            $available = false;
                        }

                        if(strtotime($row["finish"]) >= strtotime($teilnehmer["start"]) && strtotime($row["finish"]) <= strtotime($teilnehmer["finish"])){
                            $available = false;
                        }
                    }
                }

                $count = 0;
                $participant_sql = "SELECT * FROM participant WHERE eid = ".$row["eid"];
                $participant_result = $link->query($participant_sql);

                if ($participant_result->num_rows > 0) {
                    while($participants = $participant_result->fetch_assoc()){
                        $count++;
                    }
                }

                if($available == false){
                    $class = ' red';
                } else{
                    $class = ' green';
                }

                echo '<a class="itwc" href="event-detail.php?eid='.$row["eid"].'"><div class="itwc event'.$class.'">';
                    echo $row["title"];
                    echo '<div class="right">';
                        echo '<div style="margin-right: 10px;">'.$count.'/'.$row["size"].'</div>';
                        ?>
                        <form style="margin: 0;" method="post" action="teilnehmen.php">
                            <input type="hidden" name="eid" value="<?php echo $row["eid"] ?>" />
                            <input style="margin: 0;" type="submit" value="Teilnehmen" <?php if($available == false){echo ' disabled';} ?> />
                        </form>

                        <?php
                    echo '</div>';
                echo '</div></a>';
            }
        } else {
            echo "0 results";
        }

        ?>

    </body>
</html>