$(document).ready(function(){
    const request = $.ajax({
		type: "GET",
		url: "user_http_locations.php",
	});
    request.done(onSuccessLocations);
    
    const request2 = $.ajax({
		type: "GET",
		url: "user_data.php",
	});
	request2.done(onSuccessUserData);


});

	function enable(){
		$('#change_btn').prop('disabled', false);
	}



function onSuccessLocations(responseText){
	$('#map_container').html('');
	$('<div id = "map" style="width:850px; height: 600px;"></div>').appendTo($("#map_container"));
	var map = L.map('map');
	L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);
	map.setView([38.2462420, 21.7350847], 1);
	var drawnItems = new L.FeatureGroup();
	map.addLayer(drawnItems); 
	var testData = {
		max: 100,
		data: responseText
	};
	var cfg = {
		"radius": 40,
		"max_opacity": 0.8,
		"scaleRadius": false,
		"useLocalExtrema": false,
		latField: 'la',
		lngField: 'lo',
		valueField: 'count'
	};
	var heatmapLayer = new HeatmapOverlay(cfg);
	map.addLayer(heatmapLayer);
	heatmapLayer.setData(testData);
}

function onSuccessUserData(response){
	$('#date_label').html('Ημερομηνία τελευταίου upload: '+response.upload_date);
	$('#plithos_label').html('Πλήθος εγγραφών: '+response.count);
	$('#username').val(response.username);
	$('#pass').val(response.password);
	$('#email').val(response.email);
	$('#first').val(response.first);
	$('#last').val(response.last);
}

function logout(){
	var r = confirm("Θέλετε να αποσυνδεθείτε; ");
	if(r == true){
		$.ajax({
			url: "logout.php",
			type: "post",
			success: function(response){
				location.reload();
			}
		});
	}
}