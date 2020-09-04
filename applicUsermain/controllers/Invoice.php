<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
	public function index()
	{
		if (isset($_POST['exit'])) {$this->load->model('passuser_model'); $this->passuser_model->exit_person();}
		if($this->session->has_userdata('tip')){
			$this->load->model('nomberclass_model');
			$idclass=$this->session->userdata('id_class');
			$nc=$this->nomberclass_model->getNomberClass($this->session->userdata('class_room'));
			$datah['title']="Счета $nc-Б класса";
			$datah['js']="invoice";
			$datah['css']="styleinvoice";
			$datah['fio']=$this->session->userdata('fio');
			$datah['tip']=$this->session->userdata('tipname');
			$datah['nc']=$nc;
			$datah['info']="<b>Накопительные счета</b>";
			$this->load->view('head/headMain',$datah);
			$datac="";
			$fl=0;
			$query=$this->db
				->select('funded.id, invoice.id idinv, invoice.namei, invoice.disclosure, categoryinv.color, funded.summ')
				->where('categoryinv.id >', 2)
				->where('categoryinv.id <', 6)
				->where('funded.id_class', $idclass)
				->join('invoice','invoice.id=funded.id_inv','left')
				->join('categoryinv','categoryinv.id=invoice.id_catinv','left')
				->order_by('categoryinv.id')
				->order_by('invoice.id')
				->get('funded');
			foreach ($query->result() as $r)
			{
				$fl++;
				$datac['namei'][$r->id]=$r->namei;
				$datac['disclosure'][$r->id]=$r->disclosure;
				$datac['summ'][$r->id]=$r->summ;
				$datac['color'][$r->id]=$r->color;
				$datac['idinv'][$r->id]=$r->idinv;
				$datac['hidden'][$r->id]="";
				
				if ($r->summ == 0){
					if (!$this->db->where('id_class', $idclass)->where('id_inv',$r->idinv)->get('invoiceclass')->row()){
						$datac['hidden'][$r->id]="hidden";
					}
				}
			}
			
			if ($fl) $this->load->view('conten/contenInvoice',$datac);
			else $this->load->view('conten/contenInvoiceNon',$datac);
			$this->load->view('footer/footerMain');
		}else{header("Location: http://" .$_SERVER['SERVER_NAME']);}
	}
	
}
//hidden
?>