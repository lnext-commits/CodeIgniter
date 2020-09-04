<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	public function index() {
		header("Location: http://" .$_SERVER['SERVER_NAME']);
	}
	public function schoolboy($rank) {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			switch ($rank) {
				case 'viewaddnew':
					$this->db->select('*');
					$this->db->from('lgota');
					$query = $this->db->get();
					$datac="";//$rezult.="<option value='$row->id'>$row->namel</option>";
					foreach ($query->result() as $row)
					{
						$datac['sel'][$row->id]=$row->namel;
					}
					$this->load->view('contenAjax/viewaddnew',$datac);
				break;
				case 'savenewboy':
					$idc=$this->session->userdata('id_class');
					$fio = $this->input->post('fio');
					$idlgota = $this->input->post('idlgota');
					$datas = array(
					   'fio' => $fio,
					   'id_lgota' => $idlgota,
					   'id_class' => $idc
					);
					echo $this->db->insert('schoolboy', $datas);
					$idnewboy=$this->db->insert_id();
					if ($this->db->where('id_class',$idc)->get('period')->result()) {
						$stake=$this->db->where('id',$idlgota)->get('lgota')->row('stake');
						$datac = array(
						   'id_boy' => $idnewboy,
						   'plan' => $stake,
						   'fact' => 0,
						   'class_id' => $idc
						);
						$this->db->insert('contribution', $datac);
					}
				break;
				case 'editboy':
					$idboy=$this->input->post('idboy');
					$this->db->select('*');
					$this->db->from('schoolboy');
					$this->db->where('id', $idboy);
					$query = $this->db->get();
					$Rsc=$query->row();
					$datac['fio']=$Rsc->fio;
					$datac['id_lgota']=$Rsc->id_lgota;
					$this->db->select('*');
					$this->db->from('lgota');
					$query = $this->db->get();
					foreach ($query->result() as $row)
					{
						$datac['sel'][$row->id]=$row->namel;
					}
					$this->load->view('contenAjax/editboy',$datac);
				break;
				case 'refresh':
					$idboy=$this->input->post('idboy');
					$query = $this->db->where('id', $idboy)->get('Oldschoolboy');
					$Rsc=$query->row();
					$datac['fio']=$Rsc->fio;
					$this->load->view('contenAjax/refresh',$datac);
				break;
				case 'refreshboy':
					$idboy=$this->input->post('idboy');
					$query = $this->db->where('id', $idboy)->get('Oldschoolboy');
					$Rsc=$query->row();
					
					$datab = array(
						'id' => $Rsc->id_boy,
					   'fio' => $Rsc->fio,
					   'id_lgota' => $Rsc->id_lgota,
					   'id_class' => $Rsc->id_class
					);
					$datac = array(
					   'id_boy' => $Rsc->id_boy,
					   'plan' => $Rsc->plan,
					   'fact' => $Rsc->fact,
					   'class_id' => $Rsc->id_class
					);
					
					echo $this->db->insert('schoolboy', $datab);
					$this->db->insert('contribution', $datac);
					$this->db->where('id', $idboy)->delete('Oldschoolboy');
					
				break;
				case 'addcash':
					$idboy=$this->input->post('idboy');
					$datac['fio']= $this->db->where('id', $idboy)->get('schoolboy')->row('fio');
					$this->load->view('contenAjax/addcash',$datac);
				break;
				case 'saveeditboy':
					$fio = $this->input->post('fio');
					$idlgota = $this->input->post('idlgota');
					if ($idlgota) {
						$data = array(
						   'fio' => $fio,
						   'id_lgota' => $idlgota
						);
						$this->db->where('id',  $this->input->post('idboy'));
						echo $this->db->update('schoolboy', $data);
					}else {
						$querysc = $this->db->select('schoolboy.*, contribution.plan, contribution.fact')->where('schoolboy.id', $this->input->post('idboy'))->join('contribution', 'contribution.id_boy = schoolboy.id')->get('schoolboy');//
						$Rsc=$querysc->row();
						$dataob = array(
						   'id_boy' =>  $this->input->post('idboy'),
						   'fio' => $Rsc->fio,
						   'id_lgota' =>  $Rsc->id_lgota,
						   'id_class' =>  $Rsc->id_class,
							'plan' => $Rsc->plan,
							'fact' => $Rsc->fact
						);
						$this->db->insert('Oldschoolboy', $dataob); 
						echo $this->db->where('id', $this->input->post('idboy'))->delete('schoolboy');
						$this->db->where('id_boy', $this->input->post('idboy'))->delete('contribution');
					}
				break;
				case 'savecash':
					$cash = $this->input->post('cash');
					if ($cash !=0 ) {
						$fact=$this->db->where('id_boy', $this->input->post('idboy'))->get('contribution')->row ('fact');
						$savecash=$fact+$cash;
						$data = array(
						   'fact' => $savecash
						);
						 $this->db->where('id_boy',$this->input->post('idboy'))->update('contribution', $data);
						 $mont=$this->db->where('id_class', $this->session->userdata('id_class'))->get('period')->row('mont');
						$datah = array(
						   'd' => 'NOW()',
						   'sp' => $cash,
						   'id_boy' =>  $this->input->post('idboy'),
						   'period' => "ADDDATE('$mont', INTERVAL 1 MINUTE)",
						   'id_class' => $this->session->userdata('id_class')
						);
						echo $this->db->insert('history', $datah, false);
							//запись кометария
							$nid=$this->db->insert_id();
							$this->db->where('id',$nid)->update('history', array ('coment'=>$this->session->userdata('fio')));
					}else echo "er";
				break;
			}
		}else $this->index();
	}
	public function installation ($rank) {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			switch ($rank) {
				case 'installationClass':
					$mnoj = array (9=>1, 10=>2, 11=>3, 12=>4, 1=>5, 2=>6, 3=>7, 4=>8, 5=>9, 7=>10, 0=>4);
					$idclass=$this->input->post('idclass');
					$mont =$this->db->where('id_class', $idclass)->get('period')->row('mont');
					if (!isset($mont)) {
						$d=date("Y-m-d", strtotime('-1 month'));
						$this->db->insert('period', array('id_class'=>$idclass, 'mont'=>$d));
					}
					$query = $this->db->select('schoolboy.*, lgota.stake')->from('schoolboy')->where('id_class', $idclass)->join('lgota', 'lgota.id = schoolboy.id_lgota')->get();
					$m=date("m")-1;
					$data=array();
					foreach ($query->result() as $row)
					{
						$temp = array (
							'id_boy'=>$row->id,
							'plan'=>$row->stake*$mnoj[$m],
							'fact'=>$row->stake*$mnoj[$m],
							'class_id'=>$idclass
						);
						$data[]=$temp;
					}
					echo $this->db->insert_batch('contribution', $data);
					$idclass=$this->session->userdata('id_class');
					$query=$this->db->select('id')->where('id_catinv',1)->get('invoice');
					foreach ($query->result() as $row){
						$datah = array(
						   'id_inv' =>  $row->id,
						   'id_class' => $idclass
						);
						$this->db->insert('invoiceclass', $datah);
					}
					
				break;
				case 'installationBoy':
					
				break;
				case 'nextmonthgo':
					$this->load->model('CountSumm_model');
					$fag=true;
					$idclass=$this->input->post('idclass');
					$mont=$this->db->where('id_class', $idclass)->get('period')->row('mont');
					$qinv=$this->db->where('id_class', $idclass)->get('invoiceclass');
					$box="";
					$Rp=$this->db->where('id_class', $idclass)->get('period')->row('mont');
					$retained_money=$this->CountSumm_model->getRetainedMoney ($idclass,$Rp)-$this->CountSumm_model->getOverpayment ($idclass);
					foreach ($qinv->result() as $inv){
						if (!$this->db->where('id_class', $idclass)->where('period',$mont)->where('id_inv', $inv->id_inv)->get('history')->row()) 
							 $fag=false;	
					}
					if ($fag) {
						if ($retained_money == 0) {
							$d=date("Y-m-d");
							$this->db->where('id_class',$idclass)->update('period',  array( 'mont'=>$d));
							$query = $this->db->select('schoolboy.*, lgota.stake')->from('schoolboy')->where('id_class', $idclass)->join('lgota', 'lgota.id = schoolboy.id_lgota')->get();
							$data=array();
							foreach ($query->result() as $row)
							{
								$this->db->set('plan', "plan+$row->stake",false)->where('id_boy',$row->id)->update('contribution');
							}
							echo true;
						}else echo "money";
					}else echo "nothis";
				break;
			}
		}else $this->index();
	}
	public function distribution ($rank) {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			switch ($rank) {
				case 'topayview':
					$Ri=$this->db->where('id', $this->input->post('idinv'))->get('invoice')->row();
					if ($Ri->summ==0) {
						$this->load->view('contenAjax/winneed');
					}else {
						$datac['retained_money'] =$this->input->post('retained_money');
						$datac['namei']=$Ri->namei;
						$datac['summ']=$Ri->summ;
						if ($datac['retained_money']<($Ri->summ))
							$this->load->view('contenAjax/topayview_n',$datac);
						else 
							$this->load->view('contenAjax/topayview_y',$datac);
					}
				break;
				case 'topaydo':
					$mont=$this->db->where('id_class', $this->session->userdata('id_class'))->get('period')->row('mont');
					$Ri=$this->db->where('id', $this->input->post('idinv'))->get('invoice')->row();
					$datah = array(
					   'd' => 'NOW()',
					   'sr' => $Ri->summ,
					   'id_inv' =>  $this->input->post('idinv'),
					   'period' => "ADDDATE('$mont', INTERVAL 1 MINUTE)",
					   'id_class' => $this->session->userdata('id_class')
					);
					if ($Ri->id_catinv > 2 && $Ri->id_catinv < 6) {
						$oldsumm= $this->db->where('id_inv',$this->input->post('idinv'))->where('id_class', $this->session->userdata('id_class'))->get('funded')->row('summ');
						$savesumm=$oldsumm+$Ri->summ;
						$data = array(
						   'summ' => $savesumm
						);
						 $this->db->where('id_inv',$this->input->post('idinv'))->where('id_class', $this->session->userdata('id_class'))->update('funded', $data);
					}
					echo  $this->db->insert('history', $datah, false); 
						//запись кометария
							$nid=$this->db->insert_id();
							$this->db->where('id',$nid)->update('history', array ('coment'=>"начисление. провел: ".$this->session->userdata('fio')));
				break;
				case 'needfunded':
					$mont=$this->db->where('id_class', $this->session->userdata('id_class'))->get('period')->row('mont');
					$Ri=$this->db->where('id', $this->input->post('idinv'))->get('invoice')->row();
					$datah = array(
					   'd' => 'NOW()',
					   'sr' => $this->input->post('cash'),
					   'id_inv' =>  $this->input->post('idinv'),
					   'period' => "ADDDATE('$mont', INTERVAL 1 MINUTE)",
					   'id_class' => $this->session->userdata('id_class')
					);
					if ($Ri->id_catinv > 2 && $Ri->id_catinv < 6) {
						$oldsumm= $this->db->where('id_inv',$this->input->post('idinv'))->where('id_class', $this->session->userdata('id_class'))->get('funded')->row('summ');
						$savesumm=$oldsumm+$this->input->post('cash');
						$data = array(
						   'summ' => $savesumm
						);
						 $this->db->where('id_inv',$this->input->post('idinv'))->where('id_class', $this->session->userdata('id_class'))->update('funded', $data);
					}
					echo  $this->db->insert('history', $datah, false); 
						//запись кометария
							$nid=$this->db->insert_id();
							$this->db->where('id',$nid)->update('history', array ('coment'=>"начисление. провел: ".$this->session->userdata('fio')));
				break;
				case 'needcurrent':
					$mont=$this->db->where('id_class', $this->session->userdata('id_class'))->get('period')->row('mont');
					$datah = array(
					   'd' => 'NOW()',
					   'sp' => $this->input->post('cash'),
					   'id_inv' =>  $this->input->post('idinv'),
					   'period' => "ADDDATE('$mont', INTERVAL 1 MINUTE)",
					   'id_class' => $this->session->userdata('id_class')
					); 
						$oldsumm= $this->db->where('id_inv',$this->input->post('idinv'))->where('id_class', $this->session->userdata('id_class'))->get('current')->row('summ');
						$savesumm=$oldsumm+$this->input->post('cash');
						$data = array(
						   'summ' => $savesumm
						);
						 $this->db->where('id_inv',$this->input->post('idinv'))->where('id_class', $this->session->userdata('id_class'))->update('current', $data);
					echo  $this->db->insert('history', $datah, false); 
							//запись кометария
							$nid=$this->db->insert_id();
							$this->db->where('id',$nid)->update('history', array ('coment'=>"начисление. провел: ". $this->session->userdata('fio')));
				break;
			}
		}else $this->index();
	}
	public function setinginv ($rank) {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			switch ($rank) {
				case 'setinvclassout':
					$idclass=$this->session->userdata('id_class');
					$idinv=$this->input->post('id');
					$mont=$this->db->where('id_class', $idclass)->get('period')->row('mont');
					if (!$this->db->where('id_inv', $idinv)->where('period',$mont)->where('id_class', $idclass)->get('history')->row())
						echo $this->db->where('id_inv', $idinv)->where('id_class', $idclass)->delete('invoiceclass');
					else echo "stophis";
				break;
				case 'setinvclassoin':
					$datah = array(
					   'id_inv' =>  $this->input->post('id'),
					   'id_class' => $this->session->userdata('id_class')
					);
					echo  $this->db->insert('invoiceclass', $datah);
					$Ri=$this->db->where('id', $this->input->post('id'))->get('invoice')->row();
					if ($Ri->id_catinv > 2 && $Ri->id_catinv < 6) {
						if ($Ri->summ==0) {
							if (!$this->db->where('id_inv', $this->input->post('id'))->where('id_class', $this->session->userdata('id_class'))->get('current')->row()) {
								$dataf = array(
								   'id_inv' =>  $this->input->post('id'),
								   'id_class' =>  $this->session->userdata('id_class'),
								   'summ' =>  0
								);
								$this->db->insert('current', $dataf);
							}
						}
						if (!$this->db->where('id_inv', $this->input->post('id'))->where('id_class', $this->session->userdata('id_class'))->get('funded')->row()) {
							$dataf = array(
							   'id_inv' =>  $this->input->post('id'),
							   'id_class' =>  $this->session->userdata('id_class'),
							   'summ' =>  0
							);
							$this->db->insert('funded', $dataf);
						}
					}
				break;
				case 'viewnewinvoice':
					$query=$this->db->order_by('id')->get('categoryinv');
					foreach ($query->result() as $r){
						$datac['color'][$r->id]=$r->color;
						$datac['namecat'][$r->id]=$r->namecat;
					}
					$this->load->view('contenAjax/viewnewinvoice',$datac);
				break;
				case 'colorarray' :
					$query=$this->db->order_by('id')->get('categoryinv');
					foreach ($query->result() as $r){
						$colar[$r->id]=$r->color;
					 }
					 echo json_encode($colar);
				break;
				case 'savenewinvoice' :
					$datah = array(
					   'namei' =>  $this->input->post('namei'),
					   'disclosure' =>  $this->input->post('disclosure'),
					   'summ' =>  $this->input->post('summ'),
					   'id_catinv' =>  $this->input->post('selectVal')
					);
					echo  $this->db->insert('invoice', $datah);
				break;
			}
		}else $this->index();
	}
	public function invoice ($rank) {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			switch ($rank) {
				case 'abate':
					$idinv=$this->input->post('idinv');
					$datac['namei'] = $this->db->where('id', $idinv)->get('invoice')->row('namei');
					$this->load->view('contenAjax/abate',$datac);
				break;
				case 'saveabate':
					$summ=$this->input->post('summ');
					$d=date("Y-m-d H:i:s");
					$dataht = array(
					  'id_class' => $this->session->userdata('id_class'),
					   'id_inv' => $this->input->post('idinv'),
					   'writeoff' => $summ,
					   'd' => $d,
					   'comment' =>  $this->input->post('comm')
					);
					$this->db->insert('historyinvoice', $dataht);  
					echo  $d;
					$this->db->set('summ', "summ-$summ", false)->where('id', $this->input->post('idf'))->update('funded');
				break;
				case 'viewtaboutgo':
					$idinv=$this->input->post('idinv');
					$idfun=$this->input->post('idfun');
					$idclass=$this->session->userdata('id_class');
					$query=$this->db
						->where('id_class', $idclass)
						->where('id_inv', $idinv)
						->order_by('d','DESC')
						->get('historyinvoice');
					$datac="";
					foreach ($query->result() as $r)
					{
						$datac['summ'][$r->d]=$r->writeoff;
						$datac['comment'][$r->d]=$r->comment;
					}
					if ($datac)	{
						$datac['fClick']="viewtabingo ($idinv,$idfun)";
						$datac['expenseIncome']="Расход";
						$this->load->view('contenAjax/buttonExpenseIncome',$datac);
						$this->load->view('contenAjax/viewtaboutgo',$datac);
					}
						
					else{
						$datac['fClick']="viewtabingo ($idinv,$idfun)";
						$datac['expenseIncome']="Расход";
						$this->load->view('contenAjax/buttonExpenseIncome',$datac);
						$this->load->view('contenAjax/nodata',$datac);
					}
				break;
				case 'viewtabingo':
					$idinv=$this->input->post('idinv');
					$idfun=$this->input->post('idfun');
					$idclass=$this->session->userdata('id_class');
					$query=$this->db
						->where('id_class', $idclass)
						->where('id_inv', $idinv)
						->where('sr <>', 0)
						->order_by('d','DESC')
						->get('history');
					$datac="";
					foreach ($query->result() as $r)
					{
						$datac['summ'][$r->d]=$r->sr;
						$datac['comment'][$r->d]=$r->coment;
					}
					if ($datac)	{
						$datac['fClick']="viewtaboutgo ($idinv,$idfun)";
						$datac['expenseIncome']="Доход";
						$this->load->view('contenAjax/buttonExpenseIncome',$datac);
						$this->load->view('contenAjax/viewtaboutgo',$datac);
					}
						
					else{
						$datac['fClick']="viewtaboutgo ($idinv,$idfun)";
						$datac['expenseIncome']="Доход";
						$this->load->view('contenAjax/buttonExpenseIncome',$datac);
						$this->load->view('contenAjax/nodata',$datac);
					}
					
				break;
			}
		}else $this->index();
	}
	public function current ($rank) {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			switch ($rank) {
				case 'viewtabout':
					$mont=$this->db->where('id_class', $this->session->userdata('id_class'))->get('period')->row('mont');
					$tm=date("n",strtotime($mont));
					$pm=$this->input->post('m');
					$fio=$this->session->userdata('fio');
					$idclass=$this->session->userdata('id_class');
					$query=$this->db
						->where('id_class', $idclass)
						->where('MONTH(period)', $pm)
						->order_by('d','DESC')
						->get('historyinvoicecurrent',false);
					$datac['fl']=0;
					foreach ($query->result() as $r)
					{   $datac['fl']++;
						$datac['summ'][$r->d]=$r->writeoff;
						$datac['comment'][$r->d]=$r->comment;
					}
					$datac['f']=false; if ($tm==$pm) $datac['f']=true;
					$datac['pm']=$pm;
					$datac['cominbox']=true;
					if ($datac['fl']==0) {$datac['summ'][0]=""; $datac['comment'][0]="";}
					$this->load->view('contenAjax/viewtabout',$datac);
				break;
				case 'viewtabin':
					$pm=$this->input->post('m');
					$fio=$this->session->userdata('fio');
					$idclass=$this->session->userdata('id_class');
					$query=$this->db
						->where('id_class', $idclass)
						->where('sp >', 0)
						->where('id_boy', 0)
						->order_by('d','DESC')
						->get('history',false);
					$datac['fl']=0;
					foreach ($query->result() as $r)
					{   $datac['fl']++;
						$datac['summ'][$r->d]=$r->sp;
						$datac['comment'][$r->d]=$r->coment;
					}
					$datac['f']=false;
					$datac['pm']=$pm;
					$datac['cominbox']=false;
					if ($datac['fl']==0) {$datac['summ'][0]=""; $datac['comment'][0]="";}
					$this->load->view('contenAjax/viewtabout',$datac);
				break;
				case 'saveneed':
					$summ=$this->input->post('summ');
					$idclass=$this->session->userdata('id_class');
					$idinv=$this->db->where('id_class', $idclass)->get('current')->row('id_inv');
					$mont=$this->db->where('id_class', $this->session->userdata('id_class'))->get('period')->row('mont');
					$this->db->set('summ', "summ-$summ", false)->where('id_class', $idclass)->update('current');
					$d=date("Y-m-d H:i:s");
					$dataht = array(
					  'id_class' => $idclass,
					   'id_inv' => $idinv,
					   'writeoff' => $summ,
					   'd' => $d,
					   'comment' =>  $this->input->post('comm'),
					   'period' => $mont
					);
					echo $this->db->insert('historyinvoicecurrent', $dataht);  
				break;
			}
		}else $this->index();
	}
}

// шаблон функции с зашитой ajax
/*
	public function name ($rank) {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			switch ($rank) {
				case 'name':
					
				break;
			}
		}else $this->index();
	}
*/
?>