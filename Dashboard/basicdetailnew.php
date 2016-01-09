<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="table.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="sorttable.js" > </script>
</head>
<body>
<div data-position="fixed">
<h1 class="text-center"> BASIC DETAILS </h1>
</div>
<div id="table">
<table class="sortable table" border="2px" id="t">

<thead>
    <tr class="row header blue">
      <th class="cell" >Name</th>
      <th  class="cell">Facebook</th>
      <th class="cell" >Email</th>
      <th  class="cell">PhoneNumber</th>
      <th   class="cell">SignUp Time</th>
      <th   class="cell">LastLogin Time</th>
      <th   class="cell">Block/Unblock</th>
      <th   class="cell">Reason</th>
      <th   class="cell">Block Time</th>
      <th   class="cell">Profile Picture</th>
    </tr>
</thead>
  <tbody>

<?php

require_once('query.php');


$q = new Query();
$sql="select * from USER";
$val=$q->getallentires($sql);
foreach ($val as $value) {
?>
    <tr class="row" quality="<?php echo($value['USERID']); ?>" >
      <td class="cell"><?php echo($value['USER_NAME']); ?></td>     
      <td class="cell"><a href="#">link</a> </td>
      <td class="cell"><?php echo($value['EMAIL']); ?></td>
      <td class="cell"><?php echo($value['PHONE']); ?></td>
   <td class="cell"><?php echo($value['TimeStamp']); ?></td>
      <td class="cell c1"><?php echo($value['MODIFIED']); ?></td> 
         
          <?php 

            if($value['blockun']==0)
            {
              ?>
              <td qual="col1" at="bl" class="c1 cell">
                 <input type="submit"   class="input" value="block" >
              </td>                
        <td qual="col1" class='c2 cell'></td> 
        <td qual="col1" class='c3 cell'> </td>
          <?php    
            }
            else
            {
              ?>
              <td qual="col1" at="unbl" class="c1 cell">
              <input type="submit"   class="input" value="unblock" ></td>
                <td qual="col1" class='c2 cell'><?php echo $value['reason']; ?></td> 
        <td qual="col1" class='c3 cell'> </td>
              
              <?php     
            }
            ?>

            <td><a target="_blank"href=<?php echo $value['PROFILE_PIC']; ?> >PRofile Picture</a>
 
      </tr>
 <?php
}
?>
 </tbody>
</table>
</div>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script>
      jQuery(function($){
          $('.c1').on('click',function(){
             var v=$(this).attr('at'),reason="empty",status;

             if(v=="bl")
             {
         reason=prompt('Enter the reason');
         status=1;
       }
       else
       {
         status=0;
       }
             var id=$(this).parent().attr('quality');
             var t=$(this);
            // var time=new Date(Date.now());
              $.ajax({
              url: "ajax_detail.php", 
              type:'get',
              dataType:'json',
              data:{
                status:status,
                idd:id,
                reason:reason,
                time:new Date()
              },
            success: function(result){
        if(v=='bl')
        {
          t.attr('at','unbl');
          t.find('input').attr('value','Unblock');
          t.parent().find('.c2').text(reason);
          t.parent().find('.c3').text(t);
        }
        else
        {
          t.attr('at','bl');
          t.find('input').attr('value','block');
          t.parent().find('.c2').text('');
          t.parent().find('.c3').text('');
        }
        },
              error:function(){
                console.log("ajax failed");
              }
          
            });
        });

        });
    </script>
</body>
</html>