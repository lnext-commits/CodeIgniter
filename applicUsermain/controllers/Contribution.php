<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contribution extends CI_Controller {
	public function index()
	{
		if (isset($_POST['exit'])) {$this->load->model('passuser_model'); $this->passuser_model->exit_person();}
		if($this->session->has_userdata('tip')){
			$idclass=$this->session->userdata('id_class');
			$this->load->model('nomberclass_model');
			$this->load->model('CountSumm_model');
			$nc=$this->nomberclass_model->getNomberClass($this->session->userdata('class_room'));
			$datah['title']="взносы $nc-Б класса";
			$datah['js']="contribution";
			$datah['css']="stylecontribution";
			$datah['fio']=$this->session->userdata('fio');
			$datah['tip']=$this->session->userdata('tipname');
			$datah['nc']=$nc;
			$mont=$this->db->where('id_class', $idclass)->get('period')->row('mont');
			if (isset($mont)) {
				$proc=$this->CountSumm_model->getProcConrtibution($idclass);
				$summup=$this->CountSumm_model->getSummupConrtibution($idclass);
			}else{
				$proc='';
				$summup='';
				
			}
			
			if ($this->session->userdata('tip')<=2) {
				$datac['addboy']="<img src='resurUs/images/users.png' class='cur' onclick='addboy ()'>";
				$datac['oldboy']="<img src='resurUs/images/bin-empty.png' class='cur' onclick='var helpDisc=window.open(\"/help/oldboy\", \"help\",\"width=1000,height=550\")'>";
			}else {
				$datac['addboy']="";
				$datac['oldboy']="";
			}
			if (isset ($mont)) {
				$tm=date("m");
				$pt=date("m",strtotime($mont));
				if ($pt==$tm)	$datah['info']="<b>". $this->nomberclass_model->getInfoMonth ($mont)."</b> сданно $proc% <small>($summup)</small>";
				else $datah['info']="
					<span style='color:red;'>закончился "
					.$this->nomberclass_model->getInfoMonth ($mont).
					" => создать след. </span> <img src='resurUs/images/download.png' class='cur' onclick=' nextmonth ($idclass)'>";
			}
			else $datah['info']="<span style='color:red;'>Инсталяция </span> <img src='resurUs/images/download.png' class='cur' onclick=' installationClass ($idclass)'>";
			$this->load->view('head/headMain',$datah);
			
			$this->db->select('schoolboy.* ,contribution.plan, contribution.fact, lgota.stake');
			$this->db->from('schoolboy');
			$this->db->join('contribution', 'contribution.id_boy = schoolboy.id', 'left');
			$this->db->join('lgota', 'lgota.id = schoolboy.id_lgota', 'left');
			$this->db->where('id_class', $this->session->userdata('id_class'));
			$this->db->order_by('fio');
			$query = $this->db->get();
			$datac['dost']=$this->session->userdata('dost');
			$datac['scholboy']="";
			$fl=0;
			foreach ($query->result() as $row)
			{
				$fl++;
				$datac['scholboy'][$row->id]= $row->fio;
				$datac['lgota'][$row->id]= $row->id_lgota;
				if (isset ($mont)) {
					$cash=$row->fact-$row->plan;
					$datac['cash'][$row->id]=$cash;
					$color="color:#1B21DB;";
					if ($cash<0-$row->stake) $color="color:red;";
					if ($cash>0) $color="color:green;";
					$datac['color'][$row->id]=$color;
				}else {
					$datac['cash'][$row->id]="";
					$datac['color'][$row->id]="";
				}
			}
			if ($fl) $this->load->view('conten/contenContribution',$datac);
			else $this->load->view('conten/contenContributionInstal',$datac);
			$this->load->view('footer/footerMain');
		}else{header("Location: http://" .$_SERVER['SERVER_NAME']);}
	}
	
}
?>