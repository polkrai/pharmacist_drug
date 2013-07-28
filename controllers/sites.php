<?php

class Sites_Controller {

	public $template = 'sites';
	
	public function __construct() {
		
		$sitesModel = new Sites_Model;
		
		$sitesModel->set_session($_GET['id_sess']);
	}

	public function main(array $getVars) {

		$sitesModel = new Sites_Model;		

		$view = new View_Model($this->template);
		
		$view->assign('sites');
	}
	
	public function report() {

		$sitesModel = new Sites_Model;		

		$view = new View_Model('view_report');
		
		//$view->assign('sites');
	}

	public function get_menu () {

		$view = new View_Model('menu');
		
		//$view->assign('menu');
	}
	
	public function logout () {
		
		$sitesModel = new Sites_Model;

		$sitesModel->get_logout($_GET['id_sess']);
		
		session_destroy();
		
		header( "location: ../../nano" );
 		exit(0);
	}

}