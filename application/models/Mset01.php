<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mset01 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM setter ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM setter WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $tgl, $jam, $tpoin, $tactual, $hpoin, $hactual, $damper, $turning, $spray, $tnight){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO setter VALUES('$id','$tgl','$jam','$tpoin','$tactual','$hpoin','$hactual','$damper','$turning','$spray','$tnight',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $tgl, $jam , $tpoin, $tactual, $hpoin, $hactual, $damper, $turning, $spray, $tnight){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE setter SET tgl='$tgl', jam='$jam', tpoin='$tpoin', tactual='$tactual', hactual='$hactual', damper='$damper', turning='$turning',spray='$spray', tnight='$tnight',tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM setter WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}