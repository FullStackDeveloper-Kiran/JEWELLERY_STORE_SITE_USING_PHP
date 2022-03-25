<?php

Class DbConnect
{

var $host = "localhost";

var $user = "root";

var $password = "";

var $database = "bbjewels";

var $persistent = false;

var $conn;

var $error_reporting = false;

/*constructor function this will run when we call the class */

function DbConnect () {

}

function open(){

$func = 'mysql_connect';


/* Connect to the MySQl Server */

$this->conn = $func($this->host, $this->user, $this->password);
if (!$this->conn) {
return false;
}
/* Select the requested DB */

if (@!mysql_select_db($this->database, $this->conn)) {
return false;
}
return true;
}

/*close the connection */

function close() {
return (@mysql_close($this->conn));
}

/* report error if error_reporting set to true */

function error() {
if ($this->error_reporting) {
return (mysql_error()) ;
}

}
}

/* Class to perform query*/
class DbQuery extends DbConnect
{
	var $result = '';
	var $sql;
	
	function DbQuery($sql1)
	{
	$this->sql = $sql1;
	}
	
	function query() {
	
	return $this->result = mysql_query($this->sql);
	//return($this->result != false);
	}
	
	function affectedrows() {
	return(@mysql_affected_rows($this->conn));
	}
	
	function numrows() {
	return(@mysql_num_rows($this->result));
	}
	function fetchobject() {
	return(@mysql_fetch_object($this->result, MYSQL_ASSOC));
	}
	function fetcharray() {
	return(@mysql_fetch_array($this->result));
	}
	
	function fetchassoc() {
	return(@mysql_fetch_assoc($this->result));
	}
	
	function freeresult() {
	return(@mysql_free_result($this->result));
	}

} 

?>