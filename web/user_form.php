<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"></link>
	<link rel = "stylesheet" href ="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" />
	<script src = "https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
	<script src = "https://cdn.jsdelivr.net/npm/heatmapjs@2.0.2/heatmap.js"></script>
	<!-- <script src = "https://raw.githubusercontent.com/pa7/heatmap.js/develop/plugins/leaflet-heatmap/leaflet-heatmap.js"></script> -->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!-- <script src = "user_tab_press.js"></script> -->
	<script src = "heatmap.js"></script>
	<script src = "user_form.js"></script>
	<script src = "user_upload.js"></script>
	<script src = "user_profile.js"></script>
</head>
<body>
	<?php 
		session_start();
		if(!isset($_SESSION["usertype"])){
			header("Location:index.php");
		}
		else if($_SESSION["usertype"] != 0){
			header("Location:admin_form.php");
		} 
	?>
	<div class="sidenav">
		<div class="login-main-text">
			<h2>Σύστημα πληθοποριστικής συλλογής και ανάλυσης δεδομένων κίνησης HTTP</h2>
		</div>
	</div>
	<div class = "main" >
		<div class="container">
			<div class= "row"> 
				<ul id ="admin_tabs" class="nav nav-pills ">
					<li class="active"><a data-toggle="pill" href="#home" >Αρχική</a></li>
					<li><a data-toggle="pill" href="#m1">Διαχείριση Προφίλ</a></li>
					<li><a data-toggle="pill" href="#m2">Upload δεδομένων</a></li>
				</ul>
				<button class="btn btn-primary" type="button" onclick = 'logout()'>Αποσύνδεση</button>
			</div> 
		</div>

		<div class="tab-content">
			<div id="home" class="tab-pane fade in active">
				<?php include_once("user_visualization.php")?>
			</div>
			<div id="m1" class="tab-pane fade">
				<?php include_once("user_profile.php")?>
			</div>
			<div id="m2" class="tab-pane fade" style = "padding: 80px">
				<?php include_once("user_upload.php")?>
			</div>
		</div>
	</div>
</body>
</html>