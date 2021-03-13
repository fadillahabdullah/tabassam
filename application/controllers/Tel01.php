<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tel01 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "tel01";
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
		$data["fill"] = "tel01v";
		$data["dtjenis"] = $this->Mjtel1->data();
		$data["dtkandang"] = $this->Mkand1->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mtel01->data();
        foreach ($dt as $k){
            $id = $k->id;
            $tgl = $k->tgl;
            $kandang = $k->kandang;
            $jenistelur = $k->jenistelur;
            $keterangan = $k->keterangan;
            
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$tgl.'","'.$kandang.'","'.$jenistelur.'","'.$keterangan.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mtel01->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
					$tgl = $k->tgl;
            		$kandang = $k->id_kandang;
					$jenistelur = $k->id_jenistelur;
					$keterangan = $k->keterangan;
				}
				echo base64_encode("1|".$id."|".$tgl."|".$kandang."|".$jenistelur."|".$keterangan);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$tgl = trim(str_replace("'","''",$this->input->post("tgl")));
			$kandang = trim(str_replace("'","''",$this->input->post("kandang")));
			$jenistelur = trim(str_replace("'","''",$this->input->post("jenistelur")));
			$keterangan = trim(str_replace("'","''",$this->input->post("keterangan"))); 
			$operasi = $this->Mtel01->tambah($id, $tgl, $kandang, $jenistelur, $keterangan);
			if($operasi == "1"){
				$ket = "ID telur: $id,\nTanggal: $tgl,\nKandang: $kandang,\nId Jenis: $jenistelur,\nKeterangan: $keterangan";
				$this->Mlog->log_history("telur","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$tgl = trim(str_replace("'","''",$this->input->post("tgl")));
			$kandang = trim(str_replace("'","''",$this->input->post("kandang")));
			$jenistelur = trim(str_replace("'","''",$this->input->post("jenistelur")));
			$keterangan = trim(str_replace("'","''",$this->input->post("keterangan")));
			$operasi = $this->Mtel01->update($id, $tgl, $kandang,$jenistelur, $keterangan);
			if($operasi == "1"){
				$ket = "ID telur: $id,\nTanggal: $tgl,\nKandang: $kandang,\nId Jenis: $jenistelur,\nKeterangan: $keterangan";
				$this->Mlog->log_history("telur","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$dt = $this->Mtel01->filter($id);
			$operasi = $this->Mtel01->hapus($id);
			if($operasi == "1"){
				foreach ($dt as $k){
					$id = $k->id;
					$tgl = $k->tgl;
            		$kandang = $k->id_kandang;
					$jenistelur = $k->id_jenistelur;
					$keterangan = $k->keterangan;					
				}
				$ket = "ID telur: $id,\nTanggal: $tgl,\nKandang: $kandang,\nId Jenis: $jenistelur,\nKeterangan: $keterangan";
				$this->Mlog->log_history("telur","Hapus",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}
}