<?php
// Konexioa egiten duen dokumentuari deia egiten dio:
require_once("db.php");
// AJAX-a martxan jartzeko lortutako informazioaren barruan funtzio konkretu honen izena bilatzen du
if (isset($_GET["akzioa"]) && $_GET["akzioa"] == "lortuPilotoak1") {
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
            $pilotoak[$counter] = ["Izena" => $row["Izena"], "Dortsala" => $row["Dortsala"], "Postua" => $row["Postua"], "class" => $row["class"]];
            //Kontadoreak gora egiten du lerro bakoitzean
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
    // AJAX-a martxan jartzeko lortutako informazioaren barruan funtzio konkretu honen izena bilatzen du
} else if (isset($_POST["akzioa"]) && $_POST["akzioa"] == "eguneratuPilotoak") {
    // DB-aren konexioa eskatzen du
    $conn = konexioaSortu();
    // Formularioaren bidez bidalitako informazioa jasotzen da
    $dortsala = $conn->real_escape_string($_POST['dortsala']);
    $postua = $conn->real_escape_string($_POST['postua']);
    // UPDATE eskaera egiten da klasea kentzeko
    $sql2 = "UPDATE pilotoak SET class = '' WHERE Postua>= 1 AND Postua < 11";
    $result = $conn->query($sql2);
    // Postuen konparaketa egiteko SELEC baten bidez, hautatutako pilotoaren postu originala lortzen da
    $sql = "SELECT Postua FROM pilotoak WHERE Dortsala = '$dortsala'";
    $result = $conn->query($sql);
    //Aldagai bat sortzen da postu originalarekin
    $postuOriginala = $result->fetch_assoc()['Postua'];
    //Beste pilotoen posizioak eguneratzen dira
    // Postu originala, sartutako postu berria baina handiagoa bada: postu berria baina zenbaki handiagoak diren piloto guztien posizioak +1 igoko dira
    if ($postuOriginala > $postua) {
        $sql = "UPDATE pilotoak SET Postua = Postua + 1 , class = 'red'  WHERE Postua>= $postua AND Postua < $postuOriginala";
    // Postu originala, sartutako postu berria baina txikiagoa bada: postu berria baina zenbaki txikiagoak diren piloto guztien posizioak -1 jaitsiko dira
    } else {
        $sql = "UPDATE pilotoak SET Postua = Postua - 1 , class = 'green' WHERE Postua<= $postua AND Postua > $postuOriginala";
    }
    $conn->query($sql);
    // Daturik ez sartzeko aukera dagoenez pilotoaren egoera aldaketaren bate egotekotan bakarrik aldatuko da
    if ($dortsala != '' || $postua != '') {
        if ($postuOriginala > $postua) {
            // Postu originalaren aurretik geratzen bada, klaseak berdez margotuko du eta posizio berria azalduko da
            $sql1 = "UPDATE pilotoak SET Postua=$postua , class = 'green' WHERE Dortsala=$dortsala";
        } else if ($postuOriginala < $postua) {
            // Postu originalaren atzetik geratzen bada, klaseak gorriz margotuko du eta posizio berria azalduko da
            $sql1 = "UPDATE pilotoak SET Postua=$postua , class = 'red' WHERE Dortsala=$dortsala";
        } else {
        }
        $result = $conn->query($sql1);
        // Konexioa ixten da
        $conn->close();
        echo json_encode(["success" => true]);
        exit;
    }

    // AJAX-a martxan jartzeko lortutako informazioaren barruan funtzio konkretu honen izena bilatzen du
} else if (isset($_GET["akzioa"]) && $_GET["akzioa"] == "lortuPilotoak2") {
    // DB-aren konexioa eskatzen du
    $conn = konexioaSortu();
    // Taularen datuak birkargatu baino lehenago, UPDATE bat egiten du klasea kentzeko
    $sql2 = "UPDATE pilotoak SET class = '' WHERE Postua>= 1 AND Postua < 11";
    $result = $conn->query($sql2);
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
            $pilotoak[$counter] = ["Izena" => $row["Izena"], "Dortsala" => $row["Dortsala"], "Postua" => $row["Postua"], "class" => $row["class"]];
            //Kontadoreak gora egiten du lerro bakoitzean
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
}