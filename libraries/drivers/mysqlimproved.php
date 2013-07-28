<?php
/**
 * The MySQL Improved driver extends the Database_Library to provide 
 * interaction with a MySQL database
 */
class MysqlImproved_Driver extends Database_Library
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
		$host = 'localhost';
		$user = 'root';
		$password = '1234';
		$database = 'test';
	
		//your implementation may require these...
		$port = NULL;
		$socket = NULL;	
		
		//create new mysqli connection
		$this->connection = new mysqli
		(
			$host , $user , $password , $database , $port , $socket
		);

		$this->connection->set_charset("utf8");

		//$this->query("SET NAMES UTF8");
		//$this->query("SET character_set_results=utf8");
		//$this->query("SET character_set_client=utf8");
		//$this->query("SET character_set_connection=utf8");
		
		return TRUE;
	}

	/**
	 * Break connection to database
	 */
	public function disconnect()
	{
		//clean up connection!
		$this->connection->close();	
		
		return TRUE;
	}
	
	public function select($field) {
		
		if ($field) {
			
			$this->select.= $field;
		}
				
		return TRUE;
	}
	
	public function insert($table, $values, $rows = null)
    {
        if($this->tableExists($table)) {
        
            $insert = 'INSERT INTO '. $table;
			
            if($rows != NULL) {
            
                $insert .= ' ('.$rows.')'; 
            }

            for($i = 0; $i < count($values); $i++) {
            
                if(is_string($values[$i])) {					
				
                    $values[$i] = '"'.$values[$i].'"';
				}
            }
			
            $values = implode(',',$values);
            $insert.= ' VALUES ('.$values.')';
			
            $result = $this->query($insert);   
			       
            if($result) {
            
                return TRUE; 
            }
            else {
            
                return FALSE; 
            }
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
		return $this->connection->real_escape_string($data);
	}
	
	/**
	 * Execute a prepared query
	 */
	public function query($sql=NULL)
	{
		if (isset($sql))
		{

			$this->result = $this->connection->query($sql);
		
			return TRUE;
		}
		else if (isset($this->query))
		{
			//execute prepared query and store in result variable
			$this->result = $this->connection->query($this->query);
		
			return TRUE;
		}
		
		return FALSE;		
	}
	
	public function num_rows() {
		
		return $this->result->num_rows();
	}
	
	/**
	 * Fetch a row from the query result
	 * 
	 * @param $type
	 */
	public function fetch($type = 'object')
	{
		if (isset($this->result))
		{
			switch ($type)
			{
				case 'array':
				
					//fetch a row as array
					$row = $this->result->fetch_array();
				
				break;
				
				case 'object':
				
				//fall through...
				
				default:
					
					//fetch a row as object
					$row = $this->result->fetch_object();	
						
				break;
			}
			
			return $row;
		}
		
		return FALSE;
	}
	
	public function result_array() {		
		
		return $this->result->fetch_all($this->result);
		
	}
}