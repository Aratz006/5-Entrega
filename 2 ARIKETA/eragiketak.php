<?php

require_once("db.php");

if (isset($_GET["akzioa"]) && $_GET["akzioa"] == "lortuPilotoak") {

    $conn = konexioaSortu();
    
    $sql2 = "UPDATE pilotoak SET class = '' WHERE Postua>= 1 AND Postua < 11";
    $result = $conn->query($sql2);

    $sql = "SELECT * FROM pilotoak ORDER BY Postua ASC";
    $result = $conn->query($sql);
    $pilotoak = [];

    if ($result->num_rows > 0) {
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            $pilotoak[$counter] = ["Izena" => $row["Izena"], "Dortsala" => $row["Dortsala"], "Postua" => $row["Postua"], "class" => $row["class"]];
            $counter++;
        }

        $pilotoak["kopurua"] = $counter;
        echo json_encode($pilotoak);
        $conn->close();
        die;

    } else {
        $pilotoak["kopurua"] = 0;
        echo json_encode($pilotoak);
        $conn->close();
        die;
    }

} else if (isset($_POST["akzioa"]) && $_POST["akzioa"] == "eguneratuPilotoak") {

    $conn = konexioaSortu();

    $dortsala = $conn->real_escape_string($_POST['dortsala']);
    $postua = $conn->real_escape_string($_POST['postua']);

    $sql2 = "UPDATE pilotoak SET class = '' WHERE Postua>= 1 AND Postua < 11";
    $result = $conn->query($sql2);

    $sql = "SELECT Postua FROM pilotoak WHERE Dortsala = '$dortsala'";
    $result = $conn->query($sql);
    $postuOriginala = $result->fetch_assoc()['Postua'];

    // Update the positions of other pilots
    if ($postuOriginala > $postua) {
        $sql = "UPDATE pilotoak SET Postua = Postua + 1 , class = 'red'  WHERE Postua>= $postua AND Postua < $postuOriginala";
    } else {
        $sql = "UPDATE pilotoak SET Postua = Postua - 1 , class = 'green' WHERE Postua<= $postua AND Postua > $postuOriginala";
    }
    $conn->query($sql);

    if ($dortsala != '' || $postua != '') {
        if ($postuOriginala > $postua) {
            $sql1 = "UPDATE pilotoak SET Postua=$postua , class = 'green' WHERE Dortsala=$dortsala";
        } else if($postuOriginala < $postua) {
            $sql1 = "UPDATE pilotoak SET Postua=$postua , class = 'red' WHERE Dortsala=$dortsala";
        }else{}
        $result = $conn->query($sql1);
        $conn->close();
        echo json_encode(["success" => true]);
        exit;
    }


}