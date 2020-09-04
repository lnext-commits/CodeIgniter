<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Amain extends CI_Controller {
	public function index()
	{
		if (isset($_POST['exit'])) {$this->load->model('passuser_model'); $this->passuser_model->exit_person();}
		if($this->session->userdata('tip')=='finadmin'){
			$datah['title']="финансы админка";
			$datah['js']="empty";
			$datah['css']="empty";
			$datah['fio']=$this->session->userdata('fio');
			$datah['tip']=$this->session->userdata('tipname');
			$datah['info']="Администрирование";
			$this->load->view('head/headaMain',$datah);
			/*--------------------------------------------*/
			$datac="";
			$this->load->view('conten/contenaMain',$datac);
			$this->load->view('footer/footerMain');
		}else{header("Location: http://" .$_SERVER['SERVER_NAME']);}
	}
}
?>