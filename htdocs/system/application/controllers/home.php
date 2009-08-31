<?php

class Home extends Controller {
	
	function Home(){
		parent::Controller();
	
	}
	
	function index(){
		$this->freakauth_light->check('user');
		
		
		
		$data['title']=$this->lang->line('home');
		$data['h1']= $this->lang->line('welcome');
		
		$data['user'] = $this->db_session->userdata('user_name');
		
		$data['company_name'] = $this->config->item('company_name');
		$data['company_address_line1'] = $this->config->item('company_address_line1');
		$data['company_address_line2'] = $this->config->item('company_address_line2');
		$data['company_address_line3'] = $this->config->item('company_address_line3');
		$data['company_phone'] = $this->config->item('company_phone');
		$data['company_tax_code'] = $this->config->item('company_tax_code');
		
		$data['os'] = exec('uname -o');
		$data['hostname'] = exec('uname -n');
		$this->load->view('home/home_view',$data);
	}
}
