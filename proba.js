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




  $.ajax({
    url: 'get_messages.php',
    type: 'GET',
    data: MsgData,
    dataType:'json',
    success: function(data){
    displayMessages(data);
 
  
  
  
    }, 
    error:function(xhr,status,error){
      console.error('Wystąpił błąd podczas pobierania danych : '+ error)
    }
  
  
  
  
  });
  OR nadawca='".$odbiorca."' and odbiorca='".$nadawca."'