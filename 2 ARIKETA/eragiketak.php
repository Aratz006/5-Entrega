<?php

require_once("db.php");

if (isset($_GET["akzioa"]) && $_GET["akzioa"] == "lortuPilotoak") {

    $conn = konexioaSortu();

    $sql = "SELECT * FROM pilotoak ORDER BY Postua ASC";
    $result = $conn->query($sql);
    $pilotoak = [];

    if ($result->num_rows > 0) {
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            $pilotoak[$counter] = ["Izena" => $row["Izena"], "Dortsala" => $row["Dortsala"], "Postua" => $row["Postua"]];
            $counter++;
        }

        $pilotoak["kopurua"] = $counter;
        echo json_encode($pilotoak);
        die;

    } else {
        $pilotoak["kopurua"] = 0;
        echo json_encode($pilotoak);
        die;
    }

} else if (isset($_POST["akzioa"]) && $_POST["akzioa"] == "eguneratuPilotoak") {

    $conn = konexioaSortu();

    $dortsala = isset($_POST["dortsala"]) ? $_POST["dortsala"] : '';
    $postua = isset($_POST["postua"]) ? $_POST["postua"] : '';
    if ($dortsala != '' || $postua != '') {
        $sql1 = "UPDATE pilotoak SET Postua=$postua WHERE Dortsala=$dortsala";
        $result = $conn->query($sql1);
    }
    

}