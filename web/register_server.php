<?php
	include_once("connect.php");
	$query = "select * from users where username = '".$_POST["username"]."' or password = '".$_POST["password"]."' or email = '".$_POST["email"]."' ";
	$result = $mysql_link->query($query);
	if($result->num_rows != 0){
		echo 0;
	}
	else{
		$query = "insert into users(username, password, email, firstname, lastname) values('".$_POST["username"]."', '".$_POST["password"]."', '".$_POST["email"]."', '".$_POST["first"]."', '".$_POST["last"]."')";
		$mysql_link->query($query);
		echo 1;
	}
	$mysql_link->close();
?>