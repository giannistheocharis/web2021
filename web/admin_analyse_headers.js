function searchButton2(){
    var types = document.getElementById("content_type2").selectedOptions;
    var isp = document.getElementById("isp2").selectedOptions;
	var search_terms = "";
	for(var i = 0; i < types.length; i++){
		if(i == 0){
			search_terms += "(response_header.content_type = '"+types[i].value+"'";
		}
		else{
			search_terms += "response_header.content_type = '"+types[i].value+"'";
		}
		if(i != types.length - 1){
			search_terms += " OR ";
		}
		else{
			search_terms += ")"
		}
    }
    for(var i = 0; i < isp.length; i++){
		if(i == 0){
            if(search_terms == ""){	
                search_terms += "(user_isp = '"+isp[i].value+"'";
            }
            else if(tempDay != ""){
                search_terms += " AND (user_isp = '"+isp[i].value+"'";
            }
		}
		else{
			search_terms += "user_isp = '"+isp[i].value+"'";
		}
		if(i != isp.length - 1){
			search_terms += " OR ";
		}
		else{
			search_terms += ")"
		}
	}
    searchForHeaders(search_terms);
}

function searchForHeaders(search_terms){
	const request = $.ajax({
		type: "POST",
		url: "admin_headers_search_cachability.php",
		data: {search: search_terms}
	});
	
	request.done(onSuccessSearch);
}

function onSuccessSearch(responseText){
    $('#chart_container_2').html('');
    $('#chart_container_2').append('<canvas id="chart_2"></canvas>');
    var labels = [];
	var chart_data = [];
    var colors = [];
    for(i = 0; i < responseText.length; i++){
        labels.push(responseText[i].type);
        chart_data.push(responseText[i].pososto);
        colors.push('rgba('+parseInt((Math.random() * 255) +1)+', '+parseInt((Math.random() * 255) +1)+', '+parseInt((Math.random() * 255) +1)+', 0.4)');
    }
	var ctx = document.getElementById('chart_2').getContext('2d');
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
    $('#data_div2').show();

}