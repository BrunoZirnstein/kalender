<?php

function getDateToDisplay($date){
    $dateDisplay = date('d.m.Y', strtotime($date));
    return $dateDisplay;
}

?>