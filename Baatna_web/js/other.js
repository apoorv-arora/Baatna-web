$('#submit').click(function() {
  $.ajax({
    url: 'php/contact.php',
    type:'POST',
    data: { Name: $("#name").value, Email: $("#email").value, Subject: $("#subject").value, Message: $("#message").value },
    success: function() {
      $("#form_pop").hide();
    }               
  });
});
//auto expand textarea
function adjust_textarea(h) {
  h.style.height = "20px";
  h.style.height = (h.scrollHeight)+"px";
}
$(function(){
  var boxes = $('[data-scroll-speed]'),
  $window = $(window);
  $window.on('scroll', function(){
    var scrollTop = $window.scrollTop();
    boxes.each(function(){
      var $this = $(this),
      scrollspeed = parseInt($this.data('scroll-speed')),
      val = - scrollTop / scrollspeed;
      $this.css('transform', 'translateY(' + val + 'px)');
    });
  });

  $(".toggle_ele").click(function() {
    $(".all_features").eq(0).removeClass("show").addClass("hide");
    $(".all_features").eq(1).removeClass("hide").addClass("show");
    $(".second-feature-section").removeClass("hide");
  });

  $(".header a.button").click(function(e) {
    e.preventDefault();
    var t = $(this).data("tab");
    console.log(t);
    $('html, body').animate({ scrollTop: $("[data-section=" + t + "]").offset().top - 30 }, 300);
  });
})
$(document).foundation();
