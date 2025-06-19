$(document).ready(function(){
    $('#data_div').hide();
    $('#data_div1').hide();
    $('#data_div2').hide();
    const request = $.ajax({
        type: 'POST',
        url: 'admin_basic_server.php'
    });
    request.done(onSuccess1);

    const request2 = $.ajax({
        type: 'POST',
        url: 'admin_entries_per_method.php'
    });
    request2.done(onSuccess2);

    const request3 = $.ajax({
        type: 'POST',
        url: 'admin_entries_per_status.php'
    });
    request3.done(onSuccess3);

    const request4 = $.ajax({
        type: 'POST',
        url: 'admin_avg_age.php'
    });
    request4.done(onSuccess4);

    const request5 = $.ajax({
        type: 'POST',
        url: 'admin_get_select_options.php'
    });
    request5.done(populateSelect);

    const request6 = $.ajax({
        type: 'POST',
        url: 'admin_http_locations.php'
    });
    request6.done(visualizationMap);
    
    document.getElementById("reset_type_btn").onclick = function(){
        var element = document.getElementById("content_type");
        var options = element.options;
        for(var i = 0; i < options.length; i++){
            options[i].selected = false;
        }	
    }

    document.getElementById("reset_method_btn").onclick = function(){
        var element = document.getElementById("method");
        var options = element.options;
        for(var i = 0; i < options.length; i++){
            options[i].selected = false;
        }	
    }

    document.getElementById("reset_isp_btn").onclick = function(){
        var element = document.getElementById("isp");
        var options = element.options;
        for(var i = 0; i < options.length; i++){
            options[i].selected = false;
        }	
    }

    document.getElementById("reset_type_btn2").onclick = function(){
        var element = document.getElementById("content_type2");
        var options = element.options;
        for(var i = 0; i < options.length; i++){
            options[i].selected = false;
        }	
    }

    document.getElementById("reset_isp_btn2").onclick = function(){
        var element = document.getElementById("isp2");
        var options = element.options;
        for(var i = 0; i < options.length; i++){
            options[i].selected = false;
        }	
    }
});

function onSuccess1(responseText){
	var labels = [];
	var chart_data = [];
    var colors = [];
        labels.push("Αριθμός χρηστών");
        chart_data.push(responseText.arithmos_xrhstwn);
        labels.push("Αριθμός μοναδικών domains");
        chart_data.push(responseText.monadika_domains);
        labels.push("Αριθμός μοναδικών παρόχων");
        chart_data.push(responseText.arithmos_paroxwn);
		// colors.push('rgba('+parseInt((Math.random() * 255) +1)+', '+parseInt((Math.random() * 255) +1)+', '+parseInt((Math.random() * 255) +1)+', 0.4)');
	var ctx = document.getElementById('chart1').getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'pie',
		data: {
			labels: labels,
			datasets: [{
				label: 'Αριθμός ',
				data: chart_data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
				borderWidth: 1
			}]
		}
	}); 
}

function onSuccess2(responseText){
    var labels = [];
	var chart_data = [];
    var colors = [];
    for(i = 0; i < responseText.length; i++){
        labels.push(responseText[i].method);
        chart_data.push(responseText[i].arithmos_eggrafwn);
        colors.push('rgba('+parseInt((Math.random() * 255) +1)+', '+parseInt((Math.random() * 255) +1)+', '+parseInt((Math.random() * 255) +1)+', 0.4)');
    }
	var ctx = document.getElementById('chart2').getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'pie',
		data: {
			labels: labels,
			datasets: [{
				label: 'Αριθμός ',
				data: chart_data,
                backgroundColor: colors,
				borderWidth: 1
			}]
		}
	}); 
}

function onSuccess3(responseText){
    var labels = [];
	var chart_data = [];
    var colors = [];
    for(i = 0; i < responseText.length; i++){
        labels.push(responseText[i].status);
        chart_data.push(responseText[i].arithmos_eggrafwn);
        colors.push('rgba('+parseInt((Math.random() * 255) +1)+', '+parseInt((Math.random() * 255) +1)+', '+parseInt((Math.random() * 255) +1)+', 0.4)');
    }
	var ctx = document.getElementById('chart3').getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'pie',
		data: {
			labels: labels,
			datasets: [{
				label: 'Αριθμός ',
				data: chart_data,
                backgroundColor: colors,
				borderWidth: 1
			}]
		}
	}); 
}

function onSuccess4(responseText){
    var labels = [];
	var chart_data = [];
    var colors = [];
    for(i = 0; i < responseText.length; i++){
        labels.push(responseText[i].content_type);
        chart_data.push(responseText[i].mesh_hlikia);
        colors.push('rgba('+parseInt((Math.random() * 255) +1)+', '+parseInt((Math.random() * 255) +1)+', '+parseInt((Math.random() * 255) +1)+', 0.4)');
    }
	var ctx = document.getElementById('chart4').getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: labels,
			datasets: [{
				label: 'Αριθμός ',
				data: chart_data,
                backgroundColor: colors,
				borderWidth: 1
			}]
		}
	}); 
}

function populateSelect(response){
    for(i = 0; i < response.types.length; i++){
        $('#content_type').append(new Option(response.types[i], response.types[i]));
        $('#content_type2').append(new Option(response.types[i], response.types[i]));
    }
    for(i = 0; i < response.methods.length; i++){
        $('#method').append(new Option(response.methods[i], response.methods[i]));
    }
    for(i = 0; i < response.isp.length; i++){
        $('#isp').append(new Option(response.isp[i], response.isp[i]));
        $('#isp2').append(new Option(response.isp[i], response.isp[i]));
    }
}

function visualizationMap(responseData){
    var data = responseData.data;
    var max_plithos = responseData.max;
    console.log(data);
    var map = L.map('map2');
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    map.setView([38.2462420, 21.7350847], 1);
    for(var user in data){
        var user_lat = data[user].lat;
        var user_longt = data[user].longt;
        let userMarker = L.marker ([user_lat, user_longt]);
        userMarker.addTo(map);

        for(i = 0; i < data[user].server_locations.length; i++){
            if(data[user].server_locations[i] != null){
                if(data[user].server_locations[i].lat != null && data[user].server_locations[i].longt != null){
                    var marker = L.marker ([data[user].server_locations[i].lat, data[user].server_locations[i].longt]);
                    marker.addTo(map);
                    var latlngs = Array();
                    latlngs.push(userMarker.getLatLng());
                    latlngs.push(marker.getLatLng());
                    var polylineWheight = data[user].server_locations[i].plithos / max_plithos;
                    var polyline = L.polyline(latlngs, {color: 'red', weight: polylineWheight}).addTo(map);

                }

            }

        }
        console.log(user_lat+", "+user_longt);
    }
    
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
