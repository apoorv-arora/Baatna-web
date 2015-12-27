<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>
<body>
<div class="row">
  <div class="medium-6 medium-centered large-4 large-centered columns">
    <!--<form id="form" method="post" action="">-->
     <input  type="submit" class="button expanded button1" value="Your Wishes">
     <input type="submit" class="button expanded button2" value="Your Offers">
     <p class="info"></p>
   <!-- </form>
-->    </div>
    </div>

</form>
</body>
</html>
<script>
  jQuery(function($){
          $('.button1').on('click',function(e){
             $('.info').empty();
              $.ajax({
              url: "httprequestview.php", 
              type:'get',
              dataType:'json',
               success:function(user) 
                {
                	for(var i=0;i<user.length;i++)
                	{
                		var obj3=user[i]['wish'];
                		var titl=obj3['title'];
        				var desc=obj3['description'];
       					var timeofpost=obj3['time_post'];
      					var requiredfor=obj3['required_for'];
                		$('.info').append('<p>You offered</p>' +titl+ '<br> '+desc+ ' <br>'+requiredfor+ ' <br>'+timeofpost+ ' <br> ');
                	}
                	console.log("ajax passed");
               },
             error:function(){
                
                console.log("ajax failed");
              }
          });
        });

            $('.button2').on('click',function(e){
              $('.info').empty();
              $.ajax({
              url: "httprequestoffers.php", 
              type:'get',
              dataType:'json',
               success:function(user) 
                {
                	for(var i=0;i<user.length;i++)
                	{
                		var obj3=user[i]['wish'];
                		var titl=obj3['title'];
        				var desc=obj3['description'];
       					var timeofpost=obj3['time_post'];
      					var requiredfor=obj3['required_for'];
                		$('.info').append('<p>You offered</p>' +titl+ '<br> '+desc+ ' <br>'+requiredfor+ ' <br>'+timeofpost+ ' <br> ');
                	}
                	console.log("ajax passed");
               },
             error:function(){
                
                console.log("ajax failed");
              }
          });
        });

        });
</script>