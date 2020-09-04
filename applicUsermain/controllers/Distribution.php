<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Distribution extends CI_Controller {
	public function index()
	{
		if (isset($_POST['exit'])) {$this->load->model('passuser_model'); $this->passuser_model->exit_person();}
		if($this->session->has_userdata('tip')){
			$this->load->model('nomberclass_model');
			$this->load->model('CountSumm_model');
			$idclass=$this->session->userdata('id_class');
			$nc=$this->nomberclass_model->getNomberClass($this->session->userdata('class_room'));
			$Rp=$this->db->where('id_class', $idclass)->get('period')->row();
			$retained_money=$this->CountSumm_model->getRetainedMoney ($idclass,$Rp->mont);
			$Overpayment=$this->CountSumm_model->getOverpayment ($idclass);
			$datah['title']="Распределение средств $nc-Б класса";
			$datah['js']="distribution";
			$datah['css']="styledistribution";
			$datah['fio']=$this->session->userdata('fio');
			$datah['tip']=$this->session->userdata('tipname');
			if ($this->session->userdata('tip')<=2) {
				$datac['seting']="<img src='resurUs/images/configuration.png' class='cur' onclick='var helpDisc=window.open(\"/help/setingInv\", \"seting\",\"width=1000,height=550\")'>";
			}else{
				$datac['seting']="";
			}
			$datah['nc']=$nc;
			if ($retained_money<0) $styleretained_money ="style = 'color:red;'"; else $styleretained_money="";
			$datah['info']="нераспределенные : <span $styleretained_money>".($retained_money-$Overpayment)."</span> ";
			if ($Overpayment) $datah['info'].= "<span style='color:green'><small>на след. мес.: $Overpayment</small></span>";
			$this->load->view('head/headMain',$datah);
			/*-----------------------------------------------------*/
			$this->db->select('invoice.id, invoice.namei, invoice.disclosure, invoice.summ, categoryinv.namecat, categoryinv.id idcat, categoryinv.color');
			$this->db->from('invoiceclass');
			$this->db->join('invoice', 'invoice.id = invoiceclass.id_inv', 'left');
			$this->db->join('categoryinv', 'categoryinv.id = invoice.id_catinv', 'left');
			$this->db->where('invoiceclass.id_class', $this->session->userdata('id_class'));
			$this->db->order_by('invoice.id_catinv');
			$this->db->order_by('invoice.id');
			$query =$this->db ->get();
			$datac['monts']=$this->nomberclass_model->getInfoMonth ($Rp->mont);
			$datac['retained_money']=$retained_money;
			$tempidcat=0;
			foreach ($query->result() as $r)
			{
				if ($tempidcat != $r->idcat) {
					$tempidcat=$r->idcat; 
					$datac['sumoverall'][$r->id]=$this->CountSumm_model->getSummInvCatOverall($r->idcat,$Rp->mont);
					$datac['sumohistory'][$r->id]=$this->CountSumm_model->getSummInvCatHistori($r->idcat,$Rp->mont);
				}
				$datac['color'][$r->id]=$r->color;
				$datac['namei'][$r->id]=$r->namei;
				$datac['namecat'][$r->id]=$r->namecat;
				$datac['disclosure'][$r->id]=$r->disclosure;
				$datac['summ'][$r->id]=$r->summ;
				
				if ($this->db->where('id_inv',$r->id)->where('period',$Rp->mont)->where('id_class', $idclass)->get('history')->row())
					$datac['style'][$r->id]="disab";
				else $datac['style'][$r->id]="enabl";
				
			}
			$this->load->view('conten/contenDistribution',$datac);
			$this->load->view('footer/footerMain');
		}else{header("Location: http://" .$_SERVER['SERVER_NAME']);}
	}
	
}
?>