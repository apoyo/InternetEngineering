<?php
$sec_key = '851apoyo';
  $payload = array(
      'isd'=>'localhost',
      'aud'=>'localhost',
      'username'=> $nazwa,
      'password' => $haselko,
         
      
  );
  
   $token = JWT::encode($payload, $sec_key, 'HS256' );
   setcookie("jwt_token",$token,time() +( 86400 * 1 ), "/")
  
  try{
    $decoded = JWT::decode($token,$sec_key,['HS256']);
    $nazwa = $decoded->username;
    $haselko = $decoded->password;
      }catch (\Exception $e){


        echo "Błąd: ".$e->getMessage();
      }
  
if(isset($_COOKIE['jwt_token'])){

 $token = $_COOKIE['jwt_token'];
 try {
    $decoded = JWT::decode($token, $key, ['HS256']);
    // Token jest ważny, dostęp do klaim
    $userId = $decoded->user_id;
    $username = $decoded->username;
} catch (\Exception $e) {
    // Token jest nieprawidłowy lub wygasł
    echo "Błąd: " . $e->getMessage();
}
} else {
// Brak tokena, użytkownik nie jest zalogowany
}



  ?>