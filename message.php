<?php

$mysqli =  new mysqli("localhost","root","", "messages");/*  */
$nadawca = $_POST['nadawca'];
$odbiorca = $_POST['odbiorca'];
$tresc = $_POST['tresc'];






$query = "insert into messages (tresc,nadawca,odbiorca) values('$tresc','$nadawca','$odbiorca')";
$mysqli->query($query);






?>