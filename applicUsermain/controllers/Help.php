<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends CI_Controller {
	public function index()
	{
		header("Location: http://" .$_SERVER['SERVER_NAME']);
	}
	public function discounts () {
		if($this->session->has_userdata('tip')){		
			$datah['title']="Help discounts";
			$query = $this->db->from('lgota')->get();
			foreach ($query->result() as $row){
				$datac['dicon'][$row->stake]=$row->namel;
			}
			$this->load->view('head/headHelp',$datah);
			$this->load->view('conten/contenHelp',$datac);
			$this->load->view('footer/footerIn');
		}else{header("Location: http://" .$_SERVER['SERVER_NAME']);}		
	}
	public function oldboy () {
		if($this->session->has_userdata('tip')){		
			$datah['title']="Удаленные ученики";
			$query = $this->db->where('id_class', $this->session->userdata('id_class'))->order_by('fio')->get('Oldschoolboy');
			$datac['dost']=$this->session->userdata('dost');
			$datac['scholboy'][0]="";
			foreach ($query->result() as $row)
			{
				$datac['scholboy'][$row->id]= $row->fio;
				$datac['idboy'][$row->id]= $row->id_boy;
			}
			$this->load->view('head/headOldboy',$datah);
			$this->load->view('conten/contenOldboy',$datac);
			$this->load->view('footer/footerIn');
		}else{header("Location: http://" .$_SERVER['SERVER_NAME']);}		
	}
	public function history_schoolboy ($idboy) {
		if($this->session->has_userdata('tip')){		
			$datah['title']="История оплат ученика";
			$queryb = $this->db->from('schoolboy')->where('schoolboy.id',$idboy)->join('contribution','contribution.id_boy=schoolboy.id','left')->join('class_room','class_room.id=schoolboy.id_class','left')->get();//->join('schoolboy','schoolboy.id=history.id_boy','left')
			$Rboy=$queryb->row();
			$datac['fio']=$Rboy->fio;
			$datac['teacher']=$Rboy->teacher;
			$datac['income_year']=$Rboy->income_year;
			$datac['fact']=$Rboy->fact;
			$query = $this->db->from('history')->where('id_boy',$idboy)->order_by('d', 'DESC')->get();//->join('schoolboy','schoolboy.id=history.id_boy','left')
			if ($query->row()){
				$i=0;
				foreach ($query->result() as $row){
					$i++;
					$dey=date("d.m.y",strtotime($row->d));
					$datac['summ']["$i"]=$row->sp;
					$datac['d'][$i]=$dey;
				}
			}else $datac['his']['истории']="нет";
			$this->load->view('head/headHistory',$datah);
			$this->load->view('conten/contenHistory',$datac);
			$this->load->view('footer/footerIn');
		}else{header("Location: http://" .$_SERVER['SERVER_NAME']);}		
	}
	public function history_oldschoolboy ($idboy) {
		if($this->session->has_userdata('tip')){		
			$datah['title']="История оплат ученика";
			$queryb = $this->db->from('Oldschoolboy')->where('Oldschoolboy.id_boy',$idboy)->join('class_room','class_room.id=Oldschoolboy.id_class','left')->get();//->join('schoolboy','schoolboy.id=history.id_boy','left')
			$Rboy=$queryb->row();
			$datac['fio']=$Rboy->fio;
			$datac['teacher']=$Rboy->teacher;
			$datac['income_year']=$Rboy->income_year;
			$datac['fact']=$Rboy->fact;
			$query = $this->db->from('history')->where('id_boy',$idboy)->order_by('d', 'DESC')->get();//->join('schoolboy','schoolboy.id=history.id_boy','left')
			if ($query->row()){
				$i=0;
				foreach ($query->result() as $row){
					$i++;
					$dey=date("d.m.y",strtotime($row->d));
					$datac['his']["$i) $dey"]=$row->sp;
				}
			}else $datac['his']['истории']="нет";
			$this->load->view('head/headHistory',$datah);
			$this->load->view('conten/contenHistory',$datac);
			$this->load->view('footer/footerIn');
		}else{header("Location: http://" .$_SERVER['SERVER_NAME']);}		
	}
	public function setingInv () {
		if ($this->session->userdata('dost')<=2) {
			$datah['title']="Настройки счетов";
			$this->load->view('head/headSetingInv',$datah);
			/*-----------------*/
			$query = 
				$this->db
				->select('categoryinv.namecat, categoryinv.color, invoice.namei, invoice.disclosure, invoice.summ, invoice.id')
				->join('invoice','invoice.id_catinv=categoryinv.id')
				->order_by('categoryinv.id')
				->order_by('invoice.id')
				->get('categoryinv');
			foreach ($query->result() as $r){
				$datac['color'][$r->id]=$r->color;
				$datac['namei'][$r->id]=$r->namei;
				$datac['namecat'][$r->id]=$r->namecat;
				$datac['disclosure'][$r->id]=$r->disclosure;
				$datac['summ'][$r->id]=$r->summ;
				if ($this->db->where('id_class',$this->session->userdata('id_class'))->where('id_inv',$r->id)->get('invoiceclass')->row()) $datac['switchcl'][$r->id]="switchOn";
				else $datac['switchcl'][$r->id]="switchOff";
			}
			$this->load->view('conten/contenSetingInv',$datac);
			$this->load->view('footer/footerIn');
		}else{header("Location: http://" .$_SERVER['SERVER_NAME']);}
	}
	public function historyInvoce ($id_inv) {
		$datah['title']="История счета";
		$this->load->view('head/headHelp',$datah);
		$this->load->model('nomberclass_model');
		$datac['nameInvoice']=$this->db->where('id',$id_inv)->get('invoice')->row('namei');
		$query=$this->db->where('id_inv', $id_inv)->get('history');
		foreach ($query->result() as $r)
		{
			$year=$this->db->where('id',$r->id_class)->get('class_room')->row('income_year');
			$datac['dat'][$r->id]=date("d-m-y",strtotime($r->d));
			$datac['sp'][$r->id]=$r->sp;
			$datac['sr'][$r->id]=$r->sr;
			$datac['clroom'][$r->id]=$this->nomberclass_model->getNomberClass($year)."-Б";
			$datac['coment'][$r->id]=$r->coment;	
		}
		$this->load->view('conten/contenHistoryInv',$datac);
		$this->load->view('footer/footerIn');
	}
}
?>