<!DOCTYPE html>
<html lang="en">
<body>
    <head>
        <link rel="stylesheet" href="boxcss.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 
<script>
  jQuery(function($){
           $('.clic').on('click',function()
           {
              touserid=$(this).attr('id'); 
              userid=$(this).attr('ano'); 
              access=$(this).attr('acc');  
              console.log(touserid);
              console.log(userid);
              console.log(access);
              $.ajax({
              url: "mess.php", 
              type:'get',
              dataType:'json',
              data:{
                TOUSERID:touserid,
                USERID:userid,
                tok:access
              },
              success: function(result) 
                {
                  $('#msgs').empty();
                  for(var i=0;i<result.length;i++)
                  {
                    if(result[i]['from']==userid)
                    {
                    $('#msgs').append('<div class="you">'+result[i]['msg'] +'</div');
                    }
                    else
                    {
                      $('#msgs').append('<div class="me">'+result[i]['msg'] +'</div');
                    }
                    console.log(result[i]['id']);
                  }
                console.log("ajax passed");
             },
              error:function(){
                console.log("ajax failed");
              }
            });
            });
           });
 
/*
function myFunction() {
    var x = document.getElementsByTagName("button")[0].getAttribute("id"); 
    return x;
    //document.getElementById("demo").innerHTML = x;
}
*/
  </script>
    </head>
    <body>
    <aside>     
         <?php
          foreach ($nam as  $value) {
            //echo "entere";
         ?>
          <div class="user">
          <button id='<?php echo $value['id'] ?>' ano='<?php echo "12"; ?>' acc="68474014519902762" class="clic" >
            <?php
            echo $value['name'];

          //<p id="demo"></p>
            ?>
          </button>
          </div>
          <?php
          }
          ?>
    </aside>
    <section>
            <article id="msgs">
            </article>
    
    <article>
                <input type="text" placeholder="Type a message" class="textbox">
    </article>
    </section>
</body>
</html>