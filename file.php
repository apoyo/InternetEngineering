<div class="kontener"> 
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


   <ul id="userList" class="userList" ></ul>




   </div>
</div>

   <div class="message_form"  id="message_form" style=" display: inline-block;

">
<form action="message.php" method="post" id="message_send_form">
<div id="message_story" style="

 "
 >
 <br>
 <br>
 <br>
 <br>
</div>
<br>
<input type="text" name="wiadomosc" id="wiadomosc" style=" display: none;

" >
<button style=" display: none;

">Wyślij wiadomosc</button>


</form>
</div>
   </div>
   <script src="form.js"></script>
    <script>




    const registerpool = document.getElementById("registerpool");
    const registerbutton = document.getElementById("registerbutton");

    registerbutton.addEventListener("click", function() {


        registerpool.style.display = "block";


    });
    </script>












var OdKogo ;



function getUsers(){

$.ajax({
  url: 'get_users.php',
  type: 'GET',
  dataType:'json',
  success: function(data){
    var userList = $('#userList');
    $("#userList").empty();
    let currentId = 1;
    $("#userList")..append('Nazwa użytkownika'+'<br><br>');
    $.each(data, function(index,users){ 
      const userId = currentId++;
      $("#userList").append( '<li data-user-id ="' + userId +'" ><a>  ' + users.login +'</a></li>' +'');


    });




  }, 
  error:function(xhr,status,error){
    console.error('Wystąpił błąd podczas pobierania danych : '+ error)
  }




});






}


