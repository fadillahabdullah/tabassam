<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mcol01 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM collingroom ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM collingroom WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $tgl, $jam, $tspoint, $tactual, $rh, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO collingroom VALUES('$id','$tgl','$jam','$tspoint','$tactual','$rh','$keterangan',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $tgl, $jam , $tspoint, $tactual, $rh, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE collingroom SET tgl='$tgl', jam='$jam', tspoint='$tspoint', tactual='$tactual', rh='$rh', keterangan='$keterangan',tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM collingroom WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}