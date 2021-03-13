<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdata extends CI_Model {
	public function icon(){
		$sql = "SELECT * FROM icon ORDER BY nama";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}
}