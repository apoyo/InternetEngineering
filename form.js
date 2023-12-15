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
  
      event.preventDefault();
    });

  
    





  





  });










  


  var userList = $('#userList');
  userList.on('click', 'li', function() {
    userList.find('li').removeClass('selected');
  
    $(this).addClass('selected');
  
    const userId = $(this).data('user-id');
   // console.log('Clicked user with ID:', userId);

























 
  });

  