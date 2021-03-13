<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mjtel1 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM jenistelur ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM jenistelur WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $nama, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO jenistelur VALUES('$id','$nama','$keterangan',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE jenistelur SET nama='$nama', keterangan='$keterangan',tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM jenistelur WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}