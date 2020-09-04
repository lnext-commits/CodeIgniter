<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Privilege extends CI_Controller {
	public function index()
	{
		if (isset($_POST['exit'])) {$this->load->model('passuser_model'); $this->passuser_model->exit_person();}
		if($this->session->userdata('tip')=='finadmin'){
			$datah['title']="финансы aдминка";
			$datah['js']="privilege";
			$datah['css']="styleperson";
			$datah['fio']=$this->session->userdata('fio');
			$datah['tip']=$this->session->userdata('tipname');
			$datah['info']="Администрирование Льгота";
			$this->load->view('head/headaMain',$datah);
			/*--------------------------------------------*/
			$datac="";
			$q = $this->db->order_by('id')->get('lgota');
			foreach ($q->result() as $r)
			{
				$datac['name'][$r->id]=$r->namel;
				$datac['stake'][$r->id]=$r->stake;
			}
			$this->load->view('conten/contenPrivilege',$datac);
			$this->load->view('footer/footerMain');
		}else{header("Location: http://" .$_SERVER['SERVER_NAME']);}
	}
}
?>