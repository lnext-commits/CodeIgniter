<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxAdmin extends CI_Controller {
	public function index() {
		header("Location: http://" .$_SERVER['SERVER_NAME']);
	}
	public function person ($rank) {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			switch ($rank) {
				case 'savePerson':
					$data = array(
						'fio' => $this->input->post('fio'),
						'id_tip' => $this->input->post('tipPerson'),
						'dost' => $this->input->post('access'),
						'id_class' => $this->input->post('room'),
						'pass' => $this->input->post('pass')
					);
						if ($this->input->post('id'))
							echo $this->db->where('id', $this->input->post('id'))->update('person', $data);
						else 
							echo $this->db->insert('person', $data);
				break;
				case 'getViewNewPerson':
					$datac['access']=$this->access();
					$datac['class_room']=$this->class_room();
					$datac['tipPerson']=$this->tipPerson();
					$this->load->view('contenAjax/contenNewPerson',$datac);
				break;
			}
		}else $this->index();
	}
	public function privilege ($rank) {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			switch ($rank) {
				case 'savePrivilege':
				if (!($this->input->post('namel')=="" &&  $this->input->post('summ')=="")){
					$data = array(
						'namel' => $this->input->post('namel'),
						'stake' => $this->input->post('summ')
					);
						if ($this->input->post('id'))
							echo $this->db->where('id', $this->input->post('id'))->update('lgota', $data);
						else 
							echo $this->db->insert('lgota', $data);
				}else {
					echo $this->db->where('id', $this->input->post('id'))->delete('lgota');
				}
				break;
				case 'getViewNewPrivilege':
					$this->load->view('contenAjax/contenNewPrivilege');
				break;
			}
		}else $this->index();
	}
	public function room ($rank) {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			switch ($rank) {
				case 'saveRoom':
					$data = array(
						'teacher' => $this->input->post('teacher'),
						'income_year' => $this->input->post('year')
					);
						if ($this->input->post('id'))
							echo $this->db->where('id', $this->input->post('id'))->update('class_room', $data);
						else 
							echo $this->db->insert('class_room', $data);
				break;
				case 'getViewNewRoom':
					$this->load->view('contenAjax/contenNewRoom');
				break;
			}
		}else $this->index();
	}
	public function score ($rank) {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			switch ($rank) {
				case 'delInvoice':
					echo $this->db->where('id',$this->input->post('id'))->delete('invoice');
				break;
			}
		}else $this->index();
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