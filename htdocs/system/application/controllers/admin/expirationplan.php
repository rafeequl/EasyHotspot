<?php

class ExpirationPlan extends Controller
{	
	/**
	 * Initialises the controller
	 *
	 * @return 
	 */
    function ExpirationPlan()
    {
        parent::Controller();
        
        ////////////////////////////
		//CHECKING FOR PERMISSIONS
		///////////////////////////
		//-------------------------------------------------
        //only 'admin' and 'superadmin' can manage expiration plans
        
        $this->freakauth_light->check('admin');
		$this->load->library('validation');
		$this->load->library('Easyhotspot_validation');
		$this->load->model('expirationplanmodel');
        
        //-------------------------------------------------
        //END CHECKING FOR PERMISSION
        
       // $this->_container = $this->config->item('FAL_template_dir').'template_admin/container';
        
    }
	
    	// --------------------------------------------------------------------
	
    /**
     * Displays Expiration Plans
     *
     */
    function index()
    {	   
		
    	$data['heading']='Admin Console home';
    	$data['action']='Expiration Plan';

        
		$data['title']='Expiration Plan';
		$data['h1']='Expiration Plan';
		
		$data['query'] = $this->expirationplanmodel->getExpirationPlan();		

				
		$rules['name']	= 'required|check_duplicate_billingplan';
		$rules['type']	= 'required';
		$rules['amount']= 'required';
		$rules['price']	= 'required';
		$rules['IdleTimeout'] = 'required';
		
		$this->easyhotspot_validation->set_rules($rules);
		
		if($this->easyhotspot_validation->run()==FALSE)
		{	
			$this->load->view('admin/expirationplan/expirationplan_view',$data);
		}
		else 
		{
			$this->expirationplanmodel->save();
			redirect('admin/expirationplan');
		}
        $this->output->enable_profiler(TRUE);
    }

	function delete(){
		$this->expirationplanmodel->deleteExpirationPlan();
		
		redirect('admin/expirationplan','location');
		
	}
    

}
