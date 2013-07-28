<script>
	
var myCalendar;

	myCalendar = new dhtmlXCalendarObject(["date_select_start","date_select_end"]);
	myCalendar.hideTime();
	myCalendar.setWeekStartDay(7);

</script>
<br />
<div style="position:relative;height:50px;">

	จากวันที่  : <input type="text" id="date_select_start" name="date_select_start" style="height:15px"> 
	ถึงวันที่  : <input type="text" id="date_select_end" name="date_select_end" style="height:15px" >
	
	<input type="button" name="export_excel" value="Export Excel" style="width:150px; height:33px; font-weight:bold;" onclick="dhxGridReport.toExcel('<?php echo SITE_ROOT?>dhtmlx/grid_excel/generate.php');">

</div>

<div id="gridReport" style="width:100%; height:100%"></div>

<script>

	var dhxGridReportUrl = '<?php echo SITE_ROOT?>index.php?orders&m=order_report&t=' + new Date().getTime();
	
	var	dhxGridReport = new dhtmlXGridObject('gridReport');
		dhxGridReport.setImagePath('<?php echo SITE_ROOT?>dhtmlx/imgs/');
		dhxGridReport.setHeader("Order ID, VN, ชื่อ - นามสกุล, Order Date");
		dhxGridReport.setInitWidths("100,150,200,200");
		dhxGridReport.setColAlign("left,left,left,left");
		dhxGridReport.setColTypes("ro,ro,ro,ro");

		dhxGridReport.init();
		dhxGridReport.loadXML(dhxGridReportUrl);
		
</script>