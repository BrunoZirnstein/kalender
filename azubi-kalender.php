<!DOCTYPE html>
<html>
  <head>
  <meta charset='utf-8' />
  <link href='packages/core/main.css' rel='stylesheet' />
  <link href='packages/daygrid/main.css' rel='stylesheet' />
  <link href='packages/timegrid/main.css' rel='stylesheet' />
  <link href='packages/list/main.css' rel='stylesheet' />
  <link rel="stylesheet" href="general.css" />
  <script src='packages/core/main.js'></script>
  <script src='packages/interaction/main.js'></script>
  <script src='packages/daygrid/main.js'></script>
  <script src='packages/timegrid/main.js'></script>
  <script src='packages/list/main.js'></script>

  <?php

  $link = new mysqli('localhost', 'root', '', 'itwc20');
  mysqli_set_charset($link, 'utf8');

  $user_sql = "SELECT * FROM user";
  $user_result = $link->query($user_sql);

  if ($user_result->num_rows > 0) {
    echo '<div>';
    echo '<button class="itwc" onclick="select_all()">Alle</button>';
    echo '<button class="itwc" onclick="deselect_all()">Niemand</button>';
    echo '<form id="users" method="post">';
      while($user = $user_result->fetch_assoc()){
          echo '<input style="cursor: pointer;" type="checkbox" id="user'.$user["uid"].'" name="user'.$user["uid"].'" value="'.$user["uid"].'" /><label class="itwc" style="cursor: pointer;" for="user'.$user["uid"].'">'.$user["name"].' '.$user["lastname"].'</label><br />';
      }
    echo '<input type="hidden" name="submitted" value="true" />';
    echo '<input class="itwc" type="submit" value="Termine anzeigen" /></form>';
    echo '</div>';
  }

  if(isset($_POST["submitted"]) && $_POST["submitted"] == true){
    $participant_ids = '';
    $appointment_ids = '';
    for($t = 1; $t <= $user_result->num_rows; $t++){
      if(isset($_POST["user".$t])){
        $uid =  $_POST["user".$t];
        if($participant_ids == ''){
          $participant_ids .= $uid;
        } else{
          $participant_ids .= ' OR participant.uid = '.$uid;
        }

        if($appointment_ids == ''){
          $appointment_ids .= $uid;
        } else{
          $appointment_ids .= ' OR uid = '.$uid;
        }
      }
    }
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
          $sql = "SELECT * FROM participant JOIN event ON participant.eid = event.eid WHERE participant.uid = ".$participant_ids;
          $result = $link->query($sql);

          if ($result->num_rows > 0) {
              while($event = $result->fetch_assoc()){
                  echo "{title: '".$event["title"]."',";
                  echo "start: '".$event["start"]."',";
                  echo "end: '".date("Y-m-d", strtotime("1970-01-03") + strtotime($event["finish"]))."',";
                  echo "color: '#EC6607'},";
              }
          }
          
            $sql = "SELECT * FROM appointment WHERE uid = ".$appointment_ids;
            $result = $link->query($sql);

            if ($result->num_rows > 0) {
                while($appointment = $result->fetch_assoc()){
                    echo "{start: '".$appointment["start"]."',";
                    echo "end: '".$appointment["finish"]."',";
                    echo "overlap: false,";
                    echo "rendering: 'background',";
                    echo "color: '#ff9f89'},";
                }
            }
      echo "
          ]
        });

        calendar.render();
      });

    </script>
    ";
  }


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
  </head>
  <body style="display: flex; flex-direction: row; align-items: flex-start; padding: 0 5%;">
    <div id='calendar'></div>

    <script>
      function select_all(){
        var users = document.getElementById("users").children;
        for(var i = 0; i <= users.length - 1; i++){
          if(users[i].tagName == 'INPUT' && users[i].type == 'checkbox'){
            users[i].checked = "checked";
            
          }
        }
      }

      function deselect_all(){
        var users = document.getElementById("users").children;
        for(var i = 0; i <= users.length - 1; i++){
          if(users[i].tagName == 'INPUT' && users[i].type == 'checkbox'){
            users[i].checked = "";
            
          }
        }
      }
    </script>
  </body>
</html>
