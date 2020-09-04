<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Passuser_model extends CI_Model 
{
    public function authorization($pass)
    {   
		$this->db->select('*');
		$this->db->from('person');
		$this->db->where('pass', $pass);
		$this->db->join('class_room', 'class_room.id = person.id_class','left');
		$this->db->join('tipPerson', 'tipPerson.id = person.id_tip');
        if ( $query = $this->db->get()) {
			$row = $query->row_array();
			$sess_data = [
                'fio' => $row['fio'],
                'tipname' => $row['namet'],
                'tip' => $row['tip'],
                'dost' => $row['dost'],
                'id_class' => $row['id_class'],
				'class_room' => $row['income_year']
            ];
			$this->session->set_userdata($sess_data);
			return true;
		}else return false;
        //$row = $query->row();
        //return $row->pass;
        //$query = $this->db->query("SELECT * FROM passuser WHERE login = '$usname'");   
    }
	 public function reboot_page(){
		header("Location: http://" .$_SERVER['SERVER_NAME']);
        die();
        exit();
    }
	public function exit_person(){
		$array_items = array('fio','tip','dost','class_room');
		$this->session->unset_userdata($array_items);
		header("Location: http://" .$_SERVER['SERVER_NAME']);
        die();
        exit();
    }

}
