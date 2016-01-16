<?php

	class Query
	{
		public function createtable($var)
		{
			$conn=new mysqli('localhost','root','baatna','BaatnaServer');
			$conn->query($var);
		}
		public function insert($var)
		{
			$conn=new mysqli('localhost','root','baatna','BaatnaServer');
			$conn->query($var);
		}
		public function getallentires($var)
		{
			$conn=new mysqli('localhost','root','baatna','BaatnaServer');
			$result=$conn->query($var);
			return $result;
		}
		public function getneeds($var)
		{
			$conn=new mysqli('localhost','root','baatna','BaatnaServer');
			$result=$conn->query($var);
			return $result;
		}
		public function echoaja($var)
		{
			$conn=new mysqli('localhost','root','baatna','BaatnaServer');
			$conn->query($var);
			return true;
		}
	}
?>
