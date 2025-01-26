<?php

function konexioaSortu()
{

    //datu basearekin konexioa egiteko beharrezko datuak
    $servername = "localhost:3306";
    $username = "root";
    $password = "1MG2024";
    $dbname = "8ataza";

    // Datu basearekin konexioa egin
    $conn = new mysqli($servername, $username, $password, $dbname);


    // Konexioa ondo atera den balioztatu
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}