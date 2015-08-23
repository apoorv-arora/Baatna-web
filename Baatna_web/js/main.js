$(function() {
  $('#signupForm').submit(signupHandler);
});

function signupHandler(e) {
  e.preventDefault();
  $.ajax({
    url: 'php/signup.php',
    type:'POST',
    data: { signupemail: $("#signupemail").val() },
    dataType: "json",
    success: function(r) {
      if(r.error === false) {
        $("#Confirm_pop").foundation('reveal', 'open');
        $('#signupForm').hide();
      } else {
        $("#errorDetails").html(r.msg);
        $("#Error_pop").foundation('reveal', 'open');
      }
    }
  });
  return false;
}
