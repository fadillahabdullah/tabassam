<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public $idsc = "003";
	function __construct() {
		parent::__construct();
		$data["datalogin"] = $this->Mlogin->cek_login();
        if(is_array($data["datalogin"])){
			$idsistem = array();
         	foreach ($data["datalogin"] as $dl){
				$idlevel = $dl->id_level;
				array_push($idsistem, $dl->id_sistem);
			}
			if(array_search($this->idsc, $idsistem) !== false){}else{redirect(base_url());}
			$data["datamenu"] = $this->Mlogin->cek_menu($this->idsc, $idlevel);
			$data["dataform"] = $this->Mlogin->cek_form($this->idsc, $idlevel);
			$data["ids"] = $this->idsc;
        	$this->load->view($this->idsc.'/basis', $data, true);
        }else{redirect(base_url());}
    }

	public function index(){
		$data["fill"] = "d500";
		//$data["dtsistem"] = $this->Msi933->filter($this->idsc);
		// $data["dtpelanggan_aktif"] = $this->Mdashboard->pelanggan('states','aktif');
		// $data["dtjumlah_tunggakan"] = $this->Mdashboard->tagihan_tunggak();
		// $data["dtaduan_pending"] = $this->Mdashboard->status_aduan('0000-00-00');
		// $data["dtjml_sistem"] = $this->Mdashboard->jumlah_sistem();
		// $data["dttraffic_apps"] = $this->Mdashboard->traffic_pengunjung(date("Y-m"),"apps");
		$this->load->view($this->idsc.'/basis', $data);
	}
}
