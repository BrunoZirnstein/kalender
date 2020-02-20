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
		<link href='packages/core/main.css' rel='stylesheet' />
		<link href='packages/daygrid/main.css' rel='stylesheet' />
		<link href='packages/timegrid/main.css' rel='stylesheet' />
		<link href='packages/list/main.css' rel='stylesheet' />
		<script src='packages/core/main.js'></script>
		<script src='packages/interaction/main.js'></script>
		<script src='packages/daygrid/main.js'></script>
		<script src='packages/timegrid/main.js'></script>
        <script src='packages/list/main.js'></script>
        
        <?php

        $link = new mysqli('localhost', 'root', '', 'itwc20');
        mysqli_set_charset($link, 'utf8');

        echo "
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'list' ],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listYear'
            },
            navLinks: false, // can click day/week names to navigate views
            businessHours: true, // display business hours
            editable: false,
            events: [";
            $sql = "SELECT * FROM participant JOIN event ON participant.eid = event.eid WHERE participant.uid = ".$_GET["uid"];
            $result = $link->query($sql);

            if ($result->num_rows > 0) {
                while($event = $result->fetch_assoc()){
                    echo "{title: '".$event["title"]."',";
                    echo "start: '".$event["start"]."',";
                    echo "end: '".date("Y-m-d", strtotime("1970-01-03") + strtotime($event["finish"]))."',";
                    /*echo "rendering: 'background',";*/
                    echo "color: '#EC6607'},";
                }
            }
            
                $sql = "SELECT * FROM appointment WHERE uid = ".$_GET["uid"];
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    while($appointment = $result->fetch_assoc()){
                        echo "{start: '".$appointment["start"]."',";
                        echo "end: '".$appointment["finish"]."',";
                        echo "overlap: false,";
                        echo "rendering: 'background',";
                        echo "color: '#F57C7C'},";
                    }
                }
        echo "
            ]
            });

            calendar.render();
        });

        </script>
        ";
        ?>

        <style>

        body {
            margin: 40px 10px;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }

        </style>

        <title>Profil</title>
    </head>
    <body>
        <h4 class="itwc">Profil</h4>
        <div class="itwc">
            <label>Name: </label><?php echo $user["salutation"].' '.$user["name"].' '.$user["lastname"] ?><br />
            <label>Email: </label><?php echo '<a href="mailto:'.$user["email"].'">'.$user["email"].'</a>' ?><br />
            <label>Unternehmen: </label><?php echo $comp["name"] ?><br />
            <label>Studium/Ausbildung: </label><?php echo $user["label"] ?><br />
            <label>Studienstart: </label><?php echo getDateToDisplay($user["start"]) ?><br />
            <label>Studienende: </label><?php echo getDateToDisplay($user["finish"]) ?><br />
            <a href="#">Passwort ändern</a>
        </div>
        <div id='calendar'></div>
    </body>
</html>