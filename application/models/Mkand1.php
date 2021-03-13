<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mkand1 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM kandang ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM kandang WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $nama, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO kandang VALUES('$id','$nama','$keterangan',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE kandang SET nama='$nama', keterangan='$keterangan',tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM kandang WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}