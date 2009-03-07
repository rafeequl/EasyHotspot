<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FreakAuth_light Class to handle the front controller
 * this class make code more reusable and it makes easier to
 * integrate Freakauth_light in your on templating system
 *
 * The class requires the use of
 *
 * => Database CI official library
 * => Db_session library (included in the download)
 * => FAL_validation library (included in the download)
 * => Freakauth_light library (included in the download)
 * => URL, FORM and FreakAuth_light (included in the download) helpers
 *
 * -----------------------------------------------------------------------------
 * Copyright (C) 2007  Daniel Vecchiato (4webby.com)
 * -----------------------------------------------------------------------------
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301  USA
 *------------------------------------------------------------------------------
 * @package     FreakAuth_light
 * @subpackage  Libraries
 * @category    Authentication
 * @author      Daniel Vecchiato (danfreak) & Christophe Gragnic (grahack)
 * @copyright   Copyright (c) 2007, 4webby.com
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @link 		http://4webby.com/freakauth
 * @version 	1.1
 *
 */
class Fal_front
{
	// --------------------------------------------------------------------
	/**
	 * class constructor
	 *
	 * @return Fal_front
	 */
	function Fal_front()
	{
		$this->CI = &get_instance();
		//loads necessary libraries
        $this->CI->lang->load('freakauth');
        $this->CI->load->model('Usermodel');
	    if ($this->CI->config->item('FAL_use_country'))
            $this->CI->load->model('country', 'country_model');
        //lets load the validation class if it hasn't been already loaded
        //it is needed by the FAL_validation library
        if (!class_exists('CI_Validation'))
		{
		     $this->CI->load->library('validation');
		}
		//let's load the FAL_validation library if it isn't already loaded
		if (!class_exists('FAL_validation'))
		{
		     $this->CI->load->library('FAL_validation');
		}
		
		//let's load the Freakauth_light library if it isn't already loaded
		//or autoloaded
		if (!class_exists('Freakauth_light'))
		{
		     $this->CI->load->library('Freakauth_light', 'freakauth_light');
		}
       
		//let's check if we have core classes extensions, and if we have them
		//let's load them
    	if ($this->CI->config->item('FAL_use_extensions'))
    	{
    	    $this->_loadExtensions();
    	}
    	else
    	{
    	    log_message('debug', 'FAL not using extensions');
    	}
       
		$this->CI->fal_validation->set_error_delimiters($this->CI->config->item('FAL_error_delimiter_open'), $this->CI->config->item('FAL_error_delimiter_close'));
       
    }
    
    // --------------------------------------------------------------------
    /**
     * FAL extensions handler.
     * It makes easier to load extensions to the classes in 
     * (libraries/FreakAuth_light.php) or the FAL_validation.php class build
     *  your files according to the following specifications about file-names.
     *  You can place them either in system/libraries or in application/libraries
     * 
     * - libraries/MyFAL.php
     * - libraries/MyFALVal.php
     * 
     * Following this convention, if $config['FAL_use_extensions'] = TRUE;
     * the above files will be loaded 
     */
    function _loadExtensions()
    {
  
        if (file_exists(APPPATH.'libraries/MyFAL'.EXT) OR file_exists(BASEPATH.'libraries/MyFAL'.EXT))
        {
            //let's load the core library (i.e. FreakAuth_light.php) extension
            $this->CI->load->library('MyFAL');
            
            $this->CI->freakauth_light = new MyFAL();
            log_message('debug', 'MyFAL library loaded');
            log_message('debug', 'MyFAL class assigned to $this->CI->freakauth_light');
        }
        else
        {
            log_message('debug', 'MyFAL class not found');
        }

        if (file_exists(APPPATH.'libraries/MyFALVal'.EXT) OR file_exists(BASEPATH.'libraries/MyFALVal'.EXT))
        {
            //let's load the validation library (i.e. FAL_validation.php) extension
            //and assign it to $this->CI->fal_validation
            $this->CI->load->library('MyFALVal');
            $this->CI->fal_validation = new MyFALVal();

        }
        else
        {
            log_message('debug', 'MyFALVal class not found');
        }
    }
	
