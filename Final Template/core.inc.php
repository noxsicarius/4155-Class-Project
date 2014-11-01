<?php

	ob_start();
	session_start();
	$current_file = $_SERVER['SCRIPT_NAME'];

	if(isset($_SERVER['HTTP_REFERER'])) {
		$http_referer=$_SERVER['HTTP_REFERER'];
	}else{
	   $http_referer='index.php';
	}

	function loggedin() {
		if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
			return true;
		}else{
			return false;
		}
	}

	function getfield($field){
		$query = "SELECT name FROM `users` WHERE Id=". $_SESSION['user_id'];		

		if ($query_run=mysql_query($query)){
			if($query_result=mysql_result($query_run, 0, $field)){
				return $query_result;
			}
		}else{
			return 'Wrong field or query not executed right';
		}
	}

	function getbackpage(){
		return $http_referer ;
	}

	function getuserid(){
		$id=$_SESSION['user_id'];
		return $id;
	}
	
?>