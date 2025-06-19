function registerUser(){
	var username = document.getElementById("username").value;
	var password = document.getElementById("pass").value;
	var email = document.getElementById("email").value;
    var first = document.getElementById("first").value;
    var last = document.getElementById("last").value;
	if(username == ""){
		alert("Δώστε ένα όνομα χρήστη");
		return;
	}
	if(password == ""){
		alert("Δώστε έναν κωδικό πρόσβασης");
		return;
	}
	if(email == ""){
		alert("Δώστε ένα email");
		return;
    }
    if(first == ""){
        alert("Δώστε ένα όνομα");
		return;
    }
    if(last == ""){
        alert("Δώστε ένα επώνυμο");
		return;
    }
	if(!passwordValidation(password)){
		return;
	}
	const request = $.ajax({
		url: "register_server.php",
		type: "POST",
		data: {username: username, password: password, email: email, first: first, last: last}
	});
	
	request.done(onSuccess);
}

function passwordValidation(pass){
	var errors = [];
	if (pass.search(/[A-Z]/) < 0) {
		errors.push("Ο κωδικός πρόσβασης πρέπει να περιέχει τουλάχιστον ένα κεφαλαίο γράμμα.");
	}
	if (pass.search(/[0-9]/) < 0) {
		errors.push("Ο κωδικός πρόσβασης πρέπει να περιέχει τουλάχιστον έναν αριθμό.");
	}	
	if(pass.search(/[\\!\\@\\#\\$\\%\\^\\&\\*\\(\\)\\_\\+\\.\\,\\;\\:\\-]/) < 0) {
		errors.push("Ο κωδικός πρόσβασης πρέπει να περιέχει τουλάχιστον έναν ειδικό χαρακτήρα.")
	} 
	if(pass.length < 8){
		errors.push("Ο κωδικός πρόσβασης πρέπει να περιέχει τουλάχιστον 8 χαρακτήρες.");
	}
	if(errors.length > 0){
		alert(errors.join(" "));
		return false;
	}
	return true;
}

function onSuccess(responseText){
	if(responseText == 0){
		alert("Υπάρχει ήδη χρήστης που χρησιμοποιεί κάποιο από τα στοιχεία που δώσατε");
	}
	else{
		alert("Επιτυχής εγγραφή");
		document.getElementById("username").value = "";
		document.getElementById("pass").value = "";
        document.getElementById("email").value = "";
        document.getElementById("first").value = "";
        document.getElementById("last").value = "";
	}
}