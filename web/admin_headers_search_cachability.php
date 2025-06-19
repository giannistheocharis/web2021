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
    if($_POST["search"] != ""){
        $sql = "SELECT COUNT(*) AS plithos, content_type FROM response_header WHERE ".$_POST["search"]." GROUP BY content_type";
	}
	else{
		$sql = "SELECT COUNT(*) AS plithos, content_type FROM response_header GROUP BY content_type";
    }
    $result = $mysql_link->query($sql);
	$geniko_plithos = array();
	while($row = $result->fetch_assoc()){
        $geniko_plithos[$row["content_type"]] = $row["plithos"];
    }
    if($_POST["search"] != ""){
        $sql = "SELECT COUNT(*) AS plithos, content_type FROM response_header WHERE ".$_POST["search"]." AND (cache_control LIKE '%public%' OR cache_control LIKE '%private%' OR cache_control LIKE '%no-cache%' OR cache_control LIKE '%no-store%') GROUP BY content_type";
	}
	else{
		$sql = "SELECT COUNT(*) AS plithos, content_type FROM response_header WHERE cache_control LIKE '%public%' OR cache_control LIKE '%private%' OR cache_control LIKE '%no-cache%' OR cache_control LIKE '%no-store%' GROUP BY content_type";
    }
    $result2 = $mysql_link->query($sql);
	$pososto = array();
	while($row2 = $result2->fetch_assoc()){
        $pososto[] = array("pososto" => $row2["plithos"] / $geniko_plithos[$row2["content_type"]] * 100, "type" => $row2["content_type"]);
    }
    echo json_encode($pososto);
?>