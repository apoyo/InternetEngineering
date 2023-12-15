$("#message_send_form").submit(function (event) {





  });
  $("#message_send_form").submit(function (event) {
  
    var message_content = $("#wiadomosc").val() ;

    $.ajax({
      type: "POST",
      url: "login.php",
      data: formlogin,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log(data);

  



      
    });

    event.preventDefault();
  });