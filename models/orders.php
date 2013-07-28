<?php
//include_once("model.php");
/**
 * The News Model does the back-end heavy lifting for the News Controller
 */
class Orders_Model {
	/**
	 * Holds instance of database connection
	 */
	private $db;
		
	public function __construct()
	{
		$this->db = new PgsqlImproved_Driver;
		
		//connect to database
		$this->db->connect();
	}
	
	public function check_order ($vn) {
		
		$sql = "SELECT orders.id AS order_id 
		
		        FROM med.neural_order AS orders
				
				INNER JOIN medrec.nano_visit AS visit ON (visit.id = orders.vn_id)

				INNER JOIN p4p.pharmacist_drug ON (pharmacist_drug.order_id = orders.id)
		
				WHERE orders.order_type = 'drug'	
				
				AND orders.deleted = 'f'
				
				AND visit.vn = '{$vn}'";
				
		//echo $sql;
				
		$this->db->query($sql);
		
		return $this->db->num_rows();
	}
	
	public function check_vn ($vn) {
		
		$sql = "SELECT vn FROM medrec.nano_visit WHERE vn = '{$vn}'";
		
		$this->db->query($sql);
		
		return $this->db->num_rows();
	}
	
	/**
	 * Fetches article based on supplied name
	 * 
	 * @param string $author
	 * 
	 * @return array $article
	 */
	public function get_order($vn)
	{		
		
		//sanitize data
		$vn = $this->db->escape($vn);
		
		//prepare query
		$sql = "SELECT orders.id AS order_id, visit.id_patient
		
		        FROM med.neural_order AS orders
				
				INNER JOIN medrec.nano_visit AS visit ON (visit.id = orders.vn_id)
				
				WHERE orders.order_type = 'drug'	
				
				AND orders.deleted = 'f'
				
				AND visit.vn = '{$vn}'";
		
		$this->db->query($sql);
		
		$order = $this->db->fetch('array');
		
		return $order;
	}
	
	public function insert_pharmacist_drug($data) {
		
		$this->db->insert('p4p.pharmacist_drug', $data);
	}
	
	public function get_order_history () {
		
		$sql = "SELECT pharmacist_drug.id, 
				pharmacist_drug.order_id, 
				to_char(pharmacist_drug.drug_date, 'DD-MM-YYYY HH24:MI') AS drug_date, 
				pharmacist_drug.vn,
				patient.pa_pre_name || patient.pa_name || ' ' || patient.pa_lastname AS pt_name 
		
				FROM p4p.pharmacist_drug AS pharmacist_drug
				
				INNER JOIN medrec.nano_patient AS patient ON (patient.id = pharmacist_drug.id_patient)
				
				WHERE user_id = '{$_SESSION['user_id']}'";
		
		$this->db->query($sql);
		
		$history = $this->db->result_array();
		
		return $history;
	}
	
}
