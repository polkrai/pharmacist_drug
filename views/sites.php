<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>ระบบเก็บข้อมูลการปฎิบัตงานของเภสัชกร</title>

	<link type="text/css" href="<?php echo SITE_ROOT?>dhtmlx/dhtmlx.css" rel="stylesheet">
	<link type="text/css" href="<?php echo SITE_ROOT?>dhtmlx/dhtmlxgrid_pgn_bricks.css" rel="stylesheet">
	<link type="text/css" href="<?php echo SITE_ROOT?>dhtmlx/menu_skins/dhtmlxmenu_dhx_web.css" rel="stylesheet">

	<link type="text/css" href="<?php echo SITE_ROOT?>dhtmlx/status_toolbar_layout.css" rel="stylesheet">

	<script src="<?php echo SITE_ROOT?>dhtmlx/dhtmlx.js" type="text/javascript"></script>
	<script src="<?php echo SITE_ROOT?>dhtmlx/dhtmlxgrid_splt.js" type="text/javascript"></script>
	<script src="<?php echo SITE_ROOT?>dhtmlx/dhtmlxgrid_pgn.js" type="text/javascript"></script>
	<script src="<?php echo SITE_ROOT?>dhtmlx/dhtmlxgridcell.js" type="text/javascript"></script>
	<script src="<?php echo SITE_ROOT?>dhtmlx/dhtmlxgrid_export.js" type="text/javascript"></script>
	<script src="<?php echo SITE_ROOT?>dhtmlx/jquery-1.10.2.min.js" type="text/javascript"></script>

	<style>
		html, body {
			width: 100%;
			height: 100%;
			margin: 0px;
			padding: 0px;
			overflow: hidden;
		}

		#header_title {
		    color: #2F2C2C;
		    font-family: Arial,Helvetica,Sans-serif;
		    font-size: 25px;
		    font-weight: bold;
		    line-height: 36px;
		    text-shadow: 0 1px 0 #FFFFFF;
		}

		input[type="text"] {
			 -moz-box-sizing: border-box;
		    background-color: #FFFFFF;
		    background-position: right center;
		    background-repeat: no-repeat;
		    border: 1px solid #CCCCCC;
		    border-radius: 3px 3px 3px 3px;
		    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.075) inset;
		    /*font-size: 18px;*/
			font-size: 1.1em;
		    color: #333333;
		    min-height: 3px;
		    outline: medium none;
		    padding: 7px 8px;
		    transition: all 0.15s ease-in 0s;
		    vertical-align: middle;
		}

		table.dhtmlxLayoutPolyContainer_dhx_terrace div.dhxcont_sb_container_layoutcell div.dhxcont_statusbar {

			top: -2px;
		}
	</style>

</head>

<body style="background-color: #EBEBEB;">

<div id="div_header" style="height: 32px;">
	<span id="header_title">ระบบเก็บข้อมูลการปฎิบัตงานของเภสัชกร</span>
	<span id="header_menu"></span>
</div>

<div id="objVn" style="width:100%;height:100%;padding-top: 15px;background:none repeat scroll 0 0 #F6F6F6;">
	&nbsp;&nbsp;<b>VN :</b> <input type="text" id="vn_search" name="vn_search" onkeypress="return isNumberKey(event)" />	
</div>

<div id="div_footer" style="height: 10px;"></div>

