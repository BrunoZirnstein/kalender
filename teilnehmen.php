<?php

$eid = $_GET["eid"];
$id = $_SESSION["user"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itwc20";


$conn = new mysqli($servername, $username, $password, $dbname);

//$befehl ="SELECT MAX(pnr) FROM participant WHERE eid = " . $eid;
$befehl = "SELECT MAX(pnr) AS 'pnr' FROM `participant` WHERE eid =" . $eid;

$result = $conn->query($befehl);

while($row = $result->fetch_assoc()){
   $grnu = $row["pnr"];
}
$grnu += 1;
$sql = "INSERT INTO `participant`(`pnr`, `uid`, `eid`)
VALUES ('".$grnu."','".$eid."','".$id."')";


//$conn->query($sql);

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();




echo "Connected successfully<br />";
echo 'EID: '.$eid.'<br />';
echo $id.'<br />';
echo $befehl.'<br />';
echo $grnu;
echo $sql;
echo '<br />'.$sql.'<br />';

header("Location: event-overview.php");

?>