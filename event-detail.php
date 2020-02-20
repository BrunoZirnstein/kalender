<?php
    include_once "tools.php";
?>
<!DOCTYPE html />
<html>
    <head>
        <meta charset="utf-8" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="general.css" />
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
        <?php
        echo $row["description"].'<br /><br />';
        if(isset($_SESSION["rank"]) && $_SESSION["rank"] == 4){
            echo 'Id: '.$row["eid"].'<br /><br />';
        }
        echo '<label class="itwc">Datum</label><br />'.getDateToDisplay($row["start"]).' - '.getDateToDisplay($row["finish"]).'<br /><br />';
        echo '<label class="itwc">Ort</label><br />'.$row["place"].'<br /><br />';
        echo '<label class="itwc">Ansprechpartner</label>'?>
        <form action="profil.php" method="post">
            <input type="hidden" name="uid" <?php echo 'value="'.$ansprechpartner['uid'].'"' ?> />
            <input style="border: none; background-color: transparent; cursor: pointer; padding: 0;" type="submit" value="<?php echo $ansprechpartner["name"].' '.$ansprechpartner["lastname"] ?>" /><br />
        </form><?php '<br /><br />';
        echo '<label class="itwc">E-Mail</label><br /><a class="itwc" href="mailto: '.$ansprechpartner["email"].'">'.$ansprechpartner["email"].'</a><br /><br />';
        echo '<label class="itwc">Teilnehmer</label><br />';

        $sql = "SELECT * FROM `participant` JOIN user ON participant.uid = user.uid WHERE eid = ".$_GET["eid"]." ORDER BY pnr ASC";
        $result = $link->query($sql);

        if($result->num_rows > 0){
            $i = 1;
            while($teilnehmer = $result->fetch_assoc()){
                ?>
                <form action="profil.php" method="post">
                    <input type="hidden" name="uid" <?php echo 'value="'.$teilnehmer['uid'].'"' ?> />
                    <input style="border: none; background-color: transparent; cursor: pointer; padding: 0;" type="submit" value="<?php echo $i.'. '.$teilnehmer["name"].' '.$teilnehmer["lastname"] ?>" /><br />
                </form>
                <?php
                $i++;
            }
        }
        ?>
        

    </body>
</html>