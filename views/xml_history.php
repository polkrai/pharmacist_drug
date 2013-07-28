<?php
header("Content-type:text/xml; charset=UTF-8");  

 $xml = "<?xml version=\"1.0\"?>";
 
 $xml.= "<rows total_count=\"100\" pos=\"{$_GET['posStart']}\" >";
 
 foreach($data['history'] as $land => $data) {
 
 	$xml.= "<row id=\"{$data['id']}\">
				<cell>{$data['order_id']}</cell>
				<cell>{$data['vn']}</cell>
				<cell>{$data['pt_name']}</cell>
				<cell>{$data['drug_date']} น.</cell>
			</row>";
}
						
$xml.= "</rows>";

echo $xml;
