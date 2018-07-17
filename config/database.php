<?php
class database{
  var $host   = "localhost";
	var $uname  = "root";
	var $pass   = "";
	var $db     = "db_greenbakery";

  public $link;

	function __construct(){
		$this->link = new mysqli($this->host, $this->uname, $this->pass,$this->db);
		// mysqli_connect($this->db);
	}

  function query($query){
     return $this->link->query($query);
  }

}
