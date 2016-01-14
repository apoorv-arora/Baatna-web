<!DOCTYPE>
<html lang="en">
  <head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/css/foundation.css">
  <link rel="stylesheet" type="text/css" href="table.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <meta charset="UTF-8">
  <title>Wish Post</title>
  </head>
<body>
<div class="row">
  <div class="medium-6 medium-centered large-4 large-centered columns">
    <form id="form" method="post" qual="<?php echo $access_token; ?>">
      <div at="p" class="row column log-in-form">
        <h4 class="text-center">Post a Wish</h4>
        <label>Title
        <input type="text" id="title" >
        </label>
        <label>Description
          <input type="text" id="desc" >
        </label>
        <label>Time Period
          <input type="text" id="time" >
        </label>
        <p>
        <input type="submit" class="button expanded " >
        </p>
        <p class="pp"></p>
        </div>
    </form>
    </div>
    </div>
    <script>
  jQuery(function($){
          $('#form').submit(function(e){
              e.preventDefault();  
              $('.pp').empty();
              var title=$('#title').val();
              var token=$(this).attr('qual');
              console.log(token);
              var desc=$('#desc').val();
              var time=$('#time').val();
              $.ajax({
              url: "ajax22.php", 
              type:'get',
              dataType:'json',
              data:{
                title:title,
                description:desc,
                tok:token,
                required_for:time
                  },
             success:function(result) 
                {
                $('.pp').append('wish posted');                 
                console.log("ajax passed");
               },
             error:function(){
                $('.pp').append('wish posted');
                console.log("ajax failed");
              }
          });
        });
        });
</script>
</body>