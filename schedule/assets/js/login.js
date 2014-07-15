$(document).ready(function(){   


    $("#login_form").submit(function(evnt)
    {       
    evnt.preventDefault(); //Avoid that the event 'submit' continues with its normal execution, so that, we avoid to reload the whole page  
    alert(base_url);
    /*
     $.ajax({
         type: "POST",
         url: base_url + "login/validate_login", 
         data: {email: $("#email").val()},
         dataType: "text",  
         cache:false,
         success: 
              function(data){
                alert(data);  //as a debugging message.
              }
          });// you have missed this bracket
     return false;
     */
     });
    

 });