$(document).ready(function () {
    $("#registration").submit(function (event) {
      var formData = {
        login: $("#login").val(),
        email: $("#email").val(),
          plec:$("input[type='radio'][name='plec']:checked").val(),
       dataur: $("#dataur").val(),
        haslo1: $("#haslo1").val(),
        haslo2: $("#haslo2").val(),
      };   

     
     
      $.ajax({
        type: "POST",
        url: "process.php",
        data: formData,
        dataType: "json",
        encode: true,
      }).done(function (data) {

        console.log(data);

        if (!data.success) {
          
          if (data.errors.plec) {
  

            $("#plec_form").addClass("has-error");
            $("#plec_form").append(
              '<div class="help-block">' + data.errors.plec + "</div>"
      
          );
          }
 
        if (data.errors.dataur) {
          $("#dataur_form").addClass("has-error");
          $("#dataur_form").append(
            '<div class="help-block">' + data.errors.dataur + "</div>"
          );
        }
 
          if (data.errors.login) {
            $("#login_form").addClass("has-error");
            $("#login_form").append(
              '<div class="help-block">' + data.errors.login + "</div>"
            );
          }
            if (data.errors.email) {
              $("#mail_form").addClass("has-error");
              $("#mail_form").append(
                '<div class="help-block">' + data.errors.email + "</div>" );
              }

                if (data.errors.haslo1) {
                  $("#password1_form").addClass("has-error");
                  $("#password1_form").append(
                    '<div class="help-block">' + data.errors.haslo1 + "</div>"  
              );
                  }
              if (data.errors.haslo2) {
                $("#password2_form").addClass("has-error");
                $("#password2_form").append(
                  '<div class="help-block">' + data.errors.haslo2 + "</div>"  
            );

          }
       } else {

         $(".register").html('<div class="alert alert-success">' + data.message + "</div>").hide().fadeIn();

         
        } 


      });
  
      event.preventDefault();
    });




    $("#login_form").submit(function (event) {
      var formlogin = {
        nazwa: $("#nazwa").val(),
         haselko: $("#haselko").val(),
         
       }; 
  
      $.ajax({
        type: "POST",
        url: "login.php",
        data: formlogin,
        dataType: "json",
        encode: true,
      }).done(function (data) {
        console.log(data);

        if (!data.success) {
          
          if (data.errors.blad) {
          
            $("#password_login_form").addClass("has-error");
            $("#password_login_form").append(
              '<div class="help-block">' + data.errors.blad + "</div>"
              
          );
          }
 
        
         } else {

         $(".main").html('<div class="alert alert-success">' + data.message + "</div>").hide().fadeIn().fadeOut();
         //$(".main").html('<div class="alert alert-success">' + data.login_info + "</div>").hide().fadeIn();
         $(".login_info").html('<div class="alert alert-success">' + data.login_info + "</div>").hide().fadeIn();
         OdKogo=data.login_nazwa;
         

         $(".register").empty();

         getUsers();


         $("#message_form").css("display", "inline-block");

         $("#message_story").css({
          "width": "90%",
          "height": "90%",
          "border": "1px solid #d63131",
          "margin": "1px",
          "background-color": "white",
          "border": "2px solid red",
          "padding": "10px"
      });


      $("#wiadomosc, #message_send_form button").css("display", "inline-block");

        } 



        
      });
  
      event.preventDefault();
    });
    $("#message_send_form").submit(function (event) {
    
 var selected_Items = document.getElementById("userList").getElementsByClassName("selected");

      if(selected_Items.length>0){

        var DoKogo = selected_Items[0].innerText;
      }




   var message_content = {
    tresc: $("#wiadomosc").val(),
   nadawca : OdKogo,
   odbiorca : DoKogo,
   }; 
   if(message_content.tresc.trim() !==''){

    document.getElementById("wiadomosc").value = '';


    console.log(message_content.tresc);
    console.log(message_content.nadawca);
  console.log(message_content.odbiorca);
      $.ajax({
        type: "POST",
        url: "message.php",
        data: message_content,
        dataType: "json",
        encode: true,
      }).done(function (data) {
        console.log(data);

 
  
  
        
      });
    
   } else {
    alert("Pole tekstowe nie może być puste!");
   }  

  
      event.preventDefault();
    });

  
    





  





  });










  


  var userList = $('#userList');
  $('#userList').on('click', 'li', function() {
    $('#userList').find('li').removeClass('selected');
  
    $(this).addClass('selected');
  
    const userId = $(this).data('user-id');
 var selected_Items = document.getElementById("userList").getElementsByClassName("selected");

      if(selected_Items.length>0){

        var DoKogo = selected_Items[0].innerText;
      }
   console.log('Nadawca', OdKogo);
   console.log('Odbiorca', DoKogo);

   var MsgData ={


    nadawca: OdKogo,
    odbiorca: DoKogo,


  };

  $.ajax({
    url: 'get_messages.php',
    type: 'GET',
    data: MsgData,
    dataType:'json',
    success: function(data){
      console.log(data);
      console.log('COKOLWIEK');

    displayMessages(data);
  
  
  
    }, 
  
  
  
  
  });





















  

   // console.log('Clicked user with ID:', userId);

























 
  });

  function displayMessages(data) {

   // if(data && Object.keys(data).length > 0 ){
    document.getElementById("message_story").innerHTML = '';

    
      for (var i = 0; i < data.tresc.length; i++) {
        var messageDiv = document.createElement("div");
  
        //messageDiv.textContent = data.data_wyslania[i].data_wyslania + '.<br>.' + data.tresc[i].tresc;
    // console.log(data.odbiorca[i].odbiorca);
    // console.log('Odkogo to',OdKogo);
   //  if (data.odbiorca[i].odbiorca == OdKogo) {
//    console.log('dziala');
//  }
        // Dodaj klasę CSS w zależności od nadawcy

        // Tworzenie elementu div dla daty
        var dateDiv = document.createElement("div");
        var FormattedDate =  moment(data.data_wyslania[i].data_wyslania).format('DD/MM/YYYY HH:mm:ss');
        dateDiv.textContent = data.nadawca[i].nadawca + ' :: ' + moment(data.data_wyslania[i].data_wyslania).format('DD/MM/YYYY HH:mm:ss');
        dateDiv.className = "date-message";

        // Tworzenie elementu div dla treści wiadomości
        var contentDiv = document.createElement("div");
        contentDiv.textContent = data.tresc[i].tresc;
        contentDiv.className = "content-message";


        messageDiv.appendChild(dateDiv);
        messageDiv.appendChild(contentDiv);

        if (data.odbiorca[i].odbiorca == OdKogo) {
            messageDiv.className = "left-message";
        } else {
            messageDiv.className = "right-message";
        }
    
       
        document.getElementById("message_story").appendChild(messageDiv);
     
    }
    

  
    
    
    
//    }
    }









     <!-- Sidebar -->
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
        <div class="position-sticky">
          <ul class="nav flex-column" id="userList">


            <!-- <li class="nav-item">
              <a class="nav-link active" href="#">
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                Orders
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                Products
              </a>
            </li> -->
            <!-- Add more sidebar items as needed -->
          </ul>
        </div>
      </nav>

