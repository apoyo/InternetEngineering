<?php

require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
//$nazwa = $_POST['nazwa'];
//$haselko = $_POST['haselko'];
  //$ip = $_SERVER['REMOTE_ADDR'];

  $errors = [];

  $data = [];
$sec_key = '85ldofi';
$payload = array(
    'isd'=>'localhost',
    'aud'=>'localhost',
    'username'=> ' nazwa',
    'password' => 'haselko',
       
    
);

    $encode = JWT::encode($payload, $sec_key, 'HS256' );
    $header = apache_response_headers();
    var_dump($header);
    //echo $encode;
   //$decode = JWT::decode ($encode, new key($sec_key,'HS256'));
  // print_r($decode);


    $mysqli =  new mysqli("localhost","root","", "baza");/*  */

     


   

    if(mysqli_num_rows($mysqli->query("SELECT login  FROM users WHERE login = '".$nazwa."' ;")) > 0){
  

    $passwd_hash = current(($mysqli->query("SELECT password  FROM users WHERE login = '".$nazwa."' ;"))->fetch_assoc());

       if(password_verify($haselko ,$passwd_hash )==true){

      
       
            $mysqli->query("update users set  `logowanie` = '".time()."', `ip` ='".$ip."' WHERE login = '".$nazwa."'; ");
            $data['success'] = true;
            $data['message'] = 'Zalogowano!';
        }

        else{
          
            $errors['blad'] = 'Nieprawidlowa nazwa uzytkownika lub nieprawidlowe haslo' ;
        }
    }
        else{
           
            $errors['blad'] = 'Nieprawidlowa nazwa uzytkownika lub nieprawidlowe haslo' ;
        }
        
    
       if (!empty($errors)) {
        $data['success'] = false;
        $data['errors'] = $errors;

        } else {
        
            $data['success'] = true;
            $data['errors'] = $errors;
        }
       
    


        echo json_encode($data);
    
    ?>