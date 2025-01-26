<?php
if (isset($_GET["akzioa"]) && $_GET["akzioa"] == "lortuAukerak") {

    $servername = "localhost";
    $username = "root";
    $password = "1MG2024";
    $dbname = "ml_ajax_1";


    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $eskualdea = $conn->real_escape_string($_GET["eskualdea"]);
    $sql = "SELECT herria FROM herriak WHERE eskualdea = '$eskualdea'";
    $result = $conn->query($sql);


    $herriak = [];

    if ($result->num_rows > 0) {
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            $herriak[$counter] = ["herria" => $row["herria"]];
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