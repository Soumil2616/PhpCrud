<?php
class connect {
	
	public function conn()
	{
		$connection = new mysqli("localhost","root","","student_DB");
		return $connection;
	}
}
?>