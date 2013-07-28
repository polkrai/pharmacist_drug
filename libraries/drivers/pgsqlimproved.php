<?php
class PgsqlImproved_Driver extends Database_Library
{
/**
	 * Connection holds MySQLi resource
	 */
	private $connection;
	
	/**
	 * Select to perform
	 */
	private $select = NULL;
	
	/**
	 * Query to perform
	 */
	private $query;
	
	/**
	 * Result holds data retrieved from server
	 */
	private $result;
	
	/**
	 * Create new connection to database
	 */ 
	public function connect()
	{
		//connection parameters
		$host 		= '192.168.44.14';
		$user 		= 'miracle';
		$password 	= '1q2w3e4r';
		$database 	= 'jvkk_2';
	
		//your implementation may require these...
		$port 	= NULL;
		$socket = NULL;	
		
		//create new mysqli connection
		$this->connection = pg_connect("host={$host} port=5432 dbname={$database} user={$user} password={$password}") or die("cannot connect");
		
		return TRUE;
	}

	/**
	 * Break connection to database
	 */
	public function disconnect()
	{
		//clean up connection!			
		pg_close($this->connection);
		
		return TRUE;
	}
	
	public function select($field) {
		
		if ($field) {
			
			$this->select.= $field;
		}
				
		return TRUE;
	}
	
	public function insert($table, $values, $rows=NULL)
    {
        
        $insert = 'INSERT INTO '. $table;
		
        if($rows != NULL) {
        
            $insert .= ' ('.$rows.')'; 
        }
		
		foreach ($values as $k => $v) {
			
			//if(is_string($v)) {			
			
				$field[] = $k;		
			
                $values_insert[] = "'" . $v ."'";
			//}
		}

		
        $values_insert = implode(',', $values_insert);
		
        $insert.= ' ('.implode(',', $field).') VALUES ('.$values_insert.')';
		
        $result = $this->query($insert);  
		       
        if($result) {
        
            return TRUE; 
        }
        else {
        
            return FALSE; 
        }
        
    }

	
	public function get($table) {
		
		if ($this->select == NULL) {
			
			$this->query = "SELECT * FROM {$table}";
			
		}
		else {
			
			$this->query = "SELECT {$this->select} FROM {$table}";
		}
		
		return TRUE;
	}
	
	/**
	 * Prepare query to execute
	 * 
	 * @param $query
	 */
	public function prepare($query)
	{
		//store query in query variable
		$this->query = $query;	
		
		return TRUE;
	}
	
	/**
	 * Sanitize data to be used in a query
	 * 
	 * @param $data
	 */
	public function escape($data)
	{
		return pg_escape_string($data);
	}
	
	/**
	 * Execute a prepared query
	 */
	public function query($sql=NULL)
	{
		if (isset($sql)) {

			$this->result = pg_query($sql) or die($sql);
		
			return TRUE;
		}
		else if (isset($this->query)) {

			$this->result = pg_query($this->query) or die($this->query);
		
			return TRUE;
		}
		
		return FALSE;		
	}
	
	public function num_rows() {
		
		return pg_num_rows($this->result);
	}
	
	/**
	 * Fetch a row from the query result
	 * 
	 * @param $type
	 */
	public function fetch($type='object')
	{
		if (isset($this->result))
		{
			switch ($type)
			{
				case 'array':
				
					//fetch a row as array
					$row = pg_fetch_array($this->result);
				
				break;
				
				case 'object':
				
				//fall through...
				
				default:
					
					//fetch a row as object
					$row = pg_fetch_object($this->result);	
						
				break;
			}
			
			return $row;
		}
		
		return FALSE;
	}
	
	public function result_array() {		
		
		return pg_fetch_all($this->result);
		
	}
}