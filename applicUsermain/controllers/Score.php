<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Score extends CI_Controller {
	public function index()
	{
		if (isset($_POST['exit'])) {$this->load->model('passuser_model'); $this->passuser_model->exit_person();}
		if($this->session->userdata('tip')=='finadmin'){
			$this->load->model('nomberclass_model');
			$datah['title']="финансы aдминка";
			$datah['js']="score";
			$datah['css']="styleperson";
			$datah['fio']=$this->session->userdata('fio');
			$datah['tip']=$this->session->userdata('tipname');
			$datah['info']="Администрирование счетов";
			$this->load->view('head/headaMain',$datah);
			/*--------------------------------------------*/
			$datac="";
			$q = $this->db->order_by('id_catinv, namei')->get('invoice');
			foreach ($q->result() as $r)
			{
				$datac['namei'][$r->id]=$r->namei;
				$datac['disclosure'][$r->id]=$r->disclosure;
				$datac['summ'][$r->id]=$r->summ;
				$datac['namecat'][$r->id]=$r->id_catinv;
				$datac['masCl'][$r->id]=$this->getClassInvoce ($r->id);
				$datac['history'][$r->id]=$this->getIsHistory ($r->id);
			}
			
			$this->load->view('conten/contenScore',$datac);
			$this->load->view('footer/footerMain');
		}else{header("Location: http://" .$_SERVER['SERVER_NAME']);}
	}
	private function getClassInvoce ($id)
	{
		$qa = $this->db->where('id_inv',$id)->group_by('id_class')->get('invoiceclass');
		$m=array();
		foreach ($qa->result() as $ri)
		{	$year=$this->db->where('id',$ri->id_class)->get('class_room')->row('income_year');
			$m[$ri->id_class]=$this->nomberclass_model->getNomberClass($year)."-Б";
		}
		if ($m) return $m;
		else {
			$m[]="нет";
			return $m;
		}
	}
	private function getIsHistory ($id){
		if($this->db->where('id_inv',$id)->get('history')->row()) return TRUE;
		else FALSE;
	}
	
}
?>