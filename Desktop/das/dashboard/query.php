<?php

	class Query
	{
		public function createtable($var)
		{
			$conn=new mysqli('localhost','root','','my_db');
			$conn->query($var);
		}
		public function insert($var)
		{
			$conn=new mysqli('localhost','root','','my_db');
			$conn->query($var);
		}
		public function getallentires($var)
		{
			$conn=new mysqli('localhost','root','','baatna_server_new');
			$result=$conn->query($var);
			return $result;
		}
		public function getneeds($var)
		{
			$conn=new mysqli('localhost','root','','baatna_server_new');
			$result=$conn->query($var);
			return $result;
		}
		public function echoaja($var)
		{
			$conn=new mysqli('localhost','root','','baatna_server_new');
			$conn->query($var);
			return true;
		}
	}
?>