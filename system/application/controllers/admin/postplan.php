<?php

Class Postplan extends Controller{
	
	function Postplan(){
		parent::Controller();
		
	}
	
	function index(){
		//security check 
		$this->freakauth_light->check('admin');
		
		//load necessary models and libraries
		$this->load->model('postplanmodel');
		$this->load->library('validation');
		
		//set rules for falidation
		$rules['packet'] = 'required';
		$rules['time'] = 'required';
		$rules['idletimeout'] = 'required';
		$this->validation->set_rules($rules);
		
		//get price for /byte and /minute 
		$data['packet'] = $this->postplanmodel->getPerByte();
		$data['time'] = $this->postplanmodel->getPerMinute();
		$data['idletimeout'] = $this->postplanmodel->getIdleTimeout();
		$data['bw_download'] = $this->postplanmodel->getDownloadRate();
		$data['bw_upload'] = $this->postplanmodel->getUploadRate();
		
		//set page information
		$data['title'] = 'Postpaid Setting';
		$data['action'] = 'Postpaid Setting';
		$data['notice'] ='';
		$this->load->vars($data);
		
		
		if($this->validation->run() == FALSE)
		{
			$this->load->view('admin/postplan/postplan_view');
		}
		else
		{
			$this->postplanmodel->save();
			$data['notice'] = 'Postpaid Settings Saved !';
			$this->load->view('admin/postplan/postplan_view',$data);
		}
		
	}
}