<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CRoom extends CI_Controller {
	public function index()
	{
		if (isset($_POST['exit'])) {$this->load->model('passuser_model'); $this->passuser_model->exit_person();}
		if($this->session->userdata('tip')=='finadmin'){
			$datah['title']="финансы aдминка";
			$datah['js']="croom";
			$datah['css']="styleperson";
			$datah['fio']=$this->session->userdata('fio');
			$datah['tip']=$this->session->userdata('tipname');
			$datah['info']="Администрирование Классы";
			$this->load->view('head/headaMain',$datah);
			/*--------------------------------------------*/
			$datac="";
			$q = $this->db->order_by('income_year')->get('class_room');
			foreach ($q->result() as $r)
			{
				$datac['teacher'][$r->id]=$r->teacher;
				$datac['income_year'][$r->id]=$r->income_year;
			}
			$this->load->view('conten/contenCRoom',$datac);
			$this->load->view('footer/footerMain');
		}else{header("Location: http://" .$_SERVER['SERVER_NAME']);}
	}
}
?>