<?php

$mysqli =  new mysqli("localhost","root","", "messages");/*  */
$nadawca = $_POST['nadawca'];
$odbiorca = $_POST['odbiorca'];
$tresc = $_POST['tresc'];


$nazwa_tabeli = "m_from_".$nadawca."_to_".$odbiorca;

$tworzenie_tabeli = " CREATE TABLE IF NOT EXISTS $nazwa_tabeli ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nadawca VARCHAR(255) NOT NULL,
odbiorca VARCHAR(255) NOT NULL,
tresc TEXT,
data_wyslania TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

if ($mysqli->query($tworzenie_tabeli) === TRUE) {
    echo "Tabela wiadomosci została utworzona lub już istnieje";
} else {
    echo "Error creating table: " . $mysqli->error;
}


//echo $nazwa_tabeli;



$query = "Insert into  $nazwa_tabeli (tresc) values('$tresc')";
$mysqli->query($query);






?>