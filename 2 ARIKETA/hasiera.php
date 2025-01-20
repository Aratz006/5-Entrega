<?php

require_once("db.php");

$conn = konexioaSortu();
?>



<?php
    
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "  <th>Postua</th>";
        echo "  <th>Dortsala</th>";
        echo "  <th>Izena</th></tr></thead><tbody class='zerrenda'";

        $sql = "SELECT Postua, Dortsala, Izena FROM pilotoak ORDER BY Postua ASC";
        $result = $conn->query($sql);
        $lerroak = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                
                    echo "<tr>";
                    echo "<td>" . $row["Postua"] . "</td>";
                    echo "<td>" . $row["Dortsala"] . "</td>";
                    echo "<td>" . $row["Izena"] . "</td>";
                    echo "</tr>";
                    $lerroak++;
            }
        }
        echo "</tbody></table>";
        if ($lerroak === 0) {
            echo "<h5>Ez dago emaitzarik datu horiekin</h5>";
        }
        $conn->close();

        ?>
        <button class="birkargatu">Taula birkargatu</button>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    //Dokumentua prest dagoenean funtzio barruko kodea exekutatuko da
    $(document).ready(function () {


        $(".birkargatu").on("click", function () {
             taulaBirkargatu();
        });

        //setInterval(taulaBirkargatu, 30000);

    });

    function taulaBirkargatu() {

        $.ajax({
            "url": "lortuPilotoak.php",
            "method": "GET",
            "data": {
                "akzioa": "lortuPilotoak",
            }
        })
            .done(function (informazioa) {

                var info = JSON.parse(informazioa);
                
                if (info.kopurua > 0) {
                    $(".zerrenda").html("");
                    for (var i = 0; i < info.kopurua; i++) {
                        $(".zerrenda").append("<tr><td>" + info[i].Postua + " </td><td>" + info[i].Dortsala + "</td><td>" + info[i].Izena +"</td></tr>");
                    }
                    
                } else {
                    alert("Ez da elementurik kargatu");
                }

            })
            .fail(function () {
                alert("gaizki joan da");
            })
            .always(function () {
                
            });
    }
</script>
