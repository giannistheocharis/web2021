function registerForm(){
	window.location = "register_user.php";
}

function loginUser(){
	var username = document.getElementById("username").value;
	var password = document.getElementById("pass").value;
	if(username == ""){
		alert("Δώστε ένα όνομα χρήστη");
		return;
	}
	if(password == ""){
		alert("Δώστε έναν κωδικό πρόσβασης");
		return;
	}
	
	const request = $.ajax({
		url: "login_user.php",
		type: "POST",
		data: {username: username, password: password}
	});
	
	request.done(onSuccess);
}

function onSuccess(responseText){
	if(responseText == 2){
		alert("Λάθος όνομα χρήστη ή κωδικός πρόσβασης");
	}
	else{
		if(responseText == "0"){
			window.location = "user_form.php";
		}
		else if(responseText == "1"){
			window.location = "admin_form.php";
		}
    }
}
