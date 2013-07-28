<?php
/**
 * The Database Library handles database interaction for the application
 */
abstract class Database_Library
{
	abstract protected function connect();
	abstract protected function disconnect();
	abstract protected function select($field);
	abstract protected function insert($table, $values, $rows=NULL);
	abstract protected function get($table);
	abstract protected function prepare($query);
	abstract protected function query($sql=NULL);
	abstract protected function fetch($type='object');	
	abstract protected function result_array();
	abstract protected function num_rows();
}