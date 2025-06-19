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
    $sql  = "SELECT DISTINCT content_type FROM response_header";
    $result = $mysql_link->query($sql);
    $types = array();
    while($row = $result->fetch_assoc()){
        $types[] = $row["content_type"]; 
    }

    $sql = "SELECT DISTINCT method from requests";
    $result = $mysql_link->query($sql);
    $methods = array();
    while($row = $result->fetch_assoc()){
        $methods[] = $row["method"]; 
    }

    $sql = "SELECT DISTINCT user_isp FROM upload_data";
    $result = $mysql_link->query($sql);
    $isp = array();
    while($row = $result->fetch_assoc()){
        $isp[] = $row["user_isp"]; 
    }


	echo json_encode(array("types" => $types, "methods" => $methods, "isp" => $isp));
?>