function search_button(){
	var daySearch = document.getElementById("day").value;
    var types = document.getElementById("content_type").selectedOptions;
    var methods = document.getElementById("method").selectedOptions;
    var isp = document.getElementById("isp").selectedOptions;
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
    for(var i = 0; i < methods.length; i++){
		if(i == 0){
            if(search_terms == ""){	
                search_terms += "(method = '"+methods[i].value+"'";
            }
            else if(tempDay != ""){
                search_terms += " AND (method = '"+methods[i].value+"'";
            }
		}
		else{
			search_terms += "method = '"+methods[i].value+"'";
		}
		if(i != methods.length - 1){
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
	var tempDay = searchDay(daySearch);
	if(tempDay != null){
		if(search_terms == ""){	
			search_terms += tempDay;
		}
		else if(tempDay != ""){
			search_terms = search_terms+" AND "+tempDay;
		}
	}
	else{
		return;
	}
    searchForEntries(search_terms);
}

function searchDay(searchText){
	var search_terms = "";
	if(searchText != ""){
		var days = searchText.split("-");
		if(days.length != 2){
			alert("Η αναζήτηση πρέπει να είναι της μορφής: Ημέρα-Ημέρα");
			return null;
		}
		var dayFrom = getDayNumeric(days[0]);
		if(dayFrom == null){
			return null;
		}
		var dayTo = getDayNumeric(days[1]);
		if(dayTo == null){
			return null;
		}
		if(dayFrom > dayTo){
			var temp = dayFrom;
			dayFrom = dayTo;
			dayTo = temp;
		}
		search_terms += "dayofweek(startedDateTime) >= "+dayFrom+" and dayofweek(startedDateTime) <= "+dayTo+"";
	}
	return search_terms;
}

function getDayNumeric(day){
	var availableDays = availableDaysMap();
	if(availableDays.has(day.toLowerCase())){
		dayFrom = availableDays.get(day.toLowerCase());
		return dayFrom;
	}
	else{
		alert("Η ημέρα που δώσατε δεν αναγνωρίστηκε να είναι τονισμένη");
		return null;
	}
}

function availableDaysMap(){
	var map = new Map();
	map.set('δευτέρα', 2);
	map.set('τρίτη', 3);
	map.set('τετάρτη', 4);
	map.set('πέμπτη', 5);
	map.set('παρασκευή', 6);
	map.set('σάββατο', 7);
	map.set('κυριακή', 1);
	return map;
}

function searchForEntries(search_terms){
	const request = $.ajax({
		type: "POST",
		url: "admin_entries_search.php",
		data: {search: search_terms}
	});
	
	request.done(onSuccessSearch1);
}

function onSuccessSearch1(responseText){
    $('#chart_container_search').html('');
    $('#chart_container_search').append('<canvas id="chart_search"></canvas>');
    var labels = [];
	var chart_data = [];
    var colors = [];
    for(i = 0; i < responseText.length; i++){
        labels.push(responseText[i].hour);
        chart_data.push(responseText[i].average);
        colors.push('rgba('+parseInt((Math.random() * 255) +1)+', '+parseInt((Math.random() * 255) +1)+', '+parseInt((Math.random() * 255) +1)+', 0.4)');
    }
	var ctx = document.getElementById('chart_search').getContext('2d');
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
    $('#data_div').show();
}