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
    $sql  = "SELECT COUNT(*) AS arithmos_xristwn FROM users";
    $result = $mysql_link->query($sql);
    $row = $result->fetch_assoc();
    $arithmos_xristwn = intval($row["arithmos_xristwn"]);

    $sql = "SELECT COUNT(DISTINCT(url)) AS monadika_domains FROM requests";
    $result = $mysql_link->query($sql);
    $row = $result->fetch_assoc();
    $arithmos_domains = intval($row["monadika_domains"]);

    $sql = "SELECT COUNT(DISTINCT(user_isp)) AS arithmos_paroxwn FROM upload_data";
    $result = $mysql_link->query($sql);
    $row = $result->fetch_assoc();
    $monadikoi_paroxoi = intval($row["arithmos_paroxwn"]);
	echo json_encode(array("arithmos_xrhstwn" => $arithmos_xristwn, "monadika_domains" => $arithmos_domains, "arithmos_paroxwn" => $monadikoi_paroxoi));
?>