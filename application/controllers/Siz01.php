<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Siz01 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "siz01";
		$data["datalogin"] = $this->Mlogin->cek_login();
		$dataform = $this->Mlogin->cek_sistem($idformini);
        if(is_array($data["datalogin"])){
			foreach($dataform as $cx){
				$idsistem_sistem = $cx->id_sistem;
			}
			$idsistem_user = array();
         	foreach ($data["datalogin"] as $dl){
				$idlevel = $dl->id_level;
				array_push($idsistem_user, $dl->id_sistem);
			}
			if(array_search($idsistem_sistem, $idsistem_user) !== false){}else{redirect(base_url());}
			$data["datamenu"] = $this->Mlogin->cek_menu($idsistem_sistem, $idlevel);
			$data["dataform"] = $this->Mlogin->cek_form($idsistem_sistem, $idlevel);
			$data["ids"] = $idsistem_sistem;
			$data["idf"] = $idformini;
			$this->idsc = $idsistem_sistem;
			$idform = array(); $akses = array();
			foreach ($data["dataform"] as $dx){
				array_push($idform, $dx->id_form);
				if($dx->id_form == $idformini){array_push($akses, $dx->akses_tambah, $dx->akses_update, $dx->akses_hapus, $dx->akses_cetak);}
			}
			if(array_search($idformini, $idform) !== false){
				$data["akses"] = $akses;
				$this->aksesc = $akses; 
			}else{redirect(base_url());}
        	$this->load->view($idsistem_sistem.'/basis', $data, true);
        }else{redirect(base_url());}
    }

	public function index(){
		$data["fill"] = "siz01v";
		$data["dtjenis"] = $this->Mjen01->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Msiz01->data();
        foreach ($dt as $k){
            $id = $k->id;
            $nama = $k->nama;
            $jenis = $k->jenis;
            $status = $k->status;

            if ($status=="Y"){
            	$st='Aktif';
            }else{
            	$st='Tidak Aktif';
            }
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$nama.'","'.$jenis.'","'.$st.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Msiz01->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
					$nama = $k->nama;
					$jenis = $k->id_jenis;
					$status = $k->status;
				}
				echo base64_encode("1|".$id."|".$nama."|".$jenis."|".$status);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$jenis = trim(str_replace("'","''",$this->input->post("jenis"))); 
			$status = trim(str_replace("'","''",$this->input->post("status")));
			$operasi = $this->Msiz01->tambah($id, $nama, $jenis, $status);
			if($operasi == "1"){
				$ket = "ID Pakan: $id,\nNama Pakan: $nama,\nId Jenis: $jenis,\nStatus: $status";
				$this->Mlog->log_history("Pakan","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$jenis = trim(str_replace("'","''",$this->input->post("jenis")));
			$status = trim(str_replace("'","''",$this->input->post("status")));
			$operasi = $this->Msiz01->update($id, $nama, $jenis, $status);
			if($operasi == "1"){
				$ket = "ID Pakan: $id,\nNama Pakan: $nama,\nID Jenis: $jenis,\nStatus: $status";
				$this->Mlog->log_history("Pakan","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$dt = $this->Msiz01->filter($id);
			$operasi = $this->Msiz01->hapus($id);
			if($operasi == "1"){
				foreach ($dt as $k){
					$id = $k->id;
					$nama = $k->nama;
					$jenis = $k->id_jenis;
					$status = $k->status;
				}
				$ket = "ID Pakan: $id,\nNama Pakan: $nama,\nID Jenis: $jenis,\nStatus: $status";
				$this->Mlog->log_history("Pakan","Hapus",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}
}