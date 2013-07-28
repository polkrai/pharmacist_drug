<?php
header("Content-type:application/json; charset=UTF-8");  

$json = '';

foreach($data['history'] as $land => $data) {
	
	$json .= '{id:'.$data['id'].', data:["'.$data['order_id'].'",
						  	             "'.$data['vn'].'",
										 "'.$data['pt_name'].'",
						  	             "'.$data['drug_date'].' น."]},';
	
}

$json = substr($json, 0, -1);

echo "{rows:[{$json}]}";