    // --------------------------------------------------------------------

    /**
     * Displays the login form.
     * -------------------------
     * Usage:
     * -------------------------
     * //load the library in your controller
     * $this->load->library('FAL_front', 'fal_front');
     *
     * $data['fal'] = $this->fal_front->login();  // <--assign it to a variable
     * $this->load->view('your_view', $data);  // <--pass it to your view
     *
     * * -------------------------
     * Try also
     * echo $this->fal_front->login();
     * -------------------------
     * Alternatively, You can also use the helper function displayLoginForm()
     *
     * @return the login form view HTML output
     */
    function login()
    {	
        //if a valid user is already logged in
        if($this->CI->freakauth_light->belongsToGroup('user'))
        {
            // we can arrive here after two different things
            $requested_page = $this->CI->db_session->flashdata('requested_page');
            if ( $requested_page == '')
            {
                // a simple click on the login link
                // Display user name and an 'already logged in' flash message...
                $msg = $this->CI->freakauth_light->getUserName().', '.$this->CI->lang->line('FAL_already_logged_in_msg');
            }
            else
            {
                // a lack of credentials after being redirected by the
                // 'redirect to requested page' process
                // (after a successful login that followed a denied access)
                $msg = $this->CI->lang->line('FAL_no_credentials_user');
            }
            flashMsg($msg);
   
            // redirects to homepage
            redirect('', 'location');
        }
        else
        {
            //sets the necessary form fields
            $fields['user_name'] = $this->CI->lang->line('FAL_user_name_label');
            $fields['password'] = $this->CI->lang->line('FAL_user_password_label');
           
           
            $rules['user_name'] = $this->CI->config->item('FAL_user_name_field_validation_login');
            $rules['password'] = $this->CI->config->item('FAL_user_password_field_validation_login');
           
            //do we want chaptcha for login?
            if ($this->CI->config->item('FAL_use_captcha_login'))
            {
                $fields['security'] = $this->CI->lang->line('FAL_captcha_label');
                $rules['security'] = $this->CI->config->item('FAL_user_captcha_field_validation');
            }
           
            //-----------------------------------------------
            //ADD MORE FIELDS AND RULES HERE IF YOU NEED THEM
            //-----------------------------------------------
            
            $this->CI->fal_validation->set_fields($fields);
            $this->CI->fal_validation->set_rules($rules);
           
            //let's run the individual validation of username and password
            $validation_response = $this->CI->fal_validation->run();
           
            //if you change the keys of the validation rules
            //remember to adjust the following 2 lines
            //i.e. change $this->CI->fal_validation->user_name to $this->CI->fal_validation->your_user_name_key
            $username_login = $this->CI->fal_validation->user_name;
            $password_login = $this->CI->fal_validation->password;
           
            //everything went ok, let's log the user in and redirect him to the homepage
            if (
                $validation_response==TRUE
                && $this->CI->fal_validation->login_check($username_login, $password_login)
                && $this->CI->freakauth_light->login()
                )
            {
                // Here is the 'redirect to requested page after login' thing.
                // We test if the visitor was denied and sent to the login form.
                $requested_page = $this->CI->db_session->flashdata('requested_page');
                if ( $requested_page != '' )
                {
                    // We have to keep the page info once again in case of
                    // the user is still denied on the requested page.
                    // (otherwise the 'already logged in' message is displayed)
                    $this->CI->db_session->set_flashdata('requested_page', $requested_page);
                    redirect( $requested_page, 'location');
                }
                
                // if no page was requested before, let's redirect the user
                // according to his role
                $role = $this->CI->db_session->userdata('role');
                switch ($role)
                {
                    case ('superadmin'):
                    case ('admin'):
                        // On success redirect admin to default page
                        redirect($this->CI->config->item('FAL_admin_login_success_action'), 'location');
                        //redirect('home','location');
                        break;
                       
                    default:
                        // On success redirect user to default page
                         redirect($this->CI->config->item('FAL_login_success_action'), 'location');
                        //redirect('home','location');
                        break;
                }
            }
           
            // else display the login form (for the first time or once again)
            else
            {
                // keep the page that was requested for the next login attempt
                $this->CI->db_session->keep_flashdata('requested_page');
                
                if ($this->CI->config->item('FAL_use_captcha_login'))
                {	
                    $action='_login';
                    $this->CI->freakauth_light->captcha_init($action);
                    $data['captcha'] = $this->CI->config->item('FAL_captcha_image');
                }
               
                $data['heading'] = $this->CI->lang->line('FAL_login_label');
                return $this->CI->load->view($this->CI->config->item('FAL_login_view'), $data, TRUE);
               
                //$this->CI->output->enable_profiler(TRUE);
            }
        }
    }

