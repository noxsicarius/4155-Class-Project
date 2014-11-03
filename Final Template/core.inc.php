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

	function searchDB($searchText){
		$query = "SELECT * FROM uploadinfo WHERE NotesTitle LIKE '%$searchText%'";
		$searchResults=mysql_query($query);
		
		return $searchResults;
	}
		
	function getbackpage(){
		return $http_referer;
	}

	function getuserid(){
		$id=$_SESSION['user_id'];
		return $id;
	}
	
	function createSpoiler($title, $content, $rateUp, $rateDown){
		echo "<div style=\"padding:3px;background-color:#FFFFFF;border:1px solid #d8d8d8;\">
				<input 
					type=\"button\" class=\"button2\" style=\"min-width:20px;\" 
					value=\"+\" onclick=\"var container=this.parentNode.getElementsByTagName('div')[0];
					if(container.style.display!='')  {
						container.style.display='';this.value='-';
					} else {
						container.style.display='none';this.value='+';}\" 
				/>
				
				<span 
					style=\"text-transform:uppercase;font-weight:bold;font-size:0.9em;\" >{$title}
						<p align=right style=\"margin-top: -25px;\">
						<input type=\"button\" class=\"button3\" style=\"min-width:10px;font-size:0.7em;\" value=\"&#x25B2\" onclick=\"\"  />{$rateUp}
						<input type=\"button\" class=\"button3\" style=\"min-width:10px;font-size:0.7em;\" value=\"&#x25BC\" onclick=\"\" />{$rateDown} 
						</p>
				</span>
				
				<div style=\"display:none;word-wrap:break-word;overflow:hidden;\">{$content}</div>
			</div>";
	}
?>
