<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
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
      $sql = "SELECT * FROM event";
      $result = $link->query($sql);

      if ($result->num_rows > 0) {
          while($event = $result->fetch_assoc()){
              echo "{title: '".$event["title"]."',";
              echo "start: '".$event["start"]."',";
              echo "end: '".date("Y-m-d", strtotime("1970-01-03") + strtotime($event["finish"]))."'},";
              /*echo "rendering: 'background',";
              echo "color: '#ff9f89'},";*/
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
</head>
<body>

  <div id='calendar'></div>

</body>
</html>