    // --------------------------------------------------------------------
   
    /**
     * Handles the logout action.
     *
     */
    function logout()
    {
        $this->CI->freakauth_light->logout();
    }
   
	// --------------------------------------------------------------------
	
    /**
     * Displays the registration form.
     * -------------------------
     * Usage:
     * -------------------------
     * //load the library in your controller
     * $this->load->library('FAL_front', 'fal_front');
     *
     * $data['fal'] = $this->fal_front->register();  // <--assign it to a variable
     * $this->load->view('your_view', $data);  // <--pass it to your view
     *
     * -------------------------
     * Try also
     * echo $this->fal_front->register();
     * -------------------------
     * Alternatively, You can also use the helper function displayRegistrationForm()
     *
     * @return the registration form view HTML output
     */
    function register()
    {	
    	//if users are not allowed to register
        if (!$this->CI->config->item('FAL_allow_user_registration'))
        {
        	redirect('', 'location');
        }
        //if they are allowed to register
        else
        {
            //sets the necessary form fields
            $fields['user_name'] = $this->CI->lang->line('FAL_user_name_label');
            $fields['password'] = $this->CI->lang->line('FAL_user_password_label');
            $fields['password_confirm'] = $this->CI->lang->line('FAL_user_password_confirm_label');
            $fields['email'] = $this->CI->lang->line('FAL_user_email_label');
           
            //set validation rules
            $rules['user_name'] = $this->CI->config->item('FAL_user_name_field_validation_register');
            $rules['password'] = $this->CI->config->item('FAL_user_password_field_validation_register');
            $rules['password_confirm'] = $this->CI->config->item('FAL_password_required_confirm_validation')."|matches[".'password'."]";
            $rules['email'] = $this->CI->config->item('FAL_user_email_field_validation_register');
       
        //do we also want to know the user country?
        if ($this->CI->config->item('FAL_use_country'))
        {
            $fields['country_id'] = $this->CI->lang->line('FAL_user_country_label');
            $rules['country_id'] = $this->CI->config->item('FAL_user_country_field_validation_register');
        }
        //do we also want to secure the registration with CAPTCHA?
        if ($this->CI->config->item('FAL_use_captcha_register'))
        {
            $fields['security'] = $this->CI->lang->line('FAL_captcha_label');
        	$rules['security'] = $this->CI->config->item('FAL_user_captcha_field_validation');
        }
       
        //-----------------------------------------------
        //ADD MORE FIELDS AND RULES HERE IF YOU NEED THEM
        //-----------------------------------------------
        
        $this->CI->fal_validation->set_fields($fields);
        $this->CI->fal_validation->set_rules($rules);
       
        //if everything went ok 
        if ($this->CI->fal_validation->run() && $this->CI->freakauth_light->register())
        {
			$data['heading'] = $this->CI->lang->line('FAL_register_label');
			//normal registration with e-mail validation
			if (!$this->CI->config->item('FAL_register_direct'))
			{
			    return $this->CI->load->view($this->CI->config->item('FAL_register_success_view'), $data, TRUE);
			}
			//direct registration
			else
			{
			    redirect($this->CI->config->item('FAL_login_uri'), 'location');
			}
			//$this->CI->output->enable_profiler(TRUE);
        }
       
        //redisplay the register form
        else
        {	
        	//if we want to know the user country let's populate the select menu
	        if ($this->CI->config->item('FAL_use_country'))
	        {
	    		//SELECT * FROM country
	            $data['countries'] = $this->CI->country_model->getCountriesForSelect();
	        }
	        //if we want to secure the registration with CAPTCHA let's generate it
	        if ($this->CI->config->item('FAL_use_captcha_register'))
	        {	
	        	$action='_register';
	            $this->CI->freakauth_light->captcha_init($action);
	            $data['captcha'] = $this->CI->config->item('FAL_captcha_image');
	        }
		       
	        //displays the view
	        $data['heading'] = $this->CI->lang->line('FAL_register_label');
			return $this->CI->load->view($this->CI->config->item('FAL_register_view'), $data, TRUE);
			
			//$this->CI->output->enable_profiler(TRUE);
	        }
        }
    }
   
