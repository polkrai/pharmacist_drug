<?php

require_once 'gridExcelGenerator.php';
require_once 'gridExcelWrapper.php';


$debug = false;

$error_handler = set_error_handler("PDFErrorHandler");

if (get_magic_quotes_gpc()) {
	
	$xmlString = stripslashes($_POST['grid_xml']);
} 
else {
	
	$xmlString = $_POST['grid_xml'];
}

$xmlString = urldecode($xmlString);

if ($debug == true) {
	
	error_log($xmlString, 3, 'debug_'.date("Y_m_d__H_i_s").'.xml');
}

$xml = simplexml_load_string($xmlString);

$excel = new gridExcelGenerator();

$excel->outputType = 'excel2003';

$excel->fontFamily = 'TH SarabunPSK';
$excel->headerHeight = 25;
$excel->rowHeight = 20;

$excel->headerFontSize = 18;
$excel->gridFontSize = 16;

$excel->bgColor 		= '#D1E5FE';
$excel->lineColor 		= '#A4BED4';
$excel->scaleOneColor 	= '#000000';
$excel->scaleTwoColor 	= '#E3EFFF';

$excel->title = 'รายงาน';

$excel->printGrid($xml);



function PDFErrorHandler ($errno, $errstr, $errfile, $errline) {
	
	global $xmlString;
	
	if ($errno < 1024) {
		
		error_log($xmlString, 3, 'error_report_'.date("Y_m_d__H_i_s").'.xml');
//		exit(1);
	}

}

?>