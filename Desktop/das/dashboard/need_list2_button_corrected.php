<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="table.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="sorttable.js"> </script>
<script>
  jQuery(function($){
          $('.filter').on('click',function(){
              var v=$(this).attr('proper');
            $('#t1').empty();
              $.ajax({
              url: "ajax_need.php", 
              type:'get',
              dataType:'json',
              data:{
                STATUS:v
              },
              success: function(result){
               for (var i = 0;i<result.length ; i++)
                {
                  	$('#t1').append('<tr class="row"><td class="cell">'+result[i]['WISHID']+'</td><td class="cell">'+result[i]['TITLE']+'</td><td class="cell">'+result[i]['DESCRIPTION']+'</td><td class="cell">'+result[i]['timeperiod']+'</td><td class="cell">'+result[i]['TIME_OF_POST']+'</td><td class="cell">'+result[i]['USER_NAME']+'</td><td class="cell">'+result[i]['PHONE']+'</td><td class="cell">'+result[i]['EMAIL']+'</td><td class="cell" at="'+result[i]['WISHID']+'"><button type="button" class="btn btn-info btn-lg clic" data-toggle="modal" data-target="#myModal" >Offers</button><div class="modal fade" id="myModal" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"><div><table class="sort" border="2px"><thead><tr class="row header blue"><th  class="cell" width="50">Facebook</th><th class="cell" width="50">Phone</th><th class="cell" width="50">Email</th><th class="cell" width="50">Status</th><th class="cell" width="50">Update</th></tr></thead><tbody class="mp"></tbody></table></div></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div></td><td> '+v+'</td><td class="rem cell"><input type="submit" qual="r" value="remove"></td><td class="cell">'+result[i]['logisticid']+'</td></tr>');
            }
             },
              error:function(){
                console.log("ajax failed");
              }
            });
          });
      });
</script>

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
                     $('.mp').append('<tr class="row"><td class="cell"><a target="_blank" href="http://www.facebook.com/'+result[i]['FACEBOOKID']+'">FACEBOOK</a></td><td class="cell">'+result[i]['PHONE']+'</td><td class="cell">'+result[i]['EMAIL']+'</td><td class="cell">'+result[i][0]+'</td><td class="cell"><a target="_blank" href="need_page.php?wishid=' +result[i][1] +'">Update</a></td></tr>');
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
                      $('.mp').append('<tr class="row"><td class="cell"><a target="_blank" href="http://www.facebook.com/'+result[i]['FACEBOOKID']+'">FACEBOOK</a></td><td class="cell">'+result[i]['PHONE']+'</td><td class="cell">'+result[i]['EMAIL']+'</td><td class="cell"><?php if('+result[i][0]+'== 0) echo "DELETED"; elseif('+result[i][0]+'==1)echo "ACTIVE"; elseif('+result[i][0]+'==2)echo "ACCEPTED"; elseif('+result[i][0]+'==3) echo "OFFERED"; elseif('+result[i][0]+'==4) echo "RECEIVED"; elseif('+result[i][0]+'==5) echo "FULFILLED";?></td><td class="cell"><a target="_blank" href="need_page.php?wishid=' +result[i][1] +'">Update</a></td></tr>');
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

<!-- filtering form -->

</head>
<body>
<div data-position="fixed">
<h1 class="text-center">NEED LIST</h1>
</div>
<div class="container">
 <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li class="filter" proper="DELETED"><a>DELETED</a></li>
      <li class="filter" proper="ACTIVE"><a>ACTIVE</a></li>
      <li class="filter" proper="ACCEPTED"><a>ACCEPTED</a></li>
       <li class="filter" proper="OFFERED"><a>OFFERED</a></li>
        <li class="filter" proper="RECEIVED"><a>RECEIVED</a></li>
         <li class="filter" proper="FULFILLED"><a>FULFILLED</a></li>
          </ul>
  </div>
</div>

<!-- form ends -->

<div id="table">
<table class="sortable table" border="2px" id="t">
<thead>
    <tr class=" row header blue">
       <th width="150" class="cell">Needid</th>
      <th width="150" class="cell">Item Name</th>
      <th width="150" class="cell">Description</th>
      <th width="150" class="cell">Time period</th>
      <th width="150" class="cell">Posted On</th>
      <th width="150" class="cell">username</th>
      <th width="150" class="cell">phone number</th>
      <th width="150" class="cell">email</th>
      <th width="150" class="cell">Number of offers</th>
      <th width="150" class="cell">status</th>
      <th width="150" class="cell">remove</th>
      <th width="150" class="cell">logisticid</th>  
    </tr>
</thead>
  <tbody id="t1">

<?php

require_once('query.php');

$q = new Query();

$sql="SELECT user.USERID , user.USER_NAME , user.PHONE , user.EMAIL , user.FACEBOOKID , wish.STATUS, wish.WISHID , wish.TITLE , wish.DESCRIPTION , wish.TIME_OF_POST
FROM wish
INNER JOIN user
ON wish.USERID=user.USERID";

$val=$q->getallentires($sql);
foreach ($val as $value) {
?>
    <tr class="row"  quality=" <?php echo($value['WISHID']) ?>">
     <td class="cell"><a href="#"><?php echo($value['WISHID']); ?> </a> </td>    
      <td class="cell"><?php echo($value['TITLE']); ?></td>
      <td class="cell comment more">

      <?php echo($value['DESCRIPTION']); ?></td>
       <td class="cell" ><?php echo($value['timeperiod']); ?></td>     
      <td class="cell"><?php echo($value['TIME_OF_POST']); ?></td>

      <td class="cell"><?php echo($value['USER_NAME']); ?></td>     
      <td class="cell"><?php echo($value['PHONE']); ?></td>
      <td class="cell"><?php echo($value['EMAIL']); ?></td>

         
      <td class="cell" at= <?php echo ($value['WISHID']) ?> >
      <button type="button" class="btn btn-info btn-lg clic" data-toggle="modal" data-target="#myModal" >Offers</button>
      <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-body">
      <div>
      <table class="sorttable table" border="2px">
      <thead>
      <tr class="row header blue">
      <th class="cell" width="50">Facebook</th>
      <th class="cell" width="50">Phone</th>
      <th class="cell" width="50">Email</th>
      <th class="cell" width="50">Status</th>
      <th class="cell" width="50">Update</th>
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
     
      <td class="cell">  <?php
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
              echo "FULFILLED"; ?>
      </td>

       <td class="rem cell">

       <input type="submit" qual="r" value="remove"></input>

       </td>
        
      <td class="cell"> <?php


$q3 = new Query();
$sql3= "SELECT LOGISTICID from LOGISTIC where USERID_ONE=$id ";
$val3=$q3->getallentires($sql3);
       echo($value['logisticid']); ?> </td>
      
      </tr>
 <?php
}
?>
 </tbody>
</table>

<!-- for remove button -->

<script>
  jQuery(function($){
           $('.rem').on('click',function()
           {
             $('#t1').empty();
                 var id=$(this).parent().attr('quality');
               console.log(id);
              $.ajax({
              url: "ajax_need_history.php", 
              type:'get',
              dataType:'json',
              data:{
                idd:id
              },
              success: function(result) 
                {

                  for (var i = 0;i<result.length ; i++)
                      $('#t').append('<tr quality='+ result[i]['WISHID']+'><td><a href="#">'+ result[i]['WISHID'] +' </a> </td><td>'+ result[i]['TITLE'] +' </td><td class=" comment more">'+ result[i]['DESCRIPTION'] +' </td><td>'+ result[i]['timeperiod'] +'</td><td>'+ result[i]['TIME_OF_POST'] +' </td><td>'+ result[i]['USER_NAME'] +' </td><td>'+ result[i]['PHONE'] +' </td><td>'+ result[i]['EMAIL']+'</td><td>'+ result[i]['numoffers'] +'</td><td>'+ result[i]['status'] +'</td><td class="rem"><input type="submit" qual="r" value="remove"></input></td></tr>');
                
                       
                console.log("ajax passed");
             },
              error:function(){
                console.log("ajax failed");
              }
            });

           });
         });
</script>

<!-- IGNORE -->

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

</style>
</body>
</html>