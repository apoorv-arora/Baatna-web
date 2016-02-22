$("#contactForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "Did you fill in the form properly?");
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});


function submitForm(){
    // Initiate Variables With Form Content
    

    $.ajax({
    url: 'assets/php/contact.php',
    type:'POST',
    data: { name: $("#name").val(), email : $("#email").val(), phone: $("#phone").val(), message: $("#message").val() },
    dataType: "json",
    success: function(r) {
      if(r.error === false) {
        formSuccess();
      }
      else{
       formError();
      }
  }
             
  });
}

function formSuccess(){
    $("#myModal").modal();
}

function formError(){
   $("#myModal").modal();
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}