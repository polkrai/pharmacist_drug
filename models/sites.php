<?php
/**
 * The News Model does the back-end heavy lifting for the News Controller
 */
class Sites_Model
{
	/**
	 * Holds instance of database connection
	 */
	private $db;
		
	public function __construct()
	{
		$this->db = new PgsqlImproved_Driver;
		
		$this->db->connect();
	}
	
	public function set_session ($id_sess) {
		
		$sql = "SELECT nano_user.id AS user_id,
		               nano_user.title || nano_user.name || ' ' || nano_user.lastname AS full_name
		
		        FROM jvkk.nano_user AS nano_user
				
				INNER JOIN jvkk.nano_session AS session ON (session.session_user_id = nano_user.id)
				
				WHERE session.id_sess = '{$id_sess}'";		
				
		$this->db->query($sql);
		
		$user = $this->db->fetch('array');

		if ($this->db->num_rows() > 0) {
		
			$_SESSION['user_id']   = $user['user_id'];

			$_SESSION['full_name'] = $user['full_name'];
		}
		else {

			$_SESSION['user_id']   = 222;
		}
	}
	
	public function get_logout ($id_sess) {
		
		$sql = "DELETE FROM jvkk.nano_session WHERE id_sess = '{$id_sess}'";
		
		$this->db->query($sql);
		
		return;
	}
	
}
