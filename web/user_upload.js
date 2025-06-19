var data = {};

function file_upload(){
	var fileInput = document.getElementById("file_chooser"); 
	if(fileInput.files.length == 0 ){
		alert("Παρακαλώ επιλέξτε ένα αρχείο");
	}
	else{
		var reader = new FileReader();
		var newinfo = [];
		var json = "";
		reader.onload = function (evt) {
			json = evt.target.result;
		}
		reader.onloadend= function(){
			var result = JSON.parse(json); // Parse the result into an object 
			
			result.log.entries.forEach(function(entry){
				const url_text = entry.request.url;
				let domain = (new URL(url_text));
				var requestheader = createHeader(entry.request.headers);
				var responseheader = createHeader(entry.response.headers);
				var request = {method: entry.request.method, url: domain.hostname, headers: requestheader};
				var response = {status: entry.response.status, statustext: entry.response.statusText, headers: responseheader};
				let newentry = {request: request, response: response, timings: entry.timings.wait, serveripaddress: entry.serverIPAddress, startedDateTime: entry.startedDateTime};

				newinfo.push(newentry);
			});
			var data = new FormData();
			data.append('info', JSON.stringify(newinfo));
			$.ajax({
				type: "post",
				url: "upload.php",
				dataType: "json",
				data: data,
				cache: false,
				contentType: false,
				processData: false,
				success: function(response){
					if(response == "1"){
						alert("Επιτυχής εισαγωγή αρχείου");
						location.reload();
					}
					
				},
				error: function(response){
					console.log(response);
				}
			});
		}
		reader.readAsText(fileInput.files[0], "UTF-8");
	}
}

/*
function readFile(file, cb) { // We pass a callback as parameter
    var content = "";
    var reader = new FileReader();

    reader.onload = function(e) {
        content = reader.result;
        // Content is ready, call the callback
        cb(content);
    }

    reader.readAsText(file);
    // return content; This is not needed anymore
}



function sendData(data) {
    $.ajax({
        type: 'POST',
        data: JSON.stringify(data),
        contentType: 'application/json',
        url: "upload.php",
        success: function (data) {
            console.log('success');
            console.log(JSON.stringify(data));

        },
        error: function () {
            console.log('process error');
        }
    });
}
*/
function createHeader(headers){
	let newHeaders = {
		content_type: null,
		cache_control: null,
		pragma: null,
		expires: null,
		age: null,
		last_modified: null,
		host: null
	};
	for(var header of headers){
	//headers.forEach(function(header){
		if(header.name.toLowerCase() === "content-type"){
			newHeaders.content_type = header.value;
		}
		else if(header.name.toLowerCase() === "cache-control"){
			newHeaders.cache_control = header.value;
		}
		else if(header.name.toLowerCase() === "pragma"){
			newHeaders.pragma = header.value;
		}
		else if(header.name.toLowerCase() === "expires"){
			newHeaders.expires = header.value;
		}
		else if(header.name.toLowerCase() === "age"){
			newHeaders.age = header.value;
		}
		else if(header.name.toLowerCase() === "last-modified"){
			newHeaders.last_modified = header.value;
		}
		else if(header.name.toLowerCase() === "host"){
			newHeaders.host = header.value;
		}
	}
	if(newHeaders.content_type == null && newHeaders.cache_control == null && newHeaders.pragma == null && newHeaders.expires == null && newHeaders.age == null && newHeaders.last_modified == null && newHeaders.host == null){
		return null;
	}
	return newHeaders;
}