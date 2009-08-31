<?php

Class Chillispot extends Controller {
	
	function Chillispot(){
		parent::Controller();
		
		//Check admin
		$this->freakauth_light->check('admin');
		
		//load Chillispot library
		$this->load->library('easyhotspot_chillispot');

	}
	
	function index(){
		$this->load->library('validation');
		
		$data['action'] = "Internal captive portal management";
		$data['chilli_configuration'] = $this->easyhotspot_chillispot->get_configuration();
				
		$rules['radiusserver1'] = 'required';
		$rules['radiusserver2'] = 'required';
		$rules['radiussecret'] = 'required';
		$rules['dhcpif'] = 'required';
		$rules['uamserver'] = 'required';
		$rules['uamhomepage'] = 'required';
		$rules['uamsecret'] = 'required';
		$rules['uamallowed'] = 'required';
		$rules['net'] = 'required';
		
		$this->validation->set_rules($rules);
		
		if($this->validation->run() == FALSE)
		{
			$this->load->vars($data);
			$this->load->view('admin/chilli/chilli_view');
		}
		else
		{
			$this->easyhotspot_chillispot->set_configuration($_POST);
			flashMsg('Configuration Saved');
			redirect('admin/chillispot','location');
		}
	}
}

?>