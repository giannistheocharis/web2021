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
        $sql = "SELECT AVG(timings) AS average_time, HOUR(startedDateTime) AS hour
                FROM entries 
                INNER JOIN requests ON entries.request_id = requests.id 
                INNER JOIN responses ON entries.response_id = responses.id 
                INNER JOIN request_header ON requests.id = request_header.request_id 
                INNER JOIN response_header ON responses.id = response_header.response_id
                WHERE ".$_POST["search"]."
                GROUP BY HOUR(startedDateTime)";
	}
	else{
		$sql = "SELECT AVG(timings) AS average_time, HOUR(startedDateTime) AS hour
                FROM entries 
                INNER JOIN requests ON entries.request_id = requests.id 
                INNER JOIN responses ON entries.response_id = responses.id 
                INNER JOIN request_header ON requests.id = request_header.request_id 
                INNER JOIN response_header ON responses.id = response_header.response_id
                GROUP BY HOUR(startedDateTime)";
    }
	$result = $mysql_link->query($sql);
	$timings = array();
	while($row = $result->fetch_assoc()){
        $timings[] = array("average" => $row["average_time"], "hour" => $row["hour"]);
	}
	
	echo json_encode($timings);
?>