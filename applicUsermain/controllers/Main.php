<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function index()
	{
		if (isset($_POST['exit'])) {$this->load->model('passuser_model'); $this->passuser_model->exit_person();}
		if($this->session->has_userdata('tip')){
			$idclass=$this->session->userdata('id_class');
			$mont=$this->db->where('id_class', $idclass)->get('period')->row('mont');
			if (!isset($mont)){ header("Location: /contribution"); exit;}
			/* ----------------------------------------- */
			$this->load->model('nomberclass_model');
			$this->load->model('CountSumm_model');
			$nc=$this->nomberclass_model->getNomberClass($this->session->userdata('class_room'));
			$retained_money=$this->CountSumm_model->getRetainedMoney ($idclass,$mont);
			$Overpayment=$this->CountSumm_model->getOverpayment ($idclass);
			$datah['title']="финансы $nc-Б класса";
			$datah['js']="empty";
			$datah['css']="empty";
			$datah['fio']=$this->session->userdata('fio');
			$datah['tip']=$this->session->userdata('tipname');
			$datah['nc']=$nc;
			if ($Overpayment) 
				$datah['info']="на руках: (".($retained_money-$Overpayment)." + <span style='color: green'><small >$Overpayment</small></span>)";
			else 	$datah['info']="на руках: $retained_money";
			$this->load->view('head/headMain',$datah);
			/*--------------------------------------------*/
			$datac['summCurrent']=$this->db->where('id_class', $idclass)->get('current')->row('summ');
			$datac['proc']=$this->CountSumm_model->getProcConrtibution($this->session->userdata('id_class'));
			$this->load->view('conten/contenMain',$datac);
			$this->load->view('footer/footerMain');
		}else{header("Location: http://" .$_SERVER['SERVER_NAME']);}
	}
}
?>