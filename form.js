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

         $(".main").html('<div class="alert alert-success">' + data.message + "</div>").hide().fadeIn();

         
        } 



        
      });
  
      event.preventDefault();
    });

    











  });


  