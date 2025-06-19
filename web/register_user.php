<!DOCTYPE html>
<html>
	<head>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link href = "styles.css" rel="stylesheet"></link>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src = "register.js"></script>
	</head>
	<body>
		<div class="sidenav">
			<div class="login-main-text">
				<h2>Εγγραφή Χρήστη</h2>
			</div>
		</div>
		<div class="main">
			<div class="col-md-6 col-sm-12">
				<div class="login-form">
					<form>
						<div class="form-group">
							<label>Όνομα Χρήστη</label>
							<input type="text" id = "username" class="form-control" placeholder="Όνομα Χρήστη">
						</div>
						<div class="form-group">
							<label>Κωδικός Πρόσβασης</label>
							<input type="password" id = "pass" class="form-control" placeholder="Κωδικός Πρόσβασης">
						</div>
						<div class="form-group">
							<label>email</label>
							<input type="email" id = "email" class="form-control" placeholder="email">
						</div>
                        <div class="form-group">
							<label>Όνομα</label>
							<input type="text" id = "first" class="form-control" placeholder="Όνομα">
						</div>
                        <div class="form-group">
							<label>Επώνυμο</label>
							<input type="text" id = "last" class="form-control" placeholder="Επώνυμο">
						</div>
						<button type="button" class="btn btn-black" onclick = "registerUser()">Εγγραφή</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>