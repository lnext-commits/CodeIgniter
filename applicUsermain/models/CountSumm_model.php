<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CountSumm_model extends CI_Model 
{
	public function getProcConrtibution($idclass) {
		$smp=$this->getSummPlan ($idclass);
		$smf=$this->getSummFact ($idclass);
		$rezult=($smp-$smf)*100/$smp;
		$rezult=round ($rezult);
		if ($rezult<0) $rezult="<span style='color:red'>$rezult</span>";
		return $rezult;
	}
	public function getSummupConrtibution($idclass) {
		$smp=$this->getSummPlan ($idclass);
		$smf=$this->getSummFact ($idclass);
		return $smp-$smf;
	}
	public function getSummInvCatOverall ($idinvcat) {
		$Rsum=$this->db
			->select_sum('summ')
			->join('invoice','invoice.id=invoiceclass.id_inv')
			->where('invoice.id_catinv',$idinvcat)
			->where('id_class',$this->session->userdata('id_class'))
			->get('invoiceclass')->row();
		return $Rsum->summ;
	}
	public function getSummInvCatHistori ($idinvcat,$period) {
		$Rsum=$this->db
			->select_sum('sr')
			->where('invoice.id_catinv',$idinvcat)
			->where('history.period', $period)
			->where('history.id_class',$this->session->userdata('id_class'))
			->join('history','history.id_inv=invoice.id','left')
			->get('invoice')->row();
		return $Rsum->sr;
	}
	public function getRetainedMoney ($idclass,$period) {
		$recd=$this->getSummPlan($idclass)-$this->getSummFact($idclass);
		$paid_out=$this->db
			->select_sum('sr')
			->select_sum('sp')
			->where('history.id_class',$this->session->userdata('id_class'))
			->where('period', $period)
			->join('history','history.id_inv=invoice.id','left')
			->get('invoice')->row();
		return $recd-($paid_out->sr+$paid_out->sp);
	}
	public function getSummComingCurrent (){
		$SummComingCurren=$this->db
			->select_sum('sp')
			->where('history.id_class',$this->session->userdata('id_class'))
			->where('sp >', 0)
			->where('id_boy', 0)
			->get('history')->row();
		return $SummComingCurren->sp;
	}
	public function getOverpayment ($idclass)
	{
		$q=$this->db->where('class_id',$idclass)->get('contribution');
		$sum=0;
		foreach ($q->result() as $r)
		{
			$raz=$r->fact - $r->plan;
			if ($raz > 0) $sum+=$raz;
		}
		return $sum;
	}
	/*private*/
	private function getSummFact ($idclass) {
		$Rsump=$this->db->select_sum('plan')->where('class_id', $idclass)->get('contribution')->row();
		$Rsumf=$this->db->select_sum('fact')->where('class_id', $idclass)->get('contribution')->row();
		return $Rsump->plan-$Rsumf->fact;
	}
	 private function getSummPlan ($idclass) {
		$Rsump=$this->db->select_sum('stake')->where('id_class', $idclass)->join('lgota', 'lgota.id = schoolboy.id_lgota')->get('schoolboy')->row();
		return $Rsump->stake;
	}
}

?>