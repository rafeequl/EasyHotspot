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
		$rules['valid_for']= 'required';
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
	
	/**
	 * Delete billing plan, defined by id on $this->uri->segment()
	 *
	 */
	function delete(){
		
		$this->db->query('delete billingplan,radusergroup,voucher,radcheck,radgroupreply,radgroupcheck from billingplan left join radusergroup on billingplan.name=radusergroup.groupname left join voucher on billingplan.name = voucher.billingplan left join radcheck on voucher.username = radcheck.username left join radgroupreply on radgroupreply.groupname = billingplan.name left join radgroupcheck on radgroupcheck.groupname = billingplan.name where billingplan.name =\''.$this->uri->segment(5).'\'');	
		
		redirect('admin/billingplan');

	}
}

?>
