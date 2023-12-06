<?php


$conn = new mysqli('localhost','root' , '','baza');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT login FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode($users);
} else {
    echo json_encode(array('message' => 'Brak użytkowników w bazie danych.'));
}

$conn->close();
?>
