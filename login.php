<?php

require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
$nazwa = $_POST['nazwa'];
$haselko = $_POST['haselko'];

  $ip = $_SERVER['REMOTE_ADDR'];

  $errors = [];

  $data = [];
  
  

$mysqli =  new mysqli("localhost","root","", "baza");/*  */

     


   

    if(mysqli_num_rows($mysqli->query("SELECT login  FROM users WHERE login = '".$nazwa."' ;")) > 0){
  

    $passwd_hash = current(($mysqli->query("SELECT password  FROM users WHERE login = '".$nazwa."' ;"))->fetch_assoc());

       if(password_verify($haselko ,$passwd_hash )==true){

      
       
            $mysqli->query("update users set  logowanie = '".time()."', ip ='".$ip."' WHERE login = '".$nazwa."'; ");
            $data['success'] = true;
            $data['message'] = 'Zalogowano!';
            $data['login_info'] = 'Jestes zalogowany jako '.$nazwa;

            $sec_key = '851apoyo';
            $payload = array(
                'isd'=>'localhost',
                'aud'=>'localhost',
                'username'=> $nazwa,
                'password' => $haselko,
                   
                
            );
            
             $token = JWT::encode($payload,$sec_key, 'HS256') ;
             setcookie("jwt_token",$token,time() +( 86400 * 1 ), "/");
            
            try {
              $decoded = JWT::decode($token,new Key ($sec_key, 'HS256'));
              $nazwa = $decoded->username;
              $haselko = $decoded->password;
                }catch (\Exception $e){
                    
                  echo "Błąd: ".$e->getMessage();
                }




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
       
    


        echo json_encode($data)
    
    ?>