    // --------------------------------------------------------------------
   
    /**
     * Handles the user activation.
     * -------------------------
     * Usage:
     * -------------------------
     * //load the library in your controller
     * $this->load->library('FAL_front', 'fal_front');
     *
     * $data['fal'] = $this->fal_front->activation();  // <--assign it to a variable
     * $this->load->view('your_view', $data);  // <--pass it to your view
     *
     * -------------------------
     * Try also
     * echo $this->fal_front->activation();
     * -------------------------
     *
     * @return the activation view HTML output
     */
    function activation()
    {	
    	//passes the URI segments to freakauth-ligh [UserTemp id segment(3) and the activation code segment(4)]
    	//if the activation is successfull displays the success page
        if ($this->CI->freakauth_light->activation($this->CI->uri->segment(3, 0), $this->CI->uri->segment(4, '')))
        {
        	$data['heading'] = $this->CI->lang->line('FAL_activation_label');
        	return $this->CI->load->view($this->CI->config->item('FAL_register_activation_success_view'), $data, TRUE);
        }
        //if activation unsuccessfull redispaly the failure view message
        else
        {	
        	$data['heading'] = $this->CI->lang->line('FAL_activation_label');
        	return $this->CI->load->view($this->CI->config->item('FAL_register_activation_failed_view'), $data, TRUE);
        }
       
    }
   
	// --------------------------------------------------------------------
	
    /**
     * Handles the the forgotten password form.
     * -------------------------
     * Usage:
     * -------------------------
     * //load the library in your controller
     * $this->load->library('FAL_front', 'fal_front');
     *
     * $data['fal'] = $this->fal_front->forgotten_password();  // <--assign it to a variable
     * $this->load->view('your_view', $data);  // <--pass it to your view
     *
     * -------------------------
     * Try also
     * echo $this->fal_front->forgotten_password();
     * -------------------------
     *
     * @return the forgotten password view HTML output
     */
    function forgotten_password()
    {
        //sets the necessary form fields
        $fields['email'] = $this->CI->lang->line('FAL_user_email_label');
       
    	//set necessary validation rules
        $rules['email'] = $this->CI->config->item('FAL_user_email_field_validation_forgotten');
      	
        //do we also want CAPTCHA?
        if ($this->CI->config->item('FAL_use_captcha_forgot_password'))
        {
            $fields['security'] = $this->CI->lang->line('FAL_captcha_label');
            $rules['security'] = $this->CI->config->item('FAL_user_captcha_field_validation');
        }
       
        //-----------------------------------------------
        //ADD MORE FIELDS AND RULES HERE IF YOU NEED THEM
        //-----------------------------------------------
        
        $this->CI->fal_validation->set_fields($fields);
        $this->CI->fal_validation->set_rules($rules);
       
        //if it got post data and they validate display the success page
        if ($this->CI->fal_validation->run() && $this->CI->freakauth_light->forgotten_password())
        {        	
			return $this->CI->load->view($this->CI->config->item('FAL_forgotten_password_success_view'), null, TRUE);
        }
       
        //else display the initial forgotten password form
        else
        {
        	//do we want captcha
        	if ($this->CI->config->item('FAL_use_captcha_forgot_password'))
	        {
		        $action='_forgot_password';
            	$this->CI->freakauth_light->captcha_init($action);
		        $data['captcha'] = $this->CI->config->item('FAL_captcha_image');
	        }
           
	        //display the form
	        $data['heading'] = $this->CI->lang->line('FAL_forgotten_password_label');
			return $this->CI->load->view($this->CI->config->item('FAL_forgotten_password_view'), $data, TRUE);
        }
    }
   
