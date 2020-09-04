<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Current extends CI_Controller {
	public function index()
	{
		if (isset($_POST['exit'])) {$this->load->model('passuser_model'); $this->passuser_model->exit_person();}
		if($this->session->has_userdata('tip')){
			$this->load->model('nomberclass_model');
			$this->load->model('CountSumm_model');
			$idclass=$this->session->userdata('id_class');
			$nc=$this->nomberclass_model->getNomberClass($this->session->userdata('class_room'));
			$datah['title']="текущий расход $nc-Б класса";
			$datah['js']="сurrent";
			$datah['css']="styleinvoice";
			$datah['fio']=$this->session->userdata('fio');
			$datah['tip']=$this->session->userdata('tipname');
			$datah['nc']=$nc;
			$summp=$this->CountSumm_model->getSummComingCurrent ();
			$summr=$this->db->select_sum('writeoff')->where('id_class', $idclass)->get('historyinvoicecurrent')->row('writeoff');
			$datah['info']="начисленно: $summp / потраченно: $summr";
			$this->load->view('head/headMain',$datah);
			/*----------------------------------------*/
			$datac['amont']=array('6'=>'Июнь','5'=>'Май','4'=>'Апрель','3'=>'Март','2'=>'Фефраль','1'=>'Январь','12'=>'Декабрь','11'=>'Ноябрь','10'=>'Октябрь','9'=>'Сентябрь');
			$mont=$this->db->where('id_class', $idclass)->get('period')->row('mont');
			$datac['tm']=date("n",strtotime($mont));
			$datac['summ']=$this->db->where('id_class', $idclass)->get('current')->row('summ');
			foreach ($datac['amont'] AS $k=>$name) {
				$spent=$this->db->select_sum('writeoff')->where('id_class', $idclass)->where('MONTH(period)', $k)->get('historyinvoicecurrent',false)->row('writeoff');
				$datac['spent'][$k]=$spent;
			}
			$this->load->view('conten/contenCurrent',$datac);
			$this->load->view('footer/footerMain');
		}else{header("Location: http://" .$_SERVER['SERVER_NAME']);}
	}
}
?>