<script>
	var dhxLayout = new dhtmlXLayoutObject(document.body, "2E"); //1C
		dhxLayout.cells("a").setText("ระบบเก็บข้อมูลการปฎิบัตงานของเภสัชกร");
		dhxLayout.cells('a').hideHeader();
		dhxLayout.cells('a').setHeight(65);
		dhxLayout.cells('a').attachObject('objVn');
		dhxLayout.cells('a').fixSize(true, true);		
		dhxLayout.cells('b').setText("การปฎิบัตงานของเภสัชกร");
		dhxLayout.attachHeader("div_header");
		dhxLayout.attachFooter("div_footer");
		
		//dhxLayout.cells("b").attachURL("http://192.168.10.191/pharmacist_drug/index.php?sites");

		//dhxLayout.cells("b").attachObject("paging_container");

	var statusBar = dhxLayout.cells('b').attachStatusBar();
		//statusBar.setText("Simple Status Bar");
		statusBar.setText('<div id="pagingArea">&nbsp;<span id="infoArea"></span></div>');

	var	dhxMenu = new dhtmlXMenuObject("header_menu");
		dhxMenu.setIconsPath('<?php echo SITE_ROOT?>dhtmlx/imgs/');
		//dhxMenu.setSkin("dhx_web");
		dhxMenu.setAlign('right');
		
		dhxMenu.addNewSibling(null, "opts", "<b>ผู้ใช้งานระบบ :</b> <?php echo $_SESSION['full_name']?>", false, 'male.png');
		
	var menuLogout = dhxMenu.addNewChild("opts", 0, "logout", "ออกจากระบบ", false, 'turn_off.png'); //, "about.gif"
	var menuReport = dhxMenu.addNewChild("opts", 0, "report", "ออกรายงาน", false, 'report.png');
		
		dhxMenu.attachEvent("onClick", function (id) {
			
			if(id == "logout") {
				
				window.location="index.php?sites&m=logout&id_sess=<?php echo $_GET['id_sess']?>";
			}
			else if (id == "report") {
				
				var dhxWins = new dhtmlXWindows();
					dhxWins.setImagePath('<?php echo SITE_ROOT?>dhtmlx/imgs/');
				
				//var reportWin = dhxWins.createWindow(reportWin, 150, 20, "80%", "95%");
				var reportWin = dhxWins.createWindow("reportWin", 0, 0, $(window).width(), $(window).height());
					reportWin.setText("ออกรายงาน");
					reportWin.maximize();
					reportWin.button('park').hide();
					reportWin.button('minmax1').hide();
					reportWin.button('minmax2').hide();
					reportWin.setModal(true);
					
					reportWin.attachURL('<?php echo SITE_ROOT?>index.php?sites&m=report', true);
				
				return;
			}
		});
		//dhxMenu.addNewSibling("opts", "logout", "ออกจากระบบ");
		//dhxMenu.loadXML('<?php echo SITE_ROOT?>index.php?sites&m=get_menu&t=' + new Date().getTime());

	var dhxGridUrl = '<?php echo SITE_ROOT?>index.php?orders&m=order_history&t=' + new Date().getTime();

	var	dhxGrid = dhxLayout.cells("b").attachGrid();
		dhxGrid.setImagePath('<?php echo SITE_ROOT?>dhtmlx/imgs/');
		dhxGrid.setHeader("Order ID, VN, ชื่อ - นามสกุล, Order Date");
		dhxGrid.setInitWidths("100,150,200,*");
		dhxGrid.setColAlign("left,left,left,left");
		//dhxGrid.enableAutoHeight(true, 100, true);
		dhxGrid.setColTypes("ro,ro,ro,ro");
		dhxGrid.enablePaging(true, 20, 10, "pagingArea", true, "infoArea");
		dhxGrid.setPagingSkin("toolbar", "dhx_terrace");
		
		//dhxGrid.setPagingTemplates("Pages - [current:0] [current:+1] [current:+2] , from [total] rows","Pages <b>[from]-[to]</b> of <b>[total]</b>");
		//dhxGrid.getCombo(5).put(2, 2);
		//dhxGrid.setColumnMinWidth(50, 0);

		dhxGrid.init();
		//dhxGrid.splitAt(true);
		dhxGrid.load(dhxGridUrl, 'json');
		//dhxGrid.loadXML(dhxGridUrl);

	/*
	var dhxTabbar =	dhxLayout.cells("a").attachTabbar();
		dhxTabbar.setImagePath('<?php echo SITE_ROOT?>dhtmlx/imgs/');
		dhxTabbar.addTab("a1", "Tab 1", "100px");
		dhxTabbar.addTab("a2", "Tab 2", "100px");

		dhxTabbar.setTabActive('a1');
	*/
	
	$('#vn_search').focus();
	
	$('#vn_search').keydown(function (e){
		
	    if(e.keyCode == 13 && $('#vn_search').val() != "") {
			
	       $.ajax({
		   	
				type: "POST",
				url: '<?php echo SITE_ROOT?>index.php?orders&m=get_order_drug',
				data: "vn_search=" + $('#vn_search').val(),
				success: function(msg){
					
					if (msg == "TRUE") {
						
						$('#vn_search').val('').focus();
						
						dhxGrid.clearAll();
						dhxGrid.load(dhxGridUrl, 'json');

					}
					else {
						
						alert(msg);
						$('#vn_search').val('').focus();
						
					}
				}
				//dataType: dataType
			})
	    }
	});
	
	function isNumberKey(evt){
		
	    var charCode = (evt.which) ? evt.which : event.keyCode
		
	    if (charCode > 31 && (charCode < 48 || charCode > 57))
	        return false;
			
	    return true;
	}
	
</script>

</body>
</html>