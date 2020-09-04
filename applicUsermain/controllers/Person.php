<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller {
	public function index()
	{
		if (isset($_POST['exit'])) {$this->load->model('passuser_model'); $this->passuser_model->exit_person();}
		if($this->session->userdata('tip')=='finadmin'){
			$datah['title']="финансы aдминка";
			$datah['js']="person";
			$datah['css']="styleperson";
			$datah['fio']=$this->session->userdata('fio');
			$datah['tip']=$this->session->userdata('tipname');
			$datah['info']="Администрирование";
			$this->load->view('head/headaMain',$datah);
			/*--------------------------------------------*/
			$datac="";
			$q = $this->db->order_by('fio')->get('person');
			foreach ($q->result() as $r)
			{
				$datac['fio'][$r->id]=$r->fio;
				$datac['pas'][$r->id]=$r->pass;
				$datac['idTip'][$r->id]=$r->id_tip;
				$datac['dost'][$r->id]=$r->dost;
				$datac['idClass'][$r->id]=$r->id_class;
			}
			$datac['access']=$this->access();
			$datac['class_room']=$this->class_room();
			$datac['tipPerson']=$this->tipPerson();
			$this->load->view('conten/contenPerson',$datac);
			$this->load->view('footer/footerMain');
		}else{header("Location: http://" .$_SERVER['SERVER_NAME']);}
	}
	private function access ()
	{
		$qa = $this->db->order_by('id')->get('access');
		foreach ($qa->result() as $ra)
		{
			$m[$ra->id]=$ra->name;
		}
		return $m;
	}
	private function class_room ()
	{
		$qc = $this->db->order_by('id')->get('class_room');
		foreach ($qc->result() as $rc)
		{
			$m[$rc->id]=$rc->teacher." - ".$rc->income_year;
		}
		return $m;
	}
	private function tipPerson ()
	{
		$qt = $this->db->order_by('id')->get('tipPerson');
		foreach ($qt->result() as $rt)
		{
			$m[$rt->id]=$rt->namet;
		}
		return $m;
	}
}
?>