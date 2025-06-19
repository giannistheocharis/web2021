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
    $sql  = "SELECT COUNT(*) AS arithmos_eggrafwn, method FROM requests GROUP BY method";
    $result = $mysql_link->query($sql);
    $methods = array();
    while($row = $result->fetch_assoc()){
        $methods[] = array("arithmos_eggrafwn" => $row["arithmos_eggrafwn"], "method" => $row["method"]); 
    }
	echo json_encode($methods);
?>