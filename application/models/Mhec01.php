<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mhec01 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM hecheck ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM hecheck WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $tgl, $jam, $tpoin, $tactual, $hpoin, $hactual, $heater, $damper, $spray, $tnight){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO hecheck VALUES('$id','$tgl','$jam','$tpoin','$tactual','$hpoin','$hactual','$heater','$damper','$spray','$tnight',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $tgl, $jam , $tpoin, $tactual, $hpoin, $hactual, $heater, $damper, $spray, $tnight){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE hecheck SET tgl='$tgl', jam='$jam', tpoin='$tpoin', tactual='$tactual', hactual='$hactual', heater='$heater', damper='$damper',spray='$spray', tnight='$tnight',tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM hecheck WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}