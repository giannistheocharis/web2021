<?php
	session_start();
	include_once("connect.php");
	$pass = $_POST["password"];
	$query = "select * from users where username = '".$_POST["username"]."' and password = '".$pass."'";
	$result = $mysql_link->query($query);
	if($result->num_rows == 0){
		echo 2;
	}
	else{
		$row = $result->fetch_assoc();
		$_SESSION["user_id"] = $row["id"];
		$_SESSION["email"] = $row["email"];
		$_SESSION["usertype"] = $row["isadmin"];
		echo $_SESSION["usertype"];
	}
	$mysql_link->close();
?>