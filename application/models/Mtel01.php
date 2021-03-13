<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mtel01 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS jenistelur, c.nama AS kandang FROM telur AS a LEFT JOIN jenistelur AS b ON a.id_jenistelur = b.id LEFT JOIN kandang AS c ON a.id_kandang = c.id ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM telur WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $tgl, $kandang ,$jenistelur, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO telur VALUES('$id','$tgl','$kandang','$jenistelur','$keterangan', NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $tgl, $kandang, $jenistelur, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE telur SET tgl='$tgl', id_kandang='$kandang', id_jenistelur='$jenistelur',keterangan='$keterangan',tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM telur WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}