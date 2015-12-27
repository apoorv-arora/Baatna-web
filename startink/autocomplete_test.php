<!doctype html>
<html><head>

<meta charset="utf-8">
<title>Auto-Complete</title>
</head>

<body>

<input type="text" autocomplete="off" onKeyUp="ajaxcall(this.value)">
<div id="input">
</div>
</body>


<script type="text/javascript">

function ajaxcall(str)
{
var xmlhttp;
if (str.length==0)
  {
  document.getElementById("input").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("input").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","autocomplete_call.php?search="+str,true);
xmlhttp.send();
}

</script>
</html>