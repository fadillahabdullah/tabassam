<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    function __construct() {
        parent::__construct();
        $data["datalogin"] = $this->Mlogin->cek_login();
        if(is_array($data["datalogin"])){
            if(count($data["datalogin"])>0){
                $this->load->view('b416k', $data, true);
            }else{
                redirect(base_url('Login'));
            }
        }else{redirect(base_url('Login'));}
    }

	public function index(){$this->load->view('b416k');}

    public function logout(){
        $this->session->unset_userdata(sesi);
        if($this->session->userdata(sesi) == NULL){echo base64_encode("1");}
        else{echo base64_encode("0");}
    }

    public function gantipassword(){
		$ayy = dekripsi($this->encryption->decrypt(base64_decode($this->session->userdata(sesi))));
		$dtl = explode("|", $ayy);
		$id = $dtl[0];
		$lama = md5(base64_encode(enkripsi(trim($this->input->post("lama")))));
		$baru = md5(base64_encode(enkripsi(trim($this->input->post("baru")))));
		$td = $this->Mlogin->login($id, $lama);
		if(is_array($td)){
			if(count($td) > 0){
				$operasi = $this->Mlogin->update_password($id, $baru);
				if($operasi == "1"){
					$ket = "ID: $id Mengganti Passwordnya";
					$this->Mlog->log_history("Akun","Ganti Password",$ket);
				}
				echo base64_encode($operasi);
			}else{echo base64_encode("90");}
		}else{echo base64_encode("90");}
	}
}
