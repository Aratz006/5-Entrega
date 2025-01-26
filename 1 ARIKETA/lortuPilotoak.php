<?php
// Konexioa egiten duen dokumentuari deia egiten dio:
require_once("db.php");
// AJAX-a martxan jartzeko lortutako informazioaren barruan funtzio konkretu honen izena bilatzen du
if ($_GET["akzioa"] == "lortuPilotoak") {
    // DB-aren konexioa eskatzen du
    $conn = konexioaSortu();
    // SELECT eskaera egiten da
    $sql = "SELECT * FROM pilotoak ORDER BY Postua ASC";
    $result = $conn->query($sql);
    // Pilotoen informazioa gordetzeko array bat sortzen da
    $pilotoak = [];
    // SELECT-aren bidez lortutako erregistroak 0 baino gehiago badira:
    if ($result->num_rows > 0) {
        // kontadore bat sortzen da eta 0 balorea ematen zaio
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            // pilotoak aldagaiean, datu baseko informazioa gordetzen da
            $pilotoak[$counter] = ["Izena" => $row["Izena"], "Dortsala" => $row["Dortsala"], "Postua" => $row["Postua"]];
            //Kontadoreak gora egiten du lerro bakoitzean
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

}
