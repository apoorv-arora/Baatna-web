$(function() { $('#referralForm').submit(referHandler); });

function referHandler(e) {
  e.preventDefault();
  $.ajax({
    url: 'php/refer.php',
    type:'POST',
    data: { emails: $("#emails").val(), token: $("#token").val() },
    dataType: "json",
    success: function(r) {
      if(r.error) {
        $("#errorDetails").html(r.msg);
        $("#Error_pop").foundation('reveal', 'open');
      } else {
        $("#Confirm_pop").foundation('reveal', 'open');
        $('#referralForm').hide();
      }
    }               
  });
  return false;

}
