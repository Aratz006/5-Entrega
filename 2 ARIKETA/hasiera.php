<?php

require_once("db.php");

$conn = konexioaSortu();

?>

<head>
    <link rel="stylesheet" href="../css.css">
</head>
<form method="POST" action="hasiera.php" id="dbEguneratu">
    <label for="dortsala">Dortsala:</label>
    <select name="dortsala" id="dortsala">
        <option value=""></option>
        <option value="12">12</option>
        <option value="20">20</option>
        <option value="26">26</option>
        <option value="30">30</option>
        <option value="41">41</option>
        <option value="73">73</option>
        <option value="93">93</option>
        <option value="46">46</option>
        <option value="27">27</option>
        <option value="99">99</option>
    </select>

    <label for="postua">Postu berria:</label>
    <select name="postua" id="postua">
        <option value=""></option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
    </select>
    <button type="submit" id="eguneratu">Eguneratu</button>
</form>

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

        // Birkargatu botoiari klik egiterakoan taulaBirkargatu2 funtzioa martxan jarriko da
        $(".birkargatu").on("click", function () {
            taulaBirkargatu2();
        });

        // Eguneratu botoiari klik egiterakoan erregistroakEguneratu funtzioa martxan jarriko da
        $("#eguneratu").on("click", function (e) {
            // e.preventDefault-ek botoiaren funtzio nagusia (formularioaren informazioa bidaltzea orria birkargatuz) ezeztatzen du
            e.preventDefault();
            erregistroakEguneratu();
        });
        // Minuturo taulaBirkargatu funtzioa martxan jarriko da
        setInterval(taulaBirkargatu2, 60000);

    });
    // taulaBirkargatu1 funtzioa
    function taulaBirkargatu1() {
        // AJAX-a martxan jartzeko beharrezkoa den informazioa
        $.ajax({
            "url": "eragiketak.php",
            "method": "GET",
            "data": {
                "akzioa": "lortuPilotoak1"
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
                        $(".zerrenda").append("<tr class='" + info[i].class + "'><td>" + info[i].Postua + " </td><td>" + info[i].Dortsala + "</td><td>" + info[i].Izena + "</td></tr>");
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
    // erregistroakEguneratu funtzioa
    function erregistroakEguneratu() {
        // Formularioan sartutako datuak AJAX-era bidaltzeko sortutako aldagaiak
        var dortsala = $('#dortsala').val();
        var postua = $('#postua').val();
        // AJAX-a martxan jartzeko beharrezkoa den informazioa
        $.ajax({
            url: "eragiketak.php",
            method: "POST",
            data: {
                akzioa: "eguneratuPilotoak",
                dortsala: dortsala,
                postua: postua
            }
        })
            //AJAX-aren barruan dagoen akzioa ondo egin bada:
            .done(function (informazioa) {
                taulaBirkargatu1();

            })
            //AJAX-aren barruan dagoen akzioa gaizki egin bada:
            .fail(function () {
                alert("Zerbait gaizki joan da");
            })
            //AJAX-aren ondoren, beti egingo dena:
            .always(function () {

            });
    }
    // taulaBirkargatu2. --> taulaBirkargatu1-ek egiten duen funtzio berdina, aldaketa txiki batekin. (honek, taula birkargatzerakoan taulako datuen klasea kentzen du kolorerik ez agertzeko)
    function taulaBirkargatu2() {

        $.ajax({
            "url": "eragiketak.php",
            "method": "GET",
            "data": {
                "akzioa": "lortuPilotoak2"
            }
        })
            .done(function (informazioa) {

                var info = JSON.parse(informazioa);

                if (info.kopurua > 0) {
                    $(".zerrenda").html("");
                    for (var i = 0; i < info.kopurua; i++) {
                        $(".zerrenda").append("<tr class='" + info[i].class + "'><td>" + info[i].Postua + " </td><td>" + info[i].Dortsala + "</td><td>" + info[i].Izena + "</td></tr>");
                    }

                } else {
                    alert("Ez da elementurik kargatu");
                }

            })
            .fail(function () {
                alert("Gaizki joan da");
            })
            .always(function () {

            });
    }
</script>