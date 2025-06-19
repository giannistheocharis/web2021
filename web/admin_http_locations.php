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
    $sql = "SELECT user_id, user_lat, user_longt FROM upload_data";
	$result = $mysql_link->query($sql);
	$user_data = array();
	while($row = $result->fetch_assoc()){
        $user_data[$row["user_id"]] = array("lat" => $row["user_lat"], "longt" => $row["user_longt"], "server_locations" => array());
        $sql = "SELECT DISTINCT COUNT(*) AS plithos, server_lat, server_longt 
                FROM entries 
                WHERE user_id = ".$row["user_id"]." 
                GROUP BY  server_lat, server_longt
                ORDER BY plithos DESC
                ";
        $result2 = $mysql_link->query($sql);
        $coun = 0;
        $max = 0;
        while($row2 = $result2->fetch_assoc()){
            if($coun == 0){
                $max  = $row2["plithos"];
            }
            $coun++;
            $user_data[$row["user_id"]]["server_locations"][] = array("lat" => $row2["server_lat"] , "longt" =>$row2["server_longt"], "plithos" => intval($row2["plithos"]));
        }
	}
	echo json_encode(array("max" => $max, "data"=>$user_data));
?>