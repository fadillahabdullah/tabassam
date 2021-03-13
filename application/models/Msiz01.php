<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Msiz01 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS jenis FROM produk AS a LEFT JOIN jenis AS b ON a.id_jenis = b.id ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM produk WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $nama, $jenis, $status){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO produk VALUES('$id','$nama','$jenis','$status',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $jenis, $status){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE produk SET nama='$nama', id_jenis='$jenis', status='$status' ,tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM produk WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}