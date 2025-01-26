<?php

require_once("db.php");

$conn = konexioaSortu();
?>



<?php
// Pilotoen informazioa erakutsiko duen taularen hasiera
echo "<table>";
echo "<thead>";
echo "<tr>";
echo "  <th>Postua</th>";
echo "  <th>Dortsala</th>";
echo "  <th>Izena</th></tr></thead><tbody class='zerrenda'";
// Pilotoen informazioa datu basetik lortzeko SELECT-a
$sql = "SELECT Postua, Dortsala, Izena FROM pilotoak ORDER BY Postua ASC";
$result = $conn->query($sql);
// Lerroak aldagaia sortu eta 0 balioa eman, ondoren lerrorik inprimatu ez bada, abisua eman dezan
$lerroak = 0;
// SELECT-a egiterakoan lortutako erregistro kopurua 0 baino handiagoa bada, informazioa inprimatzeko aukera egongo da
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Taularen lerroak inprimatuko dira, datu baseko informazioarekin
        echo "<tr>";
        echo "<td>" . $row["Postua"] . "</td>";
        echo "<td>" . $row["Dortsala"] . "</td>";
        echo "<td>" . $row["Izena"] . "</td>";
        echo "</tr>";
        $lerroak++;
    }
}
// Taularen etiketak ixten dira
echo "</tbody></table>";
if ($lerroak === 0) {
    echo "<h5>Ez dago emaitzarik datu horiekin</h5>";
}
// Datu basearen konexioa ixten da
$conn->close();

?>
<!-- Taula birkargatzeko erabiliko den botoia -->
<button class="birkargatu">Taula birkargatu</button>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    //Dokumentua prest dagoenean funtzio barruko kodea exekutatuko da
    $(document).ready(function () {

        // Botoiari klik egiterakoan taulaBirkargatu funtzioa martxan jarriko da
        $(".birkargatu").on("click", function () {
            taulaBirkargatu();
        });
        // Minuturo taulaBirkargatu funtzioa martxan jarriko da
        setInterval(taulaBirkargatu, 60000);

    });
    // taulaBirkargatu funtzioa
    function taulaBirkargatu() {
        // AJAX-a martxan jartzeko beharrezkoa den informazioa
        $.ajax({
            "url": "lortuPilotoak.php",
            "method": "GET",
            "data": {
                "akzioa": "lortuPilotoak",
            }
        })
            //AJAX-aren barruan dagoen akzioa ondo egin bada:
            .done(function (informazioa) {
                // Datu basetik jasotako informazioa aldagai batean jarri
                var info = JSON.parse(informazioa);
                // DB-tik jasotako lerroak 0 baino handiago bada:
                if (info.kopurua > 0) {
                    // Hasieran zegoen zerrenda ezabatzen da
                    $(".zerrenda").html("");
                    // DB-ko lerro bakoitzeko gauzatuko den akzioa
                    for (var i = 0; i < info.kopurua; i++) {
                        // Taularen gorputzean bata bestearen ondoren(append) taulako datuak inprimatuko dira, taula formatuan
                        $(".zerrenda").append("<tr><td>" + info[i].Postua + " </td><td>" + info[i].Dortsala + "</td><td>" + info[i].Izena + "</td></tr>");
                    }

                } else {
                    // Elementu kopurua 0 izatekotan, alert bat inprimatuko da
                    alert("Ez da elementurik kargatu");
                }

            })
            //AJAX-aren barruan dagoen akzioa gaizki egin bada:
            .fail(function () {
                alert("Gaizki joan da");
            })
            //AJAX-aren ondoren, beti egingo dena:
            .always(function () {

            });
    }
</script>