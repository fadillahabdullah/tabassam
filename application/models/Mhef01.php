<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mhef01 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS kandang FROM hefarm AS a LEFT JOIN kandang AS b ON a.id_kandang = b.id ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM hefarm WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $tgl, $jam, $kiriman, $kandang, $jmltelur, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO hefarm VALUES('$id','$tgl','$jam','$kiriman','$kandang','$jmltelur','$keterangan',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $tgl, $jam , $kiriman, $kandang, $jmltelur, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE hefarm SET tgl='$tgl', jam='$jam', kiriman='$kiriman', id_kandang='$kandang', jmltelur='$jmltelur', keterangan='$keterangan',tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM hefarm WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}