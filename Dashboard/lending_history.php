<?php
session_start();
if(!isset($_session['baatna']))
{
  header('Location:login.html');
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Lending history</title>
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="table.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="sorttable.js" > </script>

<script>
  jQuery(function($){
           $('.clic').on('click',function()
           {
            console.log('check');
              var wishid=$(this).parent().attr('at');
              
              console.log(wishid);
              $.ajax({
              url: "ajax_need_button.php", 
              type:'get',
              dataType:'json',
              data:{
                WISHID:wishid
               
              },
              success: function(result) 
                {
                  $('.mp').empty();
                  for(var i=0;i<result.length;i++)
                  {
                      $('.mp').append('<tr><td><a target="_blank" href="http://www.facebook.com/'+result[i]['FACEBOOKID']+'">FACEBOOK</a></td><td>'+result[i]['PHONE']+'</td><td>'+result[i]['EMAIL']+'</td><td class="cell"><?php if('+result[i][0]+'== 0) echo "DELETED"; elseif('+result[i][0]+'==1)echo "ACTIVE"; elseif('+result[i][0]+'==2)echo "ACCEPTED"; elseif('+result[i][0]+'==3) echo "OFFERED"; elseif('+result[i][0]+'==4) echo "RECEIVED"; elseif('+result[i][0]+'==5) echo "FULFILLED";?></td><td><a target="_blank" href="need_page.php?wishid=' +result[i][1] +'">Update</a></td></tr>');
                  }
                       
                console.log("ajax passed");
             },
              error:function(){
                console.log("ajax failed");
              }
            });

           });
   $('#t').on('click','.clic',function()
           {
            console.log('check');
              var wishid=$(this).parent().attr('at');
              
              console.log(wishid);
              $.ajax({
              url: "ajax_need_button.php", 
              type:'get',
              dataType:'json',
              data:{
                WISHID:wishid
               
              },
              success: function(result) 
                {
                  $('.mp').empty();
                  for(var i=0;i<result.length;i++)
                  {
                      $('.mp').append('<tr class="row"><td class="cell"><a target="_blank" href="http://www.facebook.com/'+result[i]['FACEBOOKID']+'">FACEBOOK</a></td><td class="cell">'+result[i]['PHONE']+'</td><td class="cell">'+result[i]['EMAIL']+'</td><td class="cell">'+result[i][0]+'</td><td class="cell"><a target="_blank" href="need_page.php?wishid=' +result[i][1] +'">Update</a></td></tr>');
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


</head>
<body>
<div data-position="fixed">
<h1 class="text-center">LENDING HISTORY </h1>
</div>
<div id="table">
<table class="sortable table" border="2px" id="t">
<thead>
   <tr class=" row header blue">
      <th class="cell" width="150">Needid</th>
      <th class="cell" width="150">Item Name</th>
      <th  class="cell" width="150" >Description</th>
      <th class="cell" width="150">Posted On</th>
      <th class="cell" width="150">Offered Time</th>
      <th  class="cell" width="150">Time period</th>
      <th class="cell"width="150">Borrower name</th>
      <th class="cell"width="150">Borrower email</th>
      <th class="cell"width="150">Borrower Phone</th>
      <th class="cell"width="150">Number of offers</th>
      <th class="cell"width="150">status</th>
      <th class="cell"width="150">chat</th>    
    </tr>
</thead>
  <tbody id="t1">

<?php

require_once('query.php');

$q = new Query();

$sql="SELECT user.USERID , user.USER_NAME , user.PHONE , user.EMAIL , user.FACEBOOKID , wish.STATUS , wish.WISHID , wish.TITLE , wish.DESCRIPTION , wish.TIME_OF_POST
FROM wish
INNER JOIN user
ON wish.USERID=user.USERID";

$val=$q->getallentires($sql);
foreach ($val as $value) {
?>
    <tr class="row" quality=" <?php echo($value['WISHID']) ?> ">
       <td class="cell"><a href="NEED_PAGE3.php?wishid=<?php echo $value['WISHID'] ?>"><?php echo($value['WISHID']); ?> </a> </td>    
      <td class="cell"><?php echo($value['TITLE']); ?></td>
      <td class="cell comment more"><?php echo($value['DESCRIPTION']); ?></td>
      <td class="cell"><?php echo($value['TIME_OF_POST']); ?></td>

      <td class="cell"><?php echo($value['offeredtime']); ?> </td>

      <td class="cell"><?php echo($value['timeperiod']); ?></td>

      <td class="cell"><?php echo($value['USER_NAME']); ?> </td>


      <td class="cell"><?php echo($value['EMAIL']); ?> </td>


      <td class="cell"><?php echo($value['PHONE']); ?> </td>

      <td class="cell" at= <?php echo ($value['WISHID']) ?> >
      <button type="button" class="btn btn-info btn-lg clic" data-toggle="modal" data-target="#myModal" >Offers</button>
      <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-body">
      <div>
      <table class="sortable table" border="2px">
      <thead>
      <tr class="row header blue">
      <th class="cell"width="50">Facebook</th>
      <th class="cell"width="50">Phone</th>
      <th class="cell"width="50">Email</th>
      <th class="cell"width="50">Status</th>
      <th class="cell"width="50">Update</th>
      </tr>
      </thead>
      <tbody class="mp">
      </tbody>
      </table>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </div>
      </div>
      </div>
      </td>
     
<td>
<?php
          if($value['STATUS']==0)
            echo "DELETED";
          elseif($value['STATUS']==1)
            echo "ACTIVE";
          elseif($value['STATUS']==2)
              echo "ACCEPTED";
          elseif($value['STATUS']==3)
              echo "OFFERED";
          elseif($value['STATUS']==4)          
              echo "RECEIVED";
            elseif($value['STATUS']==5)
              echo "FULFILLED";
?>
       </td> 
       <td> <a target="_blank" href="chatpage.php?wishid=<?php echo $value['WISHID'] ?>">CHAT</a></td>


       </tr>
 <?php
}
?>

 </tbody>
</table>
</div>

<!-- FOR MORE AND LESS TEXT -->
<script  type="text/javascript">
 $(document).ready(function() {
    var showChar = 30;
    var ellipsestext = "...";
    var moretext = "more";
    var lesstext = "less";
    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar-1, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
</script>
<style >
  a {
    color: #0254EB
}
a:visited {
    color: #0254EB
}
a.morelink {
    text-decoration:none;
    outline: none;
}
.morecontent span {
    display: none;
}
.comment {
    width: 400px;
    background-color: #f0f0f0;
    margin: 10px;
}
</body>
</html>