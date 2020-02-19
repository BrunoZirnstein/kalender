<?php

$end = date("Y-m-d", strtotime("2020-02-20"));
echo '<br />'.$end.'<br />';
echo date("Y-m-d", strtotime("1970-01-03") + strtotime($end));

?>