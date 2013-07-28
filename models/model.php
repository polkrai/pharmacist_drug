<?php

class Mymodel_Model {
	
	/**
	 * Holds instance of database connection
	 */
	private $db;
	
		
	public function __construct()
	{
		if ($driver == "mysql") {
			
			$this->db = new MysqlImproved_Driver;
		}
		else if ($driver == "pgsql") {
			
			$this->db = new PgsqlImproved_Driver;
		}
		
		
		//connect to database
		//$this->db->connect();
	}
}