<?php

if (isset($_GET["akzioa"]) && $_GET["akzioa"] == "aukerak")
{

$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "ml_ajax_1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT herria from herriak where eskualdea = $eskualdea";
$result = $conn->query($sql);
 

$herriak = [];

if ($result->num_rows > 0) {
    $counter = 0;
    while ($row = $result->fetch_assoc()) {
        $herriak[$counter] = ["herria" => $row["herria"], "eskualdea" => $row["eskualdea"]];
        $counter++;
    }

    $herriak["kopurua"] = $counter;
    echo json_encode($herriak);
    $conn->close();
    die;

} else {
    $herriak["kopurua"] = 0;
    echo json_encode($herriak);
    $conn->close();
    die;
}


}
?>