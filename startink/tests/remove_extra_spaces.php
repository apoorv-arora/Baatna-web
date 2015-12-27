<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$s="Hello   you    are you";
echo urlencode($s);

preg_replace('/ +/', ' ', $s);
echo urlencode($s);

?>

</body>
</body>
</html>