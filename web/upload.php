<?php
	session_start();
	if(!isset($_SESSION["usertype"])){
		header("Location:index.php");
	}
	else if($_SESSION["usertype"] != 0){
		header("Location:admin_form.php");
	} 
	include_once("connect.php");
	$ip = file_get_contents('https://api.ipify.org');
	$loc = file_get_contents('http://ip-api.com/json/'.$ip);
	$obj = json_decode($loc);
	$cur_date = date('Y-m-d H:i:s');
	$user_id = $_SESSION["user_id"];
	$query = "INSERT INTO upload_data (user_id, user_lat, user_longt, user_isp, city, upload_date) VALUES(".$user_id.", ".$obj->lat.", ".$obj->lon.", '".$obj->isp."', '".$obj->city."', '".$cur_date."')";
	$mysql_link->query($query);
	$query = "SELECT id FROM upload_data ORDER BY id DESC";
	$result = $mysql_link->query($query);
	$row = $result->fetch_array();
	$upload_id = $row["id"];
	$data = json_decode($_POST["info"]);
	$entries = array();
	$requests = array();
	$responses = array();
	$headers_request = array();
	$headers_response = array();
	$query = "SELECT AUTO_INCREMENT as next_id
				FROM information_schema.TABLES
				WHERE TABLE_SCHEMA = 'http_crowdsourcing'
				AND TABLE_NAME = 'requests'";
	$result = $mysql_link->query($query);
	$row = $result->fetch_array();
	$requests_id = $row["next_id"];

	$query = "SELECT AUTO_INCREMENT as next_id
				FROM information_schema.TABLES
				WHERE TABLE_SCHEMA = 'http_crowdsourcing'
				AND TABLE_NAME = 'responses'";
	$result = $mysql_link->query($query);
	$row = $result->fetch_array();
	$responses_id = $row["next_id"];
	$count = 1;
	$myfile = fopen("test.txt", "w");
	$query = "SELECT serverIpAddress,server_lat, server_longt FROM entries";
	$result = $mysql_link->query($query);
	$addresses = array();

	while($row =$result->fetch_array()){
		$addresses[$row["serverIpAddress"]] =  array("lat"=> $row["server_lat"], "longt" => $row["server_longt"]);
	}
	foreach($data as $entry){
		$request = $entry->request;
		$requests[] = "('".$request->url."', '".$request->method."')";
		if(!empty($request->headers)){
			$headers_request[] = getHeaderQuery($request->headers, $requests_id);
		}
		$response = $entry->response;
		$responses[] = "(".$response->status.", '".$response->statustext."')";
		if(!empty($response->headers)){
			$headers_response[] = getHeaderQuery($response->headers, $responses_id);
		}
		$timing = (!empty($entry->timings)) ? $entry->timings : 0;
		$started = date ('Y-m-d H:i:s', strtotime($entry->startedDateTime));
		$serverip = $entry->serveripaddress;
		$serverIPAddress = (!empty($entry->serveripaddress)) ? "'$serverip'" : "NULL";
		if($serverIPAddress != "NULL"){
			$newServerIp = rtrim($serverIPAddress, "]'");
			$newServerIp = ltrim($newServerIp, "'[");
			fwrite($myfile, $newServerIp."\n");
			if(!isset($addresses[$serverIPAddress])){
				if($newServerIp == "::1"){
					$addresses[$serverIPAddress] =  array("lat"=> $obj->lat, "longt" => $obj->lon);
				}
				else{
					$loc2 = file_get_contents('https://api.ipgeolocation.io/ipgeo?apiKey=2b9323338d5f48eeb84fc03a1f21deba&ip='.$newServerIp.'');
					$obj2 = json_decode($loc2);
					$addresses[$serverIPAddress] =  array("lat"=> $obj2->latitude, "longt" => $obj2->longitude);
				}
			}
			$entries[] = "(".$user_id.", ".$upload_id.",'".$started."', ".$timing.", ".$serverIPAddress.", ".$addresses[$serverIPAddress]["lat"].", ".$addresses[$serverIPAddress]["longt"]." , ".$requests_id.", ".$responses_id.")";
		}
		else{
			$entries[] = "(".$user_id.", ".$upload_id." ,'".$started."', ".$timing.", ".$serverIPAddress.", NULL, NULL, ".$requests_id.", ".$responses_id.")";
		}
		$requests_id++;
		$responses_id++;

	}
	fclose($myfile);
	$responses_query = "INSERT INTO responses (status,statusText) VALUES".implode(", ", $responses);
	if(!$mysql_link->query($responses_query)){
		echo "Υπήρξε πρόβλημα με την εισαγωγή responses ".$mysql_link->error."<br>";
	}

	$response_header_query = "INSERT INTO response_header (response_id ,content_type, cache_control, pragma, expires, age, last_modified, host) VALUES ".implode(", ",$headers_response);
	if(!$mysql_link->query($response_header_query)){
		echo "Υπήρξε πρόβλημα με την εισαγωγή headers responses ".$mysql_link->error."<br>";
	}

	$requests_query = "INSERT INTO requests (url, method) VALUES ".implode(", ", $requests);
	if(!$mysql_link->query($requests_query)){
		echo "Υπήρξε πρόβλημα με την εισαγωγή requests ".$mysql_link->error."<br>";
	}
	$request_header_query = "INSERT INTO request_header (request_id ,content_type, cache_control, pragma, expires, age, last_modified, host) VALUES ".implode(", ",$headers_request);
	if(!$mysql_link->query($request_header_query)){
		echo "Υπήρξε πρόβλημα με την εισαγωγή headers requests ".$mysql_link->error."<br>";
	}
	$entries_query = "INSERT INTO entries (user_id, upload_id,startedDateTime, timings, serverIpAddress, server_lat, server_longt,request_id, response_id) VALUES".implode(", ",$entries);
	if(!$mysql_link->query($entries_query)){
		echo "Υπήρξε πρόβλημα με την εισαγωγή εγγραφών ".$mysql_link->error."<br>";
	}
	echo 1;

	
	

	function getHeaderQuery($header, $next_id){
		$content_type = $header->content_type;
		$content_type = ($content_type != null) ? "'$content_type'" : "NULL";
		$age = ($header->age != null) ? $header->age : 0;
		$cache_control = $header->cache_control;
		$cache_control = ($cache_control != null) ? "'$cache_control'" : "NULL";
		$expires = $header->expires;
		$expires = ($expires != null && $expires != "0") ? date ('Y-m-d H:i:s', strtotime($expires)) : "NULL";
		if($expires != "NULL"){
			$expires = "'$expires'";
		}
		$host = $header->host;
		$host = ($host != null) ? "'$host'" : "NULL";
		$last_modified = $header->last_modified;
		$last_modified = ($last_modified != null) ? date ('Y-m-d H:i:s', strtotime($last_modified)) : "NULL";
		if($last_modified != "NULL"){
			$last_modified = "'$last_modified'";
		}
		$pragma = $header->pragma;
		$pragma = ($pragma != null) ? "'$pragma'" : "NULL";
		return "( ".$next_id.", ".$content_type.", ".$cache_control.", ".$pragma.", ".$expires.", ".$age.", ".$last_modified.", ".$host.")";
	}
?> 