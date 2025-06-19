<?php
	header("Content-Type: application/json; charset=UTF-8");
	include_once("connect.php");
	session_start();
    if(!isset($_SESSION["usertype"])){
        header("Location:index.php");
    }
    else if($_SESSION["usertype"] == 0){
        header("Location:user_form.php");
    } 
    $sql  = "SELECT AVG(age) AS avg_age, content_type FROM response_header GROUP BY content_type";
    $result = $mysql_link->query($sql);
    $avg = array();
    while($row = $result->fetch_assoc()){
        $avg[] = array("mesh_hlikia" => floatval($row["avg_age"]), "content_type" => $row["content_type"]); 
    }
	echo json_encode($avg);
?>