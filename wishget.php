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
    <div id="results"></div>

<div align="center">
<button class="load_more" id="load_more_button">load More</button>
<div class="animation_image" style="display:none;"><img src="ajax-loader.gif"> Loading...</div>
</div>


</form>
</body>
</html>
<script>

  jQuery(function($){
    
          $('.button1').on('click',function(){
            e=1;
            s=0;
            console.log(e);
             $('.info').empty();
              $.ajax({
              url: "httprequestview.php", 
              type:'get',
              dataType:'json',
              data:
              {
                start:0
              },
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
            $('.button2').on('click',function(){
              e=2;
              s=0;
              console.log(e);
              $('.info').empty();
              $.ajax({
              url: "httprequestoffers.php", 
              type:'get',
              dataType:'json',
              data:
              {
                start:0
              },
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

        $('.load_more').on('click',function(){
          console.log(e);
          console.log(s);
          s=s+2;
          if(e==1)
            $url="httprequestview.php";
          else
            $url="httprequestoffers.php";
          $.ajax({
              url: $url, 
              type:'get',
              dataType:'json',
              data:
              {
                start:s
              },
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
            // for load more
    /*  $(document).ready(function() {

  var track_click = 0; //track user click on "load more" button, righ now it is 0 click
  
  var total_pages = <?php echo $total_pages; ?>;
 // $('#results').load("fetch_pages.php", {'page':track_click}, function() {track_click++;}); //initial data to load

  $(".load_more").click(function (e) { //user clicks on button
  
    $(this).hide(); //hide load more button on click
    $('.animation_image').show(); //show loading image

    if(track_click <= total_pages) //make sure user clicks are still less than total pages
    {
      //post page number and load returned data into result element
      $.post('fetch_pages.php',{'page': track_click}, function(data) {
      
        $(".load_more").show(); //bring back load more button
        
        $("#results").append(data); //append data received from server
        
        //scroll page to button element
        $("html, body").animate({scrollTop: $("#load_more_button").offset().top}, 500);
        
        //hide loading image
        $('.animation_image').hide(); //hide loading image once data is received
  
        track_click++; //user click increment on load button
      
      }).fail(function(xhr, ajaxOptions, thrownError) { 
        alert(thrownError); //alert any HTTP error
        $(".load_more").show(); //bring back load more button
        $('.animation_image').hide(); //hide loading image once data is received
      });
      
      
      if(track_click >= total_pages-1)
      {
        //reached end of the page yet? disable load button
        $(".load_more").attr("disabled", "disabled");
      }
     }
      
    });
});*/
        });
</script>