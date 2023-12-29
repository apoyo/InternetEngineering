<?php







$mysqli =  new mysqli("localhost","root","", "messages");/*  */
$nadawca = $_GET['nadawca'];
$odbiorca = $_GET['odbiorca'];







$query1="SELECT tresc from messages where (nadawca='".$nadawca."' and odbiorca='".$odbiorca."' )   OR (nadawca='".$odbiorca."' and odbiorca='".$nadawca."') ";
$query2="SELECT nadawca from messages where (nadawca='".$nadawca."' and odbiorca='".$odbiorca."' )   OR (nadawca='".$odbiorca."' and odbiorca='".$nadawca."')  ";
$query3="SELECT odbiorca from messages where (nadawca='".$nadawca."' and odbiorca='".$odbiorca."' )   OR (nadawca='".$odbiorca."' and odbiorca='".$nadawca."')  ";
$query4="SELECT data_wyslania from messages where (nadawca='".$nadawca."' and odbiorca='".$odbiorca."' )   OR (nadawca='".$odbiorca."' and odbiorca='".$nadawca."')  ";

$result1=$mysqli->query($query1);

$result2=$mysqli->query($query2);

$result3=$mysqli->query($query3);

$result4=$mysqli->query($query4);

$response = array();


if($result1->num_rows >0){



    while($row = $result1->fetch_assoc()){

$response['tresc'][] = $row;
    }
}


if($result2->num_rows >0){



    while($row = $result2->fetch_assoc()){

$response['nadawca'][] = $row;
    }
}

if($result3->num_rows >0){



    while($row = $result3->fetch_assoc()){

$response['odbiorca'][] = $row;
    }
}

if($result4->num_rows >0){



    while($row = $result4->fetch_assoc()){

$response['data_wyslania'][] = $row;
    }
}





header('Content-Type: application/json');
echo json_encode($response);




?>