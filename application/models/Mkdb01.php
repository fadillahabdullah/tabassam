<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mkdb01 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS kandang FROM kdbreeding AS a LEFT JOIN kandang AS b ON a.id_kandang = b.id ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM kdbreeding WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $kandang, $tgl, $umur, $strain, $jantan, $betina, $periode, $keterangan, $status){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO kdbreeding VALUES('$id','$kandang','$tgl','$umur','$strain','$jantan','$betina','$periode','$keterangan','$status',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $kandang, $tgl, $umur, $strain, $jantan, $betina, $periode, $keterangan, $status){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE kdbreeding SET id_kandang='$kandang', tgl='$tgl', umur='$umur',strain='$strain',jantan='$jantan',betina='$betina',periode='$periode',keterangan='$keterangan',status='$status',tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM kdbreeding WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}