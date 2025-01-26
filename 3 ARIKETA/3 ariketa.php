<!DOCTYPE html>
<html>
<head>
    <title>3. ariketa</title>
</head>
<body>
    <form method="GET" action="">
        <select id="select1" name="select1" onchange="aukerak()">
            <option value=""></option>
            <option value="Goierri">Goierri</option>
            <option value="Urola">Urola</option>
            <option value="Donostialdea">Donostialdea</option>
            <option value="Buruntzaldea">Buruntzaldea</option>
        </select>

        <select id="select2" name="select2">
            <option id="aukera1" value=""></option>
        </select>
    </form>

    <script src="https://code.jquery.com/jquery-3.7.1.js">​</script>

    <script>
        function aukerak() {
            var eskualdea = $('#select1').val();

            if (eskualdea === "") {
                $('#select2').html('<option value=""></option>');
                return;
            }
            $.ajax({
                url: "aukerak.php",
                method: "GET",
                data: {
                    akzioa: "lortuAukerak",
                    eskualdea: eskualdea
                }
            })
                .done(function (informazioa) {
                    var info = JSON.parse(informazioa);
                    $("#select2").html("<option id='aukera1' value=''></option>");
                    if (info.kopurua > 0) {
                        for (var i = 0; i < info.kopurua; i++) {
                            $("#select2").append("<option value='"+info[i].herria+"'>"+info[i].herria+"</option>");
                        }
                    }else{
                        $("#select2").html("<option value=''></option>");
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