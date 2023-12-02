<?php


$errors = [];

$data = [];

    $mysqli =  new mysqli("localhost","root","", "baza");/*  */

     
 $nazwa = $_POST['nazwa'];
  $haselko = $_POST['haselko'];
    $ip = $_SERVER['REMOTE_ADDR'];

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