	// --------------------------------------------------------------------
	
    /**
     * Displays the forgotten password reset.
     * -------------------------
     * Usage:
     * -------------------------
     * //load the library in your controller
     * $this->load->library('FAL_front', 'fal_front');
     *
     * $data['fal'] = $this->fal_front->forgotten_password_reset();  // <--assign it to a variable
     * $this->load->view('your_view', $data);  // <--pass it to your view
     *
     * -------------------------
     * Try also
     * echo $this->fal_front->forgotten_password_reset();
     * -------------------------
     *
     * @return the forgotten password reset view HTML output
     */
    function forgotten_password_reset()
    {	
    	//if password has been successfully reset (randomly generate, ins in DB and sent to the user)
    	//display success
        if ($this->CI->freakauth_light->forgotten_password_reset($this->CI->uri->segment(3, 0), $this->CI->uri->segment(4, '')))
        {
			return $this->CI->load->view($this->CI->config->item('FAL_forgotten_password_reset_success_view'), null, TRUE); 
        }
        //tell the user about the problems and display unsuccess view
        else
        {
			return $this->CI->load->view($this->CI->config->item('FAL_forgotten_password_reset_failed_view'), null, TRUE);          
        }
           
    }

   
    // --------------------------------------------------------------------
   
    /**
     * Function that handles the change password procedure
     * needed to let the user set the password he wants after the
     * forgotten_password_reset() procedure
     * Displays the forgotten password reset.
     * -------------------------
     * Usage:
     * -------------------------
     * //load the library in your controller
     * $this->load->library('FAL_front', 'fal_front');
     *
     * $data['fal'] = $this->fal_front->changepassword();  // <--assign it to a variable
     * $this->load->view('your_view', $data);  // <--pass it to your view
     *
     * -------------------------
     * Try also
     * echo $this->fal_front->changepassword();
     * -------------------------
     *
     * @return the change password view HTML output
     */
    function changepassword()
    {
        //sets the necessary form fields
        $fields['user_name'] = $this->CI->lang->line('FAL_user_name_label');
        $fields['old_password'] = $this->CI->lang->line('FAL_old_password_label');
        $fields['password'] = $this->CI->lang->line('FAL_new_password_label');
        $fields['password_confirm'] = $this->CI->lang->line('FAL_retype_new_password_label');
        $fields['security'] = $this->CI->lang->line('FAL_captcha_label');
       
       
        $rules['user_name'] = $this->CI->config->item('FAL_user_name_field_validation_login');
        //old password
        $rules['old_password'] = $this->CI->config->item('FAL_user_password_field_validation_login');
        //new password
        $rules['password'] = $this->CI->config->item('FAL_password_required_validation'); 
        //new password confirmation
        $rules['password_confirm'] = $this->CI->config->item('FAL_password_required_confirm_validation');
       
       
        //-----------------------------------------------
        //ADD MORE FIELDS AND RULES HERE IF YOU NEED THEM
        //-----------------------------------------------
        
        $this->CI->fal_validation->set_fields($fields);
        $this->CI->fal_validation->set_rules($rules);
       
        //if it got post data and they validate display the success page
        if ($this->CI->fal_validation->run() && $this->CI->freakauth_light->_change_password())
        {        	
        	//set FLASH MESSAGE
            $msg = $this->CI->lang->line('FAL_change_password_success');
            flashMsg($msg);
                       
			redirect('', 'location');
        }
       
        //else display the initial change password form
        else
        {	
			//page display
			$data['heading'] = $this->CI->lang->line('FAL_change_password_label');
			return $this->CI->load->view($this->CI->config->item('FAL_change_password_view'), $data, TRUE);
        }
    }
}