
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
            taulaBirkargatu2();
        });


        $("#eguneratu").on("click", function (e) {
            e.preventDefault();
            erregistroakEguneratu();
        });

        setInterval(taulaBirkargatu, 60000);

    });

    function taulaBirkargatu1() {

        $.ajax({
            "url": "eragiketak.php",
            "method": "GET",
            "data": {
                "akzioa": "lortuPilotoak1"
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
    function erregistroakEguneratu() {
        var dortsala = $('#dortsala').val();
        var postua = $('#postua').val();
        $.ajax({
            url: "eragiketak.php",
            method: "POST",
            data: {
                akzioa: "eguneratuPilotoak",
                dortsala: dortsala,
                postua: postua
            }
        })
            .done(function (informazioa) {
                taulaBirkargatu();

            })
            .fail(function () {
                alert("Zerbait gaizki joan da");
            })
            .always(function () {

            });
    }
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