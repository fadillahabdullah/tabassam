<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mbr001 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM gudang ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM gudang WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $nama, $status, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO gudang VALUES('$id','$nama','$status','$keterangan',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $status, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE gudang SET nama='$nama', status='$status', keterangan='$keterangan' ,tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM gudang WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}