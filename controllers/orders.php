<?php

class Orders_Controller {

	public $template = 'orders';

	public function main(array $getVars) {

		$ordersModel = new Orders_Model;
		
		//get an article
		$orders = $ordersModel->get_order($getVars['author']);
		
		//create a new view and pass it our template
		$view = new View_Model($this->template);
		
		//assign article data to view
		$view->assign('orders' , $orders);
	}
	
	public function get_order_drug () {
		
		$vn_search = $_POST['vn_search'];
		
		$ordersModel = new Orders_Model;
		
		if ($ordersModel->check_order($vn_search) == 0 && $ordersModel->check_vn($vn_search) == 1) {
			
			$order = $ordersModel->get_order($vn_search);
			
			$data = array ('order_id'   => $order['order_id'],
						   'user_id'    => $_SESSION['user_id'],
						   'vn'		    => $vn_search,
						   'id_patient' => $order['id_patient']);
			
			$ordersModel->insert_pharmacist_drug($data);
			
			echo "TRUE";
		}
		else {
			
			echo "มีการบันทึกแล้วหรือไม่มี VN นี้ในระบบ";
		}
		
	}
	
	public function order_history () {
		
		$ordersModel = new Orders_Model;
		
		$order_history = $ordersModel->get_order_history();
	
		//print_r ($order_history);
		$view = new View_Model('json_history');
		
		//$view = new View_Model('xml_history');
		
		//$order_history['pos'] = $_POST['posStart'];
		
		//$order_history['total_count'] = 100;
		
		$view->assign('history' , $order_history);
	}
	
	public function order_report () {
		
		$ordersModel = new Orders_Model;
		
		$order_report = $ordersModel->get_order_history();
	
		//print_r ($order_history);
		$view = new View_Model('xml_report');
		
		$view->assign('report' , $order_report);
	}

}