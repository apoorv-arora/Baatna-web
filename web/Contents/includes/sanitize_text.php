<?php 


class Sanitext

{
	public function san($text)
	{
		$text=trim($text);
		$text=strip_tags($text);
		$text=preg_replace('/ +/', ' ', $text);
		return htmlspecialchars($text,ENT_QUOTES);
	}
	
}

$sanitize= new Sanitext();

?>

