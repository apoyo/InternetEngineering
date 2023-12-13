<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="form.js"></script>
    <link rel="stylesheet" href="style.css">
</head>


<body><div class="kontener">
<div class="lewy"><div class="main">
        <form action="login.php" method="post" id="login_form">
            <fieldset>
            <div id="nazwa_login_form">    <input type="text" placeholder="Wpisz nazwe uzytkownika" name="nazwa" id="nazwa"> <br><br></div>
            <div id="password_login_form"> <input type="password" placeholder="Wpisz haslo" name="haselko" autocomplete="on" id="haselko"><br><br></div>
              <div id="login_message" class="login_form_button">   <button type="submit" class="login_button">
                    Zaloguj się
                </button></div> 
                <a href="reminder.html">Zapomniałem hasła</a>
            </fieldset>
        </form>




    </div>
    <div class="register">

        <input value="Rejestracja" type="submit" id="registerbutton">

        <form action="process.php" method="POST" id="registration">
            <fieldset id="registerpool" style="display: none">
                <legend>Zarejestruj sie</legend>
                <div id="plec_form" class="form_form">
                    <p>Płeć : </p> &nbsp; kobieta<input type="radio" name="plec" id="plec_k" value="kobieta"> &nbsp;
                    mężczyzna<input type="radio"  id="plec_m"  name="plec" value="mezczyzna"> <br><br>
                </div>
                <div id="dataur_form" class="form_form">
                    Wybierz datę urodzenia <input type="date" id="dataur" name="dataur"><br><br></div>
                <div id="login_form" class="form_form"><input type="text" placeholder="Wpisz nazwe uzytkownika"
                        name="login" id="login"> <br><br></div>

                <div id="mail_form" class="form_form"> <input type="email" placeholder="Wpisz e-mail" name="email"
                        id="email"> <br><br></div>
                <div id="password_form" class="form_form">
                    <div id="password1_form" class="form_form"><input type="password" placeholder="Wpisz haslo"
                            name="haslo1" id="haslo1" autocomplete="on"><br><br> </div>
                    <div id="password2_form" class="form_form"> <input type="password"
                            placeholder="Wpisz haslo ponownie" name="haslo2" id="haslo2" autocomplete="on"><br><br></div>
                </div>
                <label for="file-upload" class="custom-file-upload">
                    Wgraj awatar
                    <input type="file" name="avatar" id="file-upload" accept=".jpg, .jpeg, .png" />
                </label><br><br>
                <button type="submit" class="btn btn-success">
                    Submit
                </button>
            </fieldset>
        </form>

    </div>
   <div class="chat_user_list" 

>


   <ul id="userList" ></ul>




   </div>
</div>

   <div class="message_form" style=" display: inline-block;

">
<form action="message.php" method="post">
<div id="message_story" style="
 width: 90%;
 height: 90%;  
 border: 1px solid #d63131;
 margin: 1px;
 "
 >
 <br>
 <br>
 <br>
 <br>
</div>
<br>
<input type="text" name="wiadomosc" id="wiadomosc">
<button>Wyślij wiadomosc</button>


</form>
</div>
   </div>

    <script>
    const registerpool = document.getElementById("registerpool");
    const registerbutton = document.getElementById("registerbutton");

    registerbutton.addEventListener("click", function() {


        registerpool.style.display = "block";


    });
    </script>
</body>

</html>