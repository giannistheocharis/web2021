<?php
	header("Content-Type: application/json; charset=UTF-8");
	include_once("connect.php");
	session_start();
    if(!isset($_SESSION["usertype"])){
        header("Location:index.php");
    }
    else if($_SESSION["usertype"] != 0){
        header("Location:admin_form.php");
    } 
    $sql = "SELECT COUNT(*) AS eggrafes  FROM entries WHERE user_id = '".$_SESSION["user_id"]."'";
	$result = $mysql_link->query($sql);
    $row = $result->fetch_assoc();
    $count = $row["eggrafes"];

    $sql = "SELECT upload_date, username, password, email, firstname, lastname FROM users INNER JOIN upload_data ON users.id = upload_data.user_id WHERE user_id = '".$_SESSION["user_id"]."'  ORDER BY upload_date DESC LIMIT 1";
    $result = $mysql_link->query($sql);
    $row = $result->fetch_assoc();
    $data = array("username" => $row["username"], "password" => $row["password"], "email" => $row["email"], "first" => $row["firstname"], "last" => $row["lastname"], "count" => $count, "upload_date" => $row["upload_date"]);
	echo json_encode($data);
?>