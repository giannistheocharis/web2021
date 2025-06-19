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
    $sql = "SELECT DISTINCT server_lat, server_longt, COUNT(*) AS count FROM entries where user_id = '".$_SESSION["user_id"]."' group by server_lat, server_longt";
	$result = $mysql_link->query($sql);
	$locations = array();
	while($row = $result->fetch_assoc()){
		array_push($locations, array("lo" => $row["server_longt"], "la" => $row["server_lat"], "count" => $row["count"]));
	}
	echo json_encode($locations);
?>