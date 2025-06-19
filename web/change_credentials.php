<?php
	session_start();
	if(!isset($_SESSION["usertype"])){
		header("Location:index.php");
	}
	else if($_SESSION["usertype"] != 0){
		header("Location:admin_form.php");
	} 
	include_once("connect.php");
	$pass = $_POST["password"];
	$first = $_POST["first"];
	$last = $_POST["last"];
	$query = "UPDATE users SET  password = '".$pass."', firstname = '".$first."', lastname = '".$last."' WHERE id = '".$_SESSION["user_id"]."'";
	$mysql_link->query($query);
	$mysql_link->close();
	echo 1;
?>