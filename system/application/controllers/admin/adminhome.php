<?php
/**
 * Auth Controller Class
 *
 * Security controller that provides functionality to handle logins, logout and registration
 * requests.  It also can verify the logged in status of a user and his permissions.
 *
 * The class requires the use of the DB_Session and FreakAuth libraries.
 *
 * @package     FreakAuth
 * @subpackage  Controllers
 * @category    Administration
 * @author      Daniel Vecchiato (danfreak)
 * @copyright   Copyright (c) 2007, 4webby.com
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @link 		http://4webby.com/freakauth
 * @version 	1.1
 *
 */

class AdminHome extends Controller
{	
	/**
	 * Initialises the controller
	 *
	 * @return Admin
	 */
    function AdminHome()
    {
        parent::Controller();
        
        ////////////////////////////
		//CHECKING FOR PERMISSIONS
		///////////////////////////
		//-------------------------------------------------
        //only 'admin' and 'superadmin' can manage users
        
        $this->freakauth_light->check('admin');
        
        //-------------------------------------------------
        //END CHECKING FOR PERMISSION
        
        $this->_container = $this->config->item('FAL_template_dir').'template_admin/container';
        
    }
	
    	// --------------------------------------------------------------------
	
    /**
     * Displays home page of Admin Console
     *
     */
    function index()
    {	   
    	$data['heading']='Admin Console home';
    	$data['action']='Welcome to the admin console';
        $data['content']="<p>Here You can  manage system configuration.</p>"
						 ."<p>Use the menu above to perform different management operations</p>";
        
		$data['title']='Home';
		$data['h1']='Welcome to EasyHotspot System';
		
		$data['user'] = $this->db_session->userdata('user_name');
		
		$data['company_name'] = $this->config->item('company_name');
		$data['company_address_line1'] = $this->config->item('company_address_line1');
		$data['company_address_line2'] = $this->config->item('company_address_line2');
		$data['company_address_line3'] = $this->config->item('company_address_line3');
		$data['company_phone'] = $this->config->item('company_phone');
		$data['company_tax_code'] = $this->config->item('company_tax_code');
		
		$data['os'] = exec('uname -o');
		$data['hostname'] = exec('uname -n');
		// Now some check ways of checking services are running without using init statu
		$data['chilli'] = exec('netstat -an | grep :3990 | grep tcp | grep -c LISTEN');
		$data['mysql'] = exec('netstat -an | grep :3306 | grep tcp | grep -c LISTEN');
		$data['radius1'] = exec('netstat -an | grep :1812 | grep -c udp');
		$data['radius2'] = exec('netstat -an | grep :1812 | grep -c udp');
		$data['radius3'] = exec('netstat -an | grep :1812 | grep -c udp');
		$data['coaport'] = exec('netstat -an | grep :3799 | grep -c udp');
		$this->load->view('home/home_view',$data);
						 
		$this->load->vars($data);
	        
	    $this->load->view('admin/admin_view');
        
    }
    

}
