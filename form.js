var OdKogo ;



function getUsers(){

$.ajax({
  url: 'get_users.php',
  type: 'GET',
  dataType:'json',
  success: function(data){
    var userList = $('#userList');
    userList.empty();
    let currentId = 1;
userList.append('Nazwa użytkownika'+'<br><br>');
    $.each(data, function(index,users){ 
      const userId = currentId++;
userList.append( '<li data-user-id ="' + userId +'"><a>  ' + users.login +'</a></li>' +'');


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
         $(".main").html('<div class="alert alert-success">' + data.login_info + "</div>").hide().fadeIn();
         OdKogo=data.login_nazwa;
         

         $(".register").empty();

         getUsers();








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
  userList.on('click', 'li', function() {
    userList.find('li').removeClass('selected');
  
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