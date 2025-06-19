<div class = "container">
	<div class = "row" style = "margin-top: 60px; margin-bottom: 60px">
		<label id="date_label">Ημερομηνία τελευταίου upload: </label>

	</div>
    <hr>
	<div class = "row" style = "margin-top: 60px; margin-bottom: 60px">
        <label id="plithos_label">Πλήθος εγγραφών: </label>
	</div>
    <hr>
    <form class="form-horizontal" style = "margin-bottom: 60px">
			<div class = "form-group">
				<label class = "control-label col-lg-2">Όνομα χρήστη</label>
				<div class = "col-lg-10">
					<input type="text" onchange="enable()"  class="form-control" id="username" disabled> 
				</div>
			</div>
			<div class = "form-group">
				<label class = "control-label col-lg-2">Κωδικός πρόσβασης</label>
				<div class = "col-lg-10">
					<input type="password" onchange="enable()"  class="form-control change" id="pass">
				</div>
			</div>
            <div class = "form-group">
				<label class = "control-label col-lg-2">email</label>
				<div class = "col-lg-10">
					<input type="text" onchange="enable()"  class="form-control change" id="email">
				</div>
			</div>
            <div class = "form-group">
				<label class = "control-label col-lg-2">Όνομα</label>
				<div class = "col-lg-10">
					<input type="text" onchange="enable()"  class="form-control change" id="first">
				</div>
			</div>
            <div class = "form-group">
				<label class = "control-label col-lg-2">Επώνυμο</label>
				<div class = "col-lg-10">
					<input type="text" onchange="enable()" class="form-control change" id="last">
				</div>
			</div>
			<button type="button" id="change_btn" class="btn btn-primary col-lg-2 offset-lg-2" onclick = "changeCredentials()" disabled = 'true'>Αλλαγή στοιχείων</button>
		</form>
</div>