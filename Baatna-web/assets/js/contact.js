$(document).ready(function() {
 $('form').on('submit', function (e) {
  e.preventDefault();
//Rest of your code

    var proceed = true;
    //simple validation at client's end
    //loop through each field and we simply change border color to red for invalid fields       
    $("#contactform input[required=true], #contactform textarea[required=true]").each(function(){
        $(this).css('border-color',''); 
        if(!$.trim($(this).val())){ //if this field is empty 
            $(this).css('border-color','red'); //change border color to red   
            proceed = false; //set do not proceed flag
        }
        //check invalid email
        var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
        if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
            $(this).css('border-color','red'); //change border color to red   
            proceed = false; //set do not proceed flag              
        }   
    });

    if(proceed) //everything looks good! proceed...
    {
        //get input field values data to be sent to server
        post_data = {
            'name'      : $('input[name=name]').val(), 
            'email' : $('input[name=email]').val(), 
            'telephone' : $('input[name=telephone]').val(), 
            'msg'           : $('textarea[name=message]').val()
        };

        //Ajax post data to server
        $.post('contact.php', post_data, function(response){  
            if(response.type == 'error'){ //load json data from server and output message     
                output = '<div class="error">'+response.text+'</div>';
            }else{
                output = '<div class="success">'+response.text+'</div>';
                //reset values in all input fields
                $("#contactform  input[required=true], #contactform textarea[required=true]").val(''); 
                $("#contactform .white-spacing").slideUp(); //hide form after success
            }
            $("#contactform #contact_results").hide().html(output).slideDown();
        }, 'json');
    }
});

//reset previously set border colors and hide all message on .keyup()
$("#contactform  input[required=true], #contactform textarea[required=true]").keyup(function() { 
    $(this).css('border-color',''); 
    $("#result").slideUp();
});
});