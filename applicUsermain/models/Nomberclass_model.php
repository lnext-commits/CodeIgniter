<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Nomberclass_model extends CI_Model 
{
    public function getNomberClass($sy){   
		$m=date('m');
		$y=date('Y');
		$nc=$y-$sy;
		if ($m>7) $nc++;
		return $nc;
    }
	public function getInfoMonth($mtek){   
		$mru=array('','Январь','Фефраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь');
		$m=date("n",strtotime($mtek));
		return $mru[$m];
    }
}
