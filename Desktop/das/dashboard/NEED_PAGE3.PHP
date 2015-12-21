<!DOCTYPE html>
<html>
<head>
  <title>Needpage</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="table.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="sorttable.js" > </script>

</head>
<body>
<h1 class="text-center">NEED PAGE</h1>
<div id="table">
<table class="sortable table" border="2px" id="t">
<thead>
    <tr class="row header blue">
      <th class=" cell" width="50">WISHid</th>
      <th class=" cell" width="50">Item Name</th>
      <th class=" cell" width="50">Description</th>
      <th class=" cell" width="50">Number of Days</th>
      <th  class=" cell" width="50">Posted On</th>
      <th class=" cell" width="50">Number of offers</th>
      <th class=" cell" width="50">Borrower Name</th>
      <th class=" cell" width="50">Borrower PHONE</th>
      <th class=" cell" width="50">Borrower Email</th>
      <th class=" cell" width="50">Lender Name</th>
      <th class=" cell" width="50">Lender Phone</th>
      <th class=" cell" width="50">Lender Email</th>     
      <th class=" cell" width="50">Offered Time</th>
      <th class=" cell" width="50">Logistic Type</th>  
      <th class=" cell" width="50">Borrower Address</th>
      <th class=" cell" width="50">Lender Address</th>
      <th class=" cell" width="50">status</th>
      <th class=" cell" width="50">Delivered Time</th>
      <th class=" cell" width="50">LogisticId</th>
      <th class=" cell" width="50">Delivered On</th>
      <th class=" cell" width="50">Return Deadline</th>
      <th class=" cell" width="50">Return Pickup addr</th>
      <th class=" cell" width="50">Return delivery addr</th>
      <th class=" cell" width="50">Return Logistic Id</th>
      <th class=" cell" width="50">Returned Date</th>
      <th class=" cell" width="50">Amount Collected</th>

    </tr>
</thead>
<tbody id="t1">

<?php

require_once('query.php');
$WISHID=$_GET['wishid'];
$q = new Query();

$sql="SELECT user.USERID , user.USER_NAME , user.PHONE , user.EMAIL , user.ADDRESS, user.FACEBOOKID , wish.STATUS, wish.WISHID , wish.TITLE , wish.DESCRIPTION , wish.TIME_OF_POST ,wish.AMOUNT,wish.STATUSHOST
FROM wish
INNER JOIN user
ON wish.USERID=user.USERID
where wish.WISHID=$WISHID";

$val=$q->getallentires($sql);

foreach ($val as $value) {
?>
 <tr class="row">
     <td class="cell"><?php  echo "$WISHID" ?> </a> </td>    
      <td class="cell"><?php echo($value['TITLE']); ?></td>
      <td class="cell comment more"><?php echo($value['DESCRIPTION']); ?></td>
      <td class="cell"><?php echo($value['NO_OF_DAYS']); ?></td>
      <td class="cell"><?php echo($value['TIME_OF_POST']); ?></td>


       <td class="cell" id="clear" gp="AMOUNT" a= <?php echo ($value['USERID']) ?> value="<?php echo($value['AMOUNT']); ?>" >
       <input type="text" class="d1">
       <input type="submit" class="d2" value="submit"> 
      </td>
      <td  id="clear" class="cell" gp="STATUSHOST" a=<?php echo ($value['USERID']) ?> value="<?php echo($value['STATUSHOST']); ?>">
       <input type="text" class="d1">
      <input type="submit" class="d2" value="submit">
      </td>
      

</tr>
</tbody>
<?php
}
?>
<script>
  jQuery(function($){
           $('.d2').on('click',function()
           {
              var p=$(this).parent().find('.d1').val();
              var gpa=$(this).parent().attr('gp');
              var a=$(this).parent().attr('a');
              console.log(p);
              $.ajax({
              url: "ajax_need_page.php", 
              type:'get',
              dataType:'json',
              data:{
                v:p,
                gp:gpa,
                at:a
              },
              success: function(result) 
                {
                       
                console.log("ajax passed");
             },
              error:function(){
                console.log("ajax failed");
              }
            });

           });
         });
</script>

<!-- for more or less -->
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