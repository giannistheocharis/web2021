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
    $sql  = "SELECT COUNT(*) AS arithmos_eggrafwn, status FROM responses GROUP BY status";
    $result = $mysql_link->query($sql);
    $status = array();
    while($row = $result->fetch_assoc()){
        $status[] = array("arithmos_eggrafwn" => $row["arithmos_eggrafwn"], "status" => $row["status"]); 
    }
	echo json_encode($status);
?>