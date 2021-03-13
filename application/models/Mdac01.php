<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdac01 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM dailycheck ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM dailycheck WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $tgl, $jam, $spoin, $tdisplay, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO dailycheck VALUES('$id','$tgl','$jam','$spoin','$tdisplay','$keterangan',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $tgl, $jam , $spoin, $tdisplay, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE dailycheck SET tgl='$tgl', jam='$jam', spoin='$spoin', tdisplay='$tdisplay', keterangan='$keterangan',tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM dailycheck WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}