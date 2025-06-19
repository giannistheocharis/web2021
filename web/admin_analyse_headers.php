<div class = "container" style = "margin-top: 60px">
	<form class="form-horizontal" style = "margin-bottom: 60px">
		<div class = "form-group">
			<label class = "control-label col-lg-3">Τύπος περιεχομένου</label>
			<div class = "col-lg-6">
				<select id = "content_type2" multiple class="form-control">
				</select>
			</div>
			<div class = "col-lg-3">
				<button type="button" class="btn btn-black" id = "reset_type_btn2">Όλες</button>
			</div>
		</div>
        <div class = "form-group">
			<label class = "control-label col-lg-3">Πάροχος συνδεσιμότητας</label>
			<div class = "col-lg-6">
				<select id = "isp2" multiple class="form-control">
				</select>
			</div>
			<div class = "col-lg-3">
				<button type="button" class="btn btn-black" id = "reset_isp_btn2">Όλες</button>
			</div>
		</div>
		<button type="button" class="btn btn-black col-lg-2 offset-lg-3" onclick = "searchButton2()">Αναζήτηση</button>
	</form>

	<div class = "row" style = "margin-top: 60px; margin-bottom: 60px" id="data_div1">
		<div class = "col-lg-3">
			<label>Ποσοστό max-stale και min-fresh directives επί του συνόλου των αιτήσεων ανά CONTENT-TYPE: </label>
		</div>
            <div id = "chart_container_1" style="height:40vh; width:80vw" class = "col-lg-9">
                <!-- <canvas id="chart_search"></canvas> -->
            </div>
	    </div>
    </div>    
    <div class = "row" style = "margin-top: 60px; margin-bottom: 60px" id="data_div2">
		<div class = "col-lg-3">
			<label>Ποσοστό cacheability directives επί του συνόλου των αποκρίσεων ανά CONTENT-TYPE: </label>
		</div>
            <div id = "chart_container_2" class = "col-lg-9">
                <!-- <canvas id="chart_search"></canvas> -->
            </div>
    </div>  
</div>