<?php defined('BASEPATH') OR exit('No direct script access allowed');

class indexPage extends CI_Controller {
	public function index()
	{	$this->load->model('passuser_model');
		if($this->session->has_userdata('tip')){
			$stat=$this->session->userdata('tip');
			if ($stat!='finadmin'){
				 header("Location: /main");
			}
			if ($stat=='finadmin'){
				 header("Location: /amain");
			}
		}else{
			if (isset($_POST['key'])){
                $password = htmlspecialchars($_POST['key']);
				if ($this->passuser_model->authorization($password)) $this->passuser_model->reboot_page();
				else $this->passuser_model->reboot_page(); //$data['tets'].="<script>errorlogin()</script>";
			}

		}
			$data['title']="вольдорф Фин 94";
			$data['content']="";
			$this->load->view('head/headIn',$data);
			$this->load->view('conten/contenIn',$data);
			$this->load->view('footer/footerIn');
	
	}
}
?>