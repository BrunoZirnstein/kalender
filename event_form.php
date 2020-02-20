<!DOCTYPE html />
<html>
    <head>
        <meta charset="utf-8" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="event-detail-styles.css" />
        <link rel="stylesheet" href="general.css" />
    </head>
    <body>
    <?php
    $success = 0;
    
    if(isset($_POST["submitted"]) && $_POST["submitted"] == true){
        /*echo "<pre>";
        print_r($_POST);
        echo "</pre>";*/

        $names = array_keys($_POST);
    
        for($i = 0; $i <= count($_POST) - 1; $i++){
            $wert = $_POST[$names[$i]];
        
            if(is_string($wert)){
                ${$names[$i]} = $wert;
                //echo $names[$i].": ".${$names[$i]}."<br />";
                for($t = 2; $t <= 4; $t++){
                    if($names[$i] == "sani".$t."username"){
                        $maxSanis++;
                    }
                }
            }
        }

        $link = new mysqli('localhost', 'root', '', 'itwc20');
        mysqli_set_charset($link, 'utf8');
        if ($link->connect_error) {
            die("linkection failed: " . $link->linkect_error);
        }

        $sql = "INSERT INTO event(`eid`, `start`, `finish`, `title`, `description`, `type`, `place`, `size`, `cid`, `uid`)
        VALUES ('', '".$start."', '".$end."', '".$titel."', '".$beschreibung."', '".$type."', '".$ort."', ".$size.", ".$_SESSION["company"].", ".$_SESSION["user"].")";

        if (mysqli_query($link, $sql)) {
            $success = 1;
        }
    }

    ?>

        <a id="back" href="event-overview.php"><i class="material-icons">arrow_back</i>alle Events</a>

        <form method="post">
            <input type="hidden" name="submitted" value="true" />

            <label for="start">Start</label><br />
            <input type="date" id="start" name="start" ><br />

            <label for="end">Ende</label><br />
            <input type="date" id="end" name="end" ><br />

            <label for="titel">Titel</label><br />
            <input type="text" id="titel" name="titel"><br />

            <label for="beschreibung">Beschreibung</label><br />
            <textarea id="beschreibung" name="beschreibung"></textarea><br />

            <label for="type">Art des Events</label><br />
            <input type="text" id="type" name="type"><br />

            <label for="ort">Ort</label><br />
            <input type="text" id="ort" name="ort"><br />

            <label for="size">Anzahl der benötigten Teilnehmer</label><br />
            <input type="number" min="0" id="size" name="size"><br />
            <br />

            <input type="submit" value="Event erstellen" />
        </from>
        <?php

        if($success == 1){
            echo '<script>alert("Event wurde erfolgreich erstellt")</script>';
        }

        ?>
    </body>
</html>