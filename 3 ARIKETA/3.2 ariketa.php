<!DOCTYPE html>
<html>

<head>
    <title>3. ariketa</title>
</head>
<?php
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


?>

<body>
    <form method="GET" action="">
        <!-- Formularioko lehen select-a. Eskualdea eskatzen du-->
        <select id="select1" name="select1" onclick="aukerak()">
            <option value=""></option>
            <option value="Goierri">Goierri</option>
            <option value="Urola">Urola</option>
            <option value="Donostialdea">Donostialdea</option>
            <option value="Buruntzaldea">Buruntzaldea</option>
        </select>

        <!-- Formularioko bigarren select-a. Eskualderen menpe herria eskatzen du-->
        <select id="select2" name="select2">
            <option id="aukera1" value=""></option>
        </select>
    </form>

    <!--Jquery esteka eta kodeari hasiera ematen dio-->
    <script src="https://code.jquery.com/jquery-3.7.1.js">​</script>

    <script>
        function aukerak() {

            var eskualdea = $('#select1').val();

            $.ajax({
                "url": "aukerak.php",
                "method": "GET",
                "data": {
                    "akzioa": "lortuAukerak"
                    "eskualdea": "eskualdea"
                }
            })

                .done(function () {
                    var info = JSON.parse(informazioa);

                    if (info.kopurua > 0) {
                        $("#aukera1").html("");
                        for (var i = 0; i < info.kopurua; i++) {
                            $("#select2").append("<option value='"+info[i].herria+"'>"+info[i].herria+"</option>");
                        }
                    }
                })
                .fail(function () {
                    alert("Zerbait gaizki joan da");
                })
                .always(function () {

                });

        }

    </script>
</body>

</html>