<?php

$errors = [];

$data = [];



$mysqli =  new mysqli("localhost","root","", "baza");

$login = $_POST['login'];
$haslo1 = $_POST['haslo1'];
$haslo2 = $_POST['haslo2'];
$email = $_POST['email'];
$ip = $_SERVER['REMOTE_ADDR'];
$dataur = $_POST['dataur'];

if( empty($_POST['login'])){


    $errors['login'] = 'Wybierz login';

}
if( empty($_POST['email'])){


    $errors['email'] = 'Wpisz mail';

}
if( empty($_POST['haslo1'])){


    $errors['haslo1'] = 'Wpisz haslo';

}

if( empty($_POST['haslo2'])){


    $errors['haslo2'] = 'Wpisz haslo';

}
 if( empty($_POST['dataur'])){


    $errors['dataur'] = 'Wybierz date';

 }

if(empty($_POST['plec'])){

    $errors['plec'] = 'Wybierz płeć';

 
}
if($_POST['haslo1']!=$_POST['haslo2']){

    $errors['haslo1'] = 'Hasła nie są takie same';
    $errors['haslo2'] = 'Hasła nie są takie same';

}

if (mysqli_num_rows($mysqli->query("SELECT login FROM users WHERE login = '".$login."';")) != 0)
{
    $errors['login'] = 'Podany login jest zajęty';

}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {

    $haslo_hash = password_hash($haslo1 , PASSWORD_DEFAULT);


    $plec = $_POST['plec'];
    
    $mysqli->query("INSERT INTO `users` (`login`, `password`, `email`, `rejestracja`, `logowanie`, `ip`,`plec`,`data_urodzenia`)
    VALUES ('".$login."', '".$haslo_hash."', '".$email."', '".time()."', '".time()."', '".$ip."','".$plec."','".$dataur."');");
   
   $data['success'] = true;
   $data['message'] = 'Udalo sie utworzyc konto!' ;
    

}



echo json_encode($data);




?>
