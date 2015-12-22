
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
             var time=new Date(Date.now());
              $.ajax({
              url: "ajax_detail.php", 
              type:'get',
              dataType:'json',
              data:{
                status:status,
                idd:id,
                reason:reason,
                time:time
              },
            success: function(result){
        if(v=='bl')
        {
          t.attr('at','unbl');
          t.find('input').attr('value','Unblock');
          t.parent().find('.c2').text(reason);
          t.parent().find('.c3').text(time);
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


 $('#t1').on('click','.c11',function(){
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
             var time=new Date(Date.now());

             console.log(time);
              $.ajax({
              url: "ajax_detail.php", 
              type:'get',
              dataType:'json',
              data:{
                status:status,
                idd:id,
                reason:reason,
                time:time
              },
            success: function(result){
        if(v=='bl')
        {
          t.attr('at','unbl');
          t.find('input').attr('value','Unblock');
          t.parent().find('.c2').text(reason);
          t.parent().find('.c3').text(time);
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


          $('.filter').on('click',function(){
           $('#t1').empty();
              var v=$(this).attr('proper');
              
              $.ajax({
              url: "ajax.php", 
              type:'get',
              dataType:'json',
              data:{
                status:v
              },
              success: function(result){
                for (var i = 0;i<result.length ; i++)
                  if(result[i]['blockun']==0) 
                    {
                     $('#t1').append('<tr class="row"><td class="cell">'+result[i]['EMAIL']+'</td><td class="cell">'+result[i]['PASSW']+'</td><td class="cell">'+result[i]['USER_NAME']+'</td><td class="cell">'+result[i]['PHONE']+'</td><td class="cell">'+result[i]['TimeStamp']+'</td><td >'+result[i]['MODIFIED']+'</td><td qual="col1" at="bl" class="c11 cell"><input type="submit" class="input" value="block" ></td><td qual="col1" class="c2 cell">'+result[i]['reason']+'</td> <td class="c3 cell">'+result[i]['blocktime']+'</td><td class="cell"><a href="#">link</a> </td></tr>');
                      }
                       else 
                        { 
                         $('#t1').append('<tr class="row"><td class="cell">'+result[i]['EMAIL']+'</td><td class="cell">'+result[i]['PASSW']+'</td><td class="cell">'+result[i]['USER_NAME']+'</td><td class="cell">'+result[i]['PHONE']+'</td><td class="cell">'+result[i]['TimeStamp']+'</td><td >'+result[i]['MODIFIED']+'</td><td qual="col1" at="unbl" class="c11 cell"><input type="submit" class="input" value="unblock" ></td><td qual="col1" class="c2 cell"></td><td class="c3 cell"></td><td class="cell"><a href="#">link</a> </td></tr> ');
                     } 
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
<h1 class="text-center">USER PAGE</h1>
</div>
<!-- filtering form --><div class="container">
 <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li class="filter" proper="Block"><a>Block</a></li>
      <li class="filter" proper="Unblock"><a>Unblock</a></li>
    </ul>
  </div>
</div>
<!-- form ends -->
<div id="table">
<table class="sortable table" border="2px" id="t">

<thead>
    <tr class="row header blue">
      <th class="cell" width="150">Email</th>
      <th width="150" class ="cell">Password</th>
      <th width="150" class="cell">Name</th>
      <th width="150"class="cell">PhoneNumber</th>
      <th width="150" class="cell">SignUp Time</th>
      <th width="150" class="cell">LastLogin Time</th>
      <th width="150" class="cell" >Block/Unblock</th>
      <th width="150" class="cell">Reason</th>
      <th width="150" class="cell">Time</th>
      <th width="150" class="cell">Facebook</th>
    </tr>
</thead>
  <tbody id="t1">

<?php
require_once('query.php');
$q = new Query();
$sql="select * from user ";
$val=$q->getallentires($sql);
foreach ($val as $value) {
?>
    <tr class="row" quality="<?php echo($value['USERID']) ?>">
      <td class="cell" ><?php echo($value['EMAIL']); ?></td>     
      <td class="cell"><?php echo($value['PASSW']); ?></td>
      <td class="cell"><?php echo($value['USER_NAME']); ?></td>
      <td class="cell"><?php echo($value['PHONE']); ?></td>
      <td class="cell"><?php echo($value['TimeStamp']); ?></td>
      <td class="cell"><?php echo($value['MODIFIED']); ?></td> 
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
              <input type="submit"   class="input" value="unblock" >
              </td>
              <td qual="col1" class='c2 cell'></td> 
              <td qual="col1" class='c3 cell'> </td>
              
              <?php     
            }
            ?> 
      <td class="cell"><a target="_blank" href="http://www.facebook.com/<?php echo($value['FACEBOOKID']);?>">facebook</a> </td>
      </tr>
 <?php
}
?>
 </tbody>
  </table>
</div>
</body>
</html>
