<?php
/**
 * The News Model does the back-end heavy lifting for the News Controller
 */
class News_Model
{
	/**
	 * Holds instance of database connection
	 */
	private $db;
		
	public function __construct()
	{
		$this->db = new MysqlImproved_Driver;
	}
	
	/**
	 * Fetches article based on supplied name
	 * 
	 * @param string $author
	 * 
	 * @return array $article
	 */
	public function get_article($author)
	{		
		//connect to database
		$this->db->connect();
		
		//sanitize data
		$author = $this->db->escape($author);
		
		//prepare query
		$sql = "SELECT * 
				FROM `books`
				WHERE `book_id` = '1'
				LIMIT 1";

		$this->db->prepare($sql);
		
		//execute query
		$this->db->query();
		
		$article = $this->db->fetch('array');
		
		return $article;
	}
	
}
