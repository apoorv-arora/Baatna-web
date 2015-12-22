<head><link rel="stylesheet" type="text/css" href="table.css">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"> </script>
<script src="sorttable.js" > </script>

<html>
<body>
<table class="sortable table" border="2px" id="t">
<thead>
    <tr class=" row header blue">
       <th width="150" class="cell">MESSAGES</th>
      <th width="150" class="cell">TIMESTAMP</th>
    </tr>
</thead>
<tbody>
 <?php
 require_once("query.php");
 $WISHID=$_GET['wishid'];

          $q = new Query();
          $sql="SELECT * from userwish where userwish.WISHID=". $WISHID ;
          $val=$q->getallentires($sql);
          foreach ($val as $value) {

            $u1=$value['USERID'];
            $u2=$value['USER_TWO_ID'];
  
          $q3 = new Query();

          $sql3="SELECT MESSAGE , TIME_OF_MESSAGE from message where WISHID=". $WISHID ." and ( FROMUSERID=".$u1 ." and TOUSERID=".$u2. ") or ( FROMUSERID=".$u2 ." and TOUSERID=".$u1. ") order by TIME_OF_MESSAGE" ;
          $val3=$q->getallentires($sql3);
      
          foreach ($val3 as $value3) {
           ?>

<tr class="row">
             <td class="cell"><?php echo ($value3['MESSAGE']); ?> </td>
             <td class="cell"><?php echo ($value3['TIME_OF_MESSAGE']); ?> </td>

</tr>
<tr></tr>
             <?php
           
          }

          }


         ?>

  
</tbody>
</body>
</html>