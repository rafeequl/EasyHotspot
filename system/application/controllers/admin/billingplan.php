<?php

Class Billingplan extends Controller {
	
	function Bliingplan(){
		parent::Controller();
		
		//check permission
		
		
		//load Billingplanmodel
		
	}
	
	function index(){
		$this->freakauth_light->check('admin');
		
		$this->load->model('billingplanmodel');
		$this->load->library('validation');
		$this->load->library('Easyhotspot_validation');
		
		$data['action']='Billing Plan Management';
		$data['h1']='Billing Plan';
		
		$data['query'] = $this->billingplanmodel->getBillingPlan();		

				
		$rules['name']	= 'required|check_duplicate_billingplan';
		$rules['type']	= 'required';
		$rules['amount']= 'required';
		$rules['price']	= 'required';
		$rules['IdleTimeout'] = 'required';
		
		$this->easyhotspot_validation->set_rules($rules);
		
		if($this->easyhotspot_validation->run()==FALSE)
		{	
			$this->load->view('admin/billingplan/billingplan_view',$data);
		}
		else 
		{
			$this->billingplanmodel->addBillingPlan();
			redirect('admin/billingplan');
		}
		
		
	}
	
	function delete(){
		$this->freakauth_light->check('admin');
		
		$this->load->model('billingplanmodel');
		
		$this->billingplanmodel->deleteBillingPlan();
		
		redirect('admin/billingplan','location');
		
	}
}

?>