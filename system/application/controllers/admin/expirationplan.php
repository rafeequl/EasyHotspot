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
		
		
		$data['os'] = exec('uname -o');
		$data['hostname'] = exec('uname -n');
		$this->load->view('home/home_view',$data);
						 
		$this->load->vars($data);
	        
	    $this->load->view('admin/expirationplan/expirationplan_view');
        
    }
    

}
