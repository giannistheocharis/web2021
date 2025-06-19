<div class = "container" style = "margin-top: 60px" >
	<form class="form-horizontal" style = "margin-bottom: 60px">
		<div class = "form-group">
			<label class = "control-label col-lg-3">Τύπος περιεχομένου</label>
			<div class = "col-lg-6">
				<select id = "content_type" multiple class="form-control">
				</select>
			</div>
			<div class = "col-lg-3">
				<button type="button" class="btn btn-black" id = "reset_type_btn">Όλες</button>
			</div>
		</div>
		<div class = "form-group">
			<label class = "control-label col-lg-3">Ημέρα</label>
			<div class = "col-lg-9">
				<input type="text" class="form-control" id="day" placeholder =" Παράδειγμα: (Δευτέρα-Παρασκευή)">
			</div>
		</div>
        <div class = "form-group">
			<label class = "control-label col-lg-3">HTTP μέθοδος</label>
			<div class = "col-lg-6">
				<select id = "method" multiple class="form-control">
				</select>
			</div>
			<div class = "col-lg-3">
				<button type="button" class="btn btn-black" id = "reset_method_btn">Όλες</button>
			</div>
		</div>
        <div class = "form-group">
			<label class = "control-label col-lg-3">Πάροχος συνδεσιμότητας</label>
			<div class = "col-lg-6">
				<select id = "isp" multiple class="form-control">
				</select>
			</div>
			<div class = "col-lg-3">
				<button type="button" class="btn btn-black" id = "reset_isp_btn">Όλες</button>
			</div>
		</div>
		<button type="button" class="btn btn-black col-lg-2 offset-lg-3" onclick = "search_button()">Αναζήτηση</button>
	</form>
	<div class = "row" style = "margin-top: 60px; margin-bottom: 60px" id="data_div">
		<div class = "col-lg-3">
			<label>Δεδομένα: </label>
		</div>
		<div class = "col-lg-9" id = "map_container">
                <div id = "chart_container_search">
                   <canvas id="chart_search"></canvas> 
                </div>
	    </div>
    </div>    
</div>