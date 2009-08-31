<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FreakAuth_light Class
 * Security handler that provides functionality to handle login, logout,
 * registration, and reset password requests.
 * It also can verify the logged in status of 3 user classes
 *
 * => superadmin (has permissions on everything and can also create other admin)
 * => admin      (you can choose what to let him manage)
 * => user       (it is a registered user, and you can decide to give in rights
 *               to access some specific areas (controllers) of your application
 *
 * The class requires the use of
 *
 * => Database CI official library
 * => Db_session, FAL_validation and the FAL_front library (included in the download)
 * => URL, FORM and FreakAuth_light (included in the download) helpers
 *
 * The FreakAuth_light library should be auto loaded in the core classes section
 * of the autoloader.
 *
 * Passwords are encripted with md5 algorithm by the method _encode($password)
 *
 * -----------------------------------------------------------------------------
 * Copyright (C) 2007  Daniel Vecchiato (4webby.com)
 * -----------------------------------------------------------------------------
 *This library is free software; you can redistribute it and/or
 *modify it under the terms of the GNU Lesser General Public
 *License as published by the Free Software Foundation; either
 *version 2.1 of the License, or (at your option) any later version.
 *
 *This library is distributed in the hope that it will be useful,
 *but WITHOUT ANY WARRANTY; without even the implied warranty of
 *MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 *Lesser General Public License for more details.
 *
 *You should have received a copy of the GNU Lesser General Public
 *License along with this library; if not, write to the Free Software
 *Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
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

// ------------------------------------------------------------------------

/**
 * Security handler that provides functionality to handle logins and logout
 * requests.  It also can verify the logged in status of a user and permissions.
 * The class requires the use of the Database and Encrypt CI libraries and the
 * URL, and CI helper.  It also requires the use of the 3rd party DB_Session
 * library.  The Auth library should be auto loaded in the core classes section
 * of the autoloader.
 *
 * Passwords are encripted with md5 algorithm.
 */
class Freakauth_light
{
    // --------------------------------------------------------------------
    
    /**
    * Function FreakAuth inizialises the class loading the right libraries,
    * helpers and models
    *
    * @uses libraries (encrypt, db_session)
    * @uses helpers (form, url, FreakAuth)
    * @uses modules (usermodel)
    */
    function Freakauth_light()
    {
        $this->CI=& get_instance();

        log_message('debug', "FreakAuth Class Initialized");

        $this->CI->load->library('db_session');
        $this->CI->load->helper('form');
        $this->CI->load->helper('url');
        $this->CI->load->helper('freakauth_light');
        $this->CI->load->model('FreakAuth_light/usertemp', 'UserTemp');
        $this->CI->load->model('usermodel', 'usermodel');
        if($this->CI->config->item('FAL_create_user_profile'))
            $this->CI->load->model('Userprofile', 'userprofile');

        $this->_init();
    }

    // --------------------------------------------------------------------
    
    /**
     * Initializes the security settings and checks for autologin
     *
     * @return boolean
     */
    function _init()
    {
        // checks if the Freakauth system is turned on
    	if (!$this->CI->config->item('FAL'))
    	{
			// preparing the message
			$this->CI->lang->load('freakauth');
			$website_name = $this->CI->config->item('FAL_website_name');
			$message = sprintf(
				$this->CI->lang->line('FAL_turned_off_message'),
				$website_name
			);
			$data['website_name'] = $website_name;
			$data['message'] = $message;
            echo $this->CI->load->view($this->CI->config->item('FAL_template_dir').'content/turned_off', $data, true);
            exit;
    	}

    }

    // --------------------------------------------------------------------
       
    /**
     * Method used to restrict access to controllers or methods of controllers
	 * to the specified category of users.
     * It requires 2 optional parameters:
     *  - the first parameter specifies the user group i.e. ('admin')
     *  - the second parameter specifies whether the area is reserved ONLY to
	 *    that group (true) or if it is accessible by groups higher in the
	 *    hierarchy
     *
     * example usage in a controller
     *
     * 1) $this->freakauth_light->check()
	 *    this restricts access to registered users and user-groups higher in
	 *    the hierarchy (i.e. admin, superadmin)
     * 2) $this->freakauth_light->check('admin')
	 *    this restricts access to 'admin' users and users who belong to roles
	 *    higher in the hierarchy (i.e. 'superadmin')
     * 3) $this->freakauth_light->check('admin', true)
	 *    this restricts access to 'admin' users ONLY
     *
     * @param string (the role to whom the area is restricted to) $lock_to_role
     * @param boolean (true/false) $only
     */
    function check($_lock_to_role=null, $_only=null)
    {

	        // check who did the request and build role hierarchy
	        $_who_is = $this->CI->db_session->userdata('role');
	        
	        // if we have a role stored in DB session for this user
	        if ($this->CI->db_session AND $this->CI->config->item('FAL') AND !empty($_who_is))
	        {
	            
	            // gets the locked role hierarchy value
	            $_hierarchy = $this->CI->config->item('FAL_roles');
	            
	            // if we didn't specify to who we will reserve the action
                // let's restrict it to registered users
	            if ($_lock_to_role==null){$_lock_to_role='user';}
	            
	            // let's see who did we reserve the area to
	            $_lock_hierarchy = $_hierarchy[$_lock_to_role];
	            // let's see who requested to access this area
	            $_request_hierarchy = $_hierarchy[$_who_is];

                // let's see if we decided to restrict access ONLY to a given category
	            switch ($_only)
	            {
	            	case true:
	            		$_request_hierarchy == $_lock_hierarchy ? $_condition = true : $_condition = false;
	            		break;
	            	
	            	// only false or not specified	
	            	default:
	            		$_request_hierarchy <= $_lock_hierarchy ? $_condition = true : $_condition = false;
	            		break;
	            		
	            }
	            
	            // if who did the request doesn't have enough credentials
	            if ($_condition==false)
	            {
	            	$this->denyAccess($_who_is);
	            }
	        }
	        // it means it is a guest because it has no role stored in DB_session
	        else
	        {
	            $this->denyAccess($_who_is);
	        }
    }

    // --------------------------------------------------------------------

    /**
     * Handles the case where the one who did the request
     * doesn't have enough credentials
     *
     * if FAL_deny_with_flash_message == true in config file, displays a flash
     * message and redirects to the referer page (or homepage if none)
     *
     * else displays the FAL_denied_page (see config file)
     * -------------------------------
     * EXAMPLE USAGE (in a controller)
     * -------------------------------
     * $this->freakauth_light->denyAccess('user')
     *
     * @param string the role of the one we are denying the access
     */
    function denyAccess($role)
    {
        $this->CI->lang->load('freakauth');
        if ($this->CI->config->item('FAL_deny_with_flash_message'))
        {
            // if visitor is a GUEST
            if ($role == '')
            {
                // First, we have to store the requested page in order
                // to serve it back to the visitor after a successful login.
                $this->CI->db_session->set_flashdata('requested_page',
                    $this->CI->uri->uri_string());
                
                // Then we redirect to the login form with a 'access denied'
                // message. Maybe if the visitor can log in,
                // he'll get some more permissions...
                $msg = $this->CI->lang->line('FAL_no_credentials_guest');
                flashMsg($msg);
                redirect($this->CI->config->item('FAL_login_uri'), 'location');
            }
            // else if visitor is a USER
            else
            {
                $msg = $this->CI->lang->line('FAL_no_credentials_user');
                flashMsg($msg);
                
                // if visitor came to this site with an http_referer
                if (isset($_SERVER['HTTP_REFERER']))
                {
                    $referer = $_SERVER['HTTP_REFERER'];
                    if (preg_match("|^".base_url()."|", $referer) == 0)
                    {
                        // if http_referer is from an external site,
                        // users are taken to the page defined in the config file
                        redirect($this->CI->config->item('FAL_denied_from_ext_location'));
                    }
                    else
                    {
                        // if we came from our website, just go to this page back
                        // but maybe we arrived here because of the
                        // 'redirect to requested page', so in order not to
                        $this->CI->db_session->keep_flashdata('requested_page');
                        header("location:".$_SERVER['HTTP_REFERER']);
                        exit();
                    }
                }
                // if visitor did not come to this site with an http_referer,
                // redirect to the page defined in the config file too
                else
                {
                    redirect($this->CI->config->item('FAL_denied_from_ext_location'), 'location');
                }
            }
        }
        else
        {
            $page = $this->CI->config->item('FAL_denied_page');
            $data['role'] = $role;
            // this is how we stop the execution
            echo $this->CI->load->view($page, $data, true);
            exit();
        }
    }
    
    
    
    // --------------------------------------------------------------------

    /**
     * Checks to see if a user is an administrator
     * uses Class Db_session method userdata
     * Returns false if FreakAuth system is not activated
     * Returns true if admin or superadmin, otherwise false
     *
     * @return true if admin/superadmin or false otherwise
     */
    function isAdmin()
    {

        if ($this->CI->db_session AND $this->CI->config->item('FAL'))
        {
            $_username = $this->CI->db_session->userdata('user_name');
            $_role = $this->CI->db_session->userdata('role');
            
            if ($_username != false && $_role != false AND ($_role=='admin' OR $_role=='superadmin'))
                
            	//returns the user id
            	return true;
        }
		
        // if user_id not activated or not existent
        return false;
    }

    // --------------------------------------------------------------------

    /**
     * Checks to see if an administrator has superadmin credentials
     * uses Class Db_session method userdata
     * Returns false if FreakAuth system is not activated
     * Returns true if superadmin, otherwise false
     *
     * @return boolean
     */
    function isSuperAdmin()
    {

        if ($this->CI->db_session AND $this->CI->config->item('FAL'))
        {
            $_username = $this->CI->db_session->userdata('user_name');
            $_role = $this->CI->db_session->userdata('role');
            
            if ($_username != false AND $_role != false AND $_role=='superadmin')
                
            	return true;
        }

        return false;
    }
    // --------------------------------------------------------------------
    
    /**
     * Checks to see if a user is logged in
     * Returns false if FreakAuth system is not activated
     * Returns true if a valid user is logged, false otherwise
     *
     * @return boolean
     */
    function isValidUser()
    {

        if ($this->CI->db_session AND $this->CI->config->item('FAL'))
        {
            if ($this->getUserName() != '')
            	return true;
        }

        // if user not activated or not existent
        return false;
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Method used to used to check if a logged in members belongs to the custom
     * role (group) specified in the first parameter.
     * It requires 2 optional parameters:
     *  - the first specifies the user roles as a comma separated string
     *  - the second specifies whether we want to check to the specified roles
     *    ONLY or for AT LEAST those group membership in the hierarchy
     *    (returns true also if the logged user belongs to a group higher
     *     in the hierarchy)
     *
     * example usage in a controller
     * (see the relative helper belongsToGroup() to use it in views)
     *
     * 1) $this->freakauth_light->belongsToGroup()
     *    returns true if the visitor is logged in and he is AT LEAST an user
     * 2) $this->freakauth_light->belongsToGroup('user,editor')
     *    returns true if the visitor is logged in and he is AT LEAST an user
     *    or an editor (therefore it returns true also if he belongs to
     *    user-groups higher in the hierarchy (i.e. superadmin)
     * 3) $this->freakauth_light->belongsToGroup('admin', true)
     *    this true if the visitor is logged in and is an 'admin' ONLY
     *
     * @param string with comma separated user roles: "user,editor,moderator" $_group
     * @param boolean $_only
     * @return true/false
     */
    function belongsToGroup($_group=null, $_only=null)
    {
        if ($this->CI->db_session AND $this->CI->config->item('FAL'))
        {
            $_username = $this->CI->db_session->userdata('user_name');
            $_who_is = $this->CI->db_session->userdata('role');
            
            if ($_username != false AND $_who_is != false)
            {
                // if we didn't specify who we are looking for
                // let's look if the request comes from an 'user'
	            if ($_group==null){$_group='user';}
 
	            $_groups = explode(",", $_group);
	
	            $_group = array();
                // eliminate possible whitespaces at the beginning and end
                // of groups names passed as parameters to this function
	            foreach($_groups as $_grp)
	            {
	            	$_group[] = trim($_grp);
	            }

                // let's see if we decided to check if
                // it belongs ONLY to a given group
	            switch ($_only)
	            {	
	            	// $_only = true
	            	case true: //we decided to check if it belongs ONLY to a given group
	            		in_array($_who_is, $_group) ? $_condition = true : $_condition = false;
	            		break;
	            	
	            	// $_only false or not specified
	            	// we decided to check if it belongs AT LEAST to a given group	
	            	default:
	            		// gets the locked role hierarchy value
			            $_hierarchy = $this->CI->config->item('FAL_roles');
			            // let's see who we are looking for
			            

				            foreach ($_group as $value)
				            {
				            	$_group_hierarchy []= $_hierarchy[$value];
				            }

				            $_group_hierarchy = max($_group_hierarchy);
			            
			            // let's see who accessed. we need to get the
                        // role-hierarchy-value of the visitor that did the request
			            $_who_hierarchy = $_hierarchy[$_who_is];

	            		$_who_hierarchy <= $_group_hierarchy ? $_condition = true : $_condition = false;
	            		break;
	            		
	            }
	            
	            // if who did the request doesn't have enough credentials
	            if ($_condition==true)
	            {
	            	return TRUE;
	            }
	        }
        }
	// if condition==false, db_session turner off or user not found (namely not logged in) in ci_session
    return false;
    }
       
    // --------------------------------------------------------------------

    /**
     * Performs the login procedure both for user login
     * and form administrators login
     *
     * @return unknown
     */
    function login()
    {
        if (!$this->CI->config->item('FAL')) 
        {
        	redirect($this->CI->config->item('FAL_login_success_action'), 'location');
        }

        $message = $this->CI->lang->line('FAL_invalid_user_message');

        if ($this->CI->db_session)
        {
            $values = $this->getLoginForm();
            $username = (isset($values['user_name']) ? $values['user_name'] : false);
            $password = (isset($values['password']) ? $values['password'] : false);

            if (($username != false) && ($password != false))
            {
                $password = $this->_encode($password);

	                // Use the input username and password and check against
                    // 'user' table to check if user banned
	                $query = $this->CI->usermodel->getUserForLogin($username, $password);


                if ($query->num_rows() == 1)
                {
                    $row = $query->row();
                    $fields = array('id', 'user_name', 'country_id', 'email',
                                  'role', 'last_visit', 'created', 'modified');
                    foreach($fields as $field) $userdata[$field] = $row->{$field};

                    // verifies if a user has not been banned from the site
                    // (i.e. user table, banned=1)
                    if ($row->{'banned'} == 0)
                    {
                        $this->_set_logindata($userdata);
                        
                        // set FLASH MESSAGE
                        // (redirection is done in FAL_front if TRUE is returned)
                        flashMsg( $this->CI->lang->line('FAL_login_message') );
                        return true;
                    }
                    else
                    {
                        $message = $this->CI->lang->line('FAL_banned_user_message');
                    }
                }
            }
        }

        // On error send user back to login page, and add error message
        // set FLASH MESSAGE
        flashMsg( $message );
        // FIXME : if false is returned, no redirection is done in FAL_front
        return false;
    }
    
    // --------------------------------------------------------------------
    /**
     * Performs the logout procedure
     *
     */
    function logout()
    {		
        // checks if a session exists
        if ($this->CI->db_session)
        {
            $_username = $this->CI->db_session->userdata('user_name');

            if ($_username != false)
                // deletes the userdata stored in DB for the user that logged out
            	$this->_unset_user($_username);
        }
       
        // set FLASH MESSAGE
       $msg = $this->CI->lang->line('FAL_logout_message');
       flashMsg($msg);
        
       redirect($this->CI->config->item('FAL_logout_success_action'), 'location');
    }
    
    // --------------------------------------------------------------------
    /**
     * Performs the registration procedure
     * Returns true if successful registration, false if unsucessful
     *
     * @return boolean
     */
    function register()
    {
        // let's clean the user_temp table
        // if we use registration with e-mail verification
    	if (!$this->CI->config->item('FAL_register_direct'))
    	{
    	   $this->cleanExpiredUserTemp();
    	}
    	
    	// let's check if the system is turned on and if we allow users to register
    	if (!$this->CI->config->item('FAL') OR $this->CI->config->item('FAL_allow_user_registration')!=TRUE)
            return false;

        if ($this->CI->db_session)
        {	
    	
            $values = $this->getRegistrationForm();
            $username = (isset($values['user_name']) ? $values['user_name'] : false);
            $password = (isset($values['password']) ? $values['password'] : false);
            $email = (isset($values['email']) ? $values['email'] : false);

            if (($username != false) && ($password != false) && ($email != false))
            {
                $password_email=$password;
            	$password = $this->_encode($password);
            	
            	// reassignement to the encoded password
            	$values['password'] = $password;
            	
            	// if we go for standard activation with e-mail verification
                // namely i.e. $config['FAL_register_direct'] = FALSE
                if (!$this->CI->config->item('FAL_register_direct'))
                {
                    // generates the activation code
                    $activation_code = $this->_generateRandomString();
                    $values['activation_code'] = $activation_code;
                    $query = $this->CI->UserTemp->insertUserForRegistration($values);
                    
                    // Use the input username and password and check against 'user_temp' table
                    // needed to find the user_temp ID for the activation link
                    $query = $this->CI->UserTemp->getUserLoginData($username, $password);

                    $user_id = 0;
                    if (($query != null) && ($query->num_rows() > 0))
                    {
                        $row = $query->row();
                        $user_id = $row->id;
    
                        $this->_sendActivationEmail($user_id, $username, $password_email, $email, $activation_code);
    
                        return true;
                    }
                }
                // do we skipp e-mail verification?
            	// namely if we go for direct activation
                // i.e. $config['FAL_register_direct'] = TRUE
                else
                {
                    // let's insert the values in the user table
                    $query = $this->CI->usermodel->insertUser($values);
                    
                    // if affected rows ==1 set a flash message and redirect to login
                    if ($this->CI->db->affected_rows() == 1)
                    {
                        // if we want the user profile as well
    	                if($this->CI->config->item('FAL_create_user_profile'))
    	                {	
    	                	// let's get the last insert id
    	                	$data_profile['id'] = $this->CI->db->insert_id();
    	                	$this->CI->userprofile->insertUserProfile($data_profile);
    	                }
    	                
    	                flashMsg( $this->CI->lang->line('FAL_activation_success_message') );
                        return true;
                    }
                    
                     
                }
            }
            else
            {
            	// set FLASH MESSAGE
            	flashMsg( $this->CI->lang->line('FAL_invalid_register_message') );
            	// FIXME : if false is returned, no redirection is done in FAL_front
            	return false;
            }
        }
    }
    
     // --------------------------------------------------------------------
   	 /**
     * Handles the user activation requests.
     *
     * @param int $id user id
     * @param varchar $activation_code user activation code
     * @var $id user id
     * @var $activation_code user activation code
     * @return true if successful activation, false if unsucessful
     */
    function activation($id, $activation_code)
    {	
    	// let's clean the user_temp table
        // if we use registration with e-mail verification
    	if (!$this->CI->config->item('FAL_register_direct'))
    	{
    	   $this->cleanExpiredUserTemp();
    	}
    	  	
        if (($id > 0) && ($activation_code != ''))
        {
            // gets userdata from USER_TEMP table
        	$query = $this->CI->UserTemp->getUserForActivation($id, $activation_code);
			
            // deletes the record from USER_TEMP
            $this->CI->UserTemp->deleteUserAfterActivation($id);
            
            if ($query->num_rows() > 0)
            {
                 foreach ($query->result() as $row)
					{
					   $data['user_name'] = $row->user_name;
					   $data['country_id'] = $row->country_id;
                	   $data['password'] = $row->password;
                	   $data['email'] = $row->email;
					}
					
                    // let's insert the new data				
                    // inserts the new user data in USER table
	                $this->CI->usermodel->insertUser($data);
	                
	                // if we want the user profile as well
	                if($this->CI->config->item('FAL_create_user_profile'))
	                {	
	                	//let's get the last insert id
	                	$data_profile['id'] = $this->CI->db->insert_id();
	                	$this->CI->userprofile->insertUserProfile($data_profile);
	                }

                return true;
            }
        }

        return false;
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Handles the user forgotten password $_POST requests
     * returns true if password sent to user, false otherwise
     * @return true if password sent to user
     */
    function forgotten_password()
    {
        if ($this->CI->db_session)
        {
            $email = $this->CI->input->post('email');
			
            // if $email not false
            // checks the relative password for that user querying the DB
            if (($email != false))
            {
                $query = $this->CI->usermodel->getUserForForgottenPassword($email);

                if (($query != null) && ($query->num_rows() > 0))
                {
                    $row = $query->row();
                    $user_id = $row->{'id'};
                    $user = $row->{'user_name'};
					
                    //generates the activation code
                    $activation_code = $this->_generateRandomString(50, 50);
					
                    //updates the user table
                    $this->CI->usermodel->updateUserForForgottenPassword($user_id, $activation_code);
					
                    //sends e-mail to user
                    $this->_sendForgottenPasswordEmail($user_id, $user, $email, $activation_code);
                    
                    return true;
                }
            }
            
            //set unsuccess FLASH MESSAGE
            $msg = $this->CI->lang->line('FAL_forgotten_password_user_not_found_message');
            flashMsg($msg);
            // FIXME : if false is returned, no redirection is done in FAL_front
            return false;
        }
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Handles the user forgotten password reset requests,
     * when the user clicks on the e-mail link.
     * Returns true if the process has been successful, false otherwise
     *
     * @param integer $id
     * @param varchar $activation_code
     * @return true
     */
    function forgotten_password_reset($id, $activation_code)
    {	
    	// checks if $id>0 and if $activation_code not null
        if (($id > 0) && ($activation_code != ''))
        {	
            /**
             * recalls the function getUserForForgottenPasswordReset($id, $activation_code)
             * from the class usermodel
             * it queries the database looking for the user's $id and $activation_code
             */
            $query = $this->CI->usermodel->getUserForForgottenPasswordReset($id, $activation_code);
			
            // if the query returns at least a result namely num_rows() > 0
            if ($query->num_rows() > 0)
            {
                $row = $query->row();
                $user_id = $row->{'id'};
                $user = $row->{'user_name'};
                $email = $row->{'email'};

                // generates a random password
                $password = $this->_generateRandomString($this->CI->config->item('FAL_user_password_min'), $this->CI->config->item('FAL_user_password_max'));
                
                // encrypts the random password using the md5 encryption
                $encrypted_password = $this->_encode($password);

                // sends the new generated password to the user
                $this->_sendForgottenPasswordResetEmail($user_id, $user, $email, $password);

                // updates the password in the database
                $this->CI->usermodel->updateUserForForgottenPasswordReset($user_id, $encrypted_password);

                return true;
            }
        }

        return false;
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Handles the user change password $_POST requests
     * returns true if password sent to user, false otherwise
     * @return true if password sent to user
     */
    function _change_password()
    {
        if ($this->CI->db_session)
        {
            $username = $this->CI->input->post('user_name');
            $old_password = $this->CI->input->post('old_password');
            $new_password = $this->CI->input->post('password');

            // if $email not false checks the relative password for that user querying the DB
            if ($username != false AND $old_password != false AND $new_password != false)
            {
                $query = $this->CI->usermodel->getUserForLogin($username, $this->_encode($old_password));

                if (($query != null) && ($query->num_rows() == 1))
                {
                    $row = $query->row();
                    $user_id = $row->{'id'};
                    $user = $row->{'user_name'};
                    $email = $row->{'email'};

                    // clear text password for e-mail
                    $password_email = $new_password;
                    
                    // encrypts the password for DB update
                    $new_password = $this->_encode($new_password);
                    
                    // updates the user table
                    $this->CI->usermodel->updateUserForForgottenPasswordReset($user_id, $new_password);

                    // sends e-mail to user
                    $this->_sendChangePasswordEmail($user_id, $user, $email, $password_email);
                    
                    return true;
                }
            }
            
            // set unsuccess FLASH MESSAGE
            $msg = $this->CI->lang->line('FAL_change_password_failed_message');
            flashMsg($msg);
            
            redirect($this->CI->config->item('FAL_changePassword_uri'), 'location');
        }
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Sets the userdata in the Db_session table
     * and updates the user table for Last_login
     *
     * @param array $userdata
     */
    function _set_logindata($userdata)
    {
        //updates the Last_visit field in the user table
        $this->CI->usermodel->updateUserForLogin($userdata['id']);
    	$this->CI->db_session->set_userdata($userdata);
    }


    // --------------------------------------------------------------------
    
    /**
     * Unsets user data in session_data DB field of table ci_session
     *
     * @param integer $user_id
     */
    function _unset_user($_username)
    {
        $users = $this->CI->db_session->userdata('user_name');
        
        if (isset($users))
        {
            unset($users);
            // is better to do a 1 call to unset_userdata passing an array?
            $this->CI->db_session->unset_userdata('id');
            $this->CI->db_session->unset_userdata('user_name');
            $this->CI->db_session->unset_userdata('role');
        }
        
    }


    // --------------------------------------------------------------------
    /**
     * Needed to clean the UserTemp table from not completed registration
     * The records get removed if older than what you set in the configuration
     * file $config['FreakAuthL_temporary_users_expiration']
     * Cleaning get performed after activation and on new registrations
     *
     */
    function cleanExpiredUserTemp()
    {
    	$expiration = $this->CI->config->item('FAL_temporary_users_expiration');
    	
    	$query = $this->CI->UserTemp->getUserTempCreated();
    	
    	if ($query->num_rows() > 0)
    	{
    	    foreach ($query->result() as $row)
    	    {
    	        if (time()>($row->created + $expiration))
    	        {
    	            $this->CI->UserTemp->deleteUserAfterActivation($row->id);
    	        }
    	    }
    	}
    }
	  

    // --------------------------------------------------------------------
    /**
     * Returns the currently logged in user's name
     * Returns an empty string if no user is logged in
     * uses Class db_session method "userdata".
     *
     * @return username string of currently logged in user
     * @return empty string if user not logged in
     */
    function getUserName()
    {
        if ($this->CI->config->item('FAL') && $this->CI->db_session)
            
        	// returns username string of currently logged in user
        	return $this->CI->db_session->userdata('user_name');
        
        // returns empty string if user not logged in
        return '';
    }
    
	// --------------------------------------------------------------------
    /**
     * Returns the currently logged in user's property from the session.
     *
     * A property is what he gave when registering (like 'email'),
     * or something calculated server-side (like 'last_visit').
     * Returns an empty string if no user is logged in.
     *
     * Uses Class db_session method "userdata".
     *
     * @param string $prop can be 'id', 'user_name', 'country_id', 'email', 'role', 'last_visit', 'created', 'modified'
     * @return prop string of currently logged in user
     * @return empty string if user not logged in or prop unknown
     */
    function getUserProperty($prop)
    {
        if ($this->CI->config->item('FAL') && $this->CI->db_session)
            
        	// returns property string of currently logged in user
        	return $this->CI->db_session->userdata($prop);
        
        // returns empty string if user not logged in
        return '';
    }
    
    // --------------------------------------------------------------------
    /**
     * Returns the property $prop of the user identified by $id from the database.
     *
     * A property is what he gave when registering (like 'email'),
     * or something calculated server-side (like 'last_visit').
     *
     * @param integer $id the id of the user you are interested in
     * @param string $prop can be 'id', 'user_name', 'country_id', 'email', 'role', 'last_visit', 'created', 'modified'
     * @return prop string of the user identified by $id
     * @return 'unknown user'  if user unknown
     * @return empty string if prop unknow
     */
    function getUserPropertyFromId($id, $prop)
    {
		$query = $this->CI->usermodel->getUserById($id);
		if ($query->num_rows() == 1)
		{
			$row = $query->row();
			if (isset($row->{$prop})) return $row->{$prop};
			else return '';
		}
		else
		{
			$this->CI->lang->load('freakauth');
			return $this->CI->lang->line('FAL_unknown_user');
		}
    }
    

    // --------------------------------------------------------------------
    /**
     * Checks if Captcha is required
     * if it is required in the config settings recalls function _generateCaptcha()
     * to build it
     */
    function captcha_init($action)
    {	
    	//checks FreakAuth security code configuration
        if (!$this->CI->config->item('FAL_use_captcha'.$action))
            
        	//if not set or FALSE
        	return;
        
        //ELSE unsets userdata from session table
        $this->CI->db_session->unset_userdata('FreakAuth_captcha');
        
        //loads the captcha plugin
        //$this->CI->load->plugin('captcha');
        list($usec, $sec) = explode(" ", microtime());
        $now = ((float)$usec + (float)$sec);
        
        //deletes captcha images
        $this->_deleteOldCaptcha($now);
        
        //generates security code image
        $this->_generateCaptcha($now);
    }

    // --------------------------------------------------------------------
    /**
     * Deletes the captcha images generated
     * it deletes them if they "expired". The "expiration" (in seconds)
     * signifies how long an image will remain in the root/tmp folder before it
     * will be deleted.  The default is 10 minutes. Change the value
     * of $expiration if you want them to be deleted more or less often
     *
     * @param float $now
     * @todo move expiration time in a config variable
     */
    function _deleteOldCaptcha($now)
    {
    	list($usec, $sec) = explode(" ", microtime());
		
    	// sets the expiration time of the captcha image
    	$expiration=60*10; //10 min
			
		$current_dir = @opendir($this->CI->config->item('FAL_captcha_image_path'));
		
		while($filename = @readdir($current_dir))
		{
			if ($filename != "." AND $filename != ".." AND $filename != "index.html")
			{
				$name = str_replace(".jpg", "", $filename);
			
				if (($name + $expiration) < $now)
				{
					@unlink($this->CI->config->item('FAL_captcha_image_path').$filename);
				}
			}
		}
		
		@closedir($current_dir);
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Creates a random security code image (Captcha).
     *
     * @return unknown
     */
    function _generateCaptcha($now)
    {
        
            $securityCode = $this->_generateRandomString($this->CI->config->item('FAL_captcha_min'), $this->CI->config->item('FAL_captcha_max'));
			//$image = 'security-'.$this->_generateRandomString(16, 32).'.jpg';
			$image = $now.'.jpg';
            $this->CI->config->set_item('FAL_captcha_image', $image);
            
            $config['image_library'] = $this->CI->config->item('FAL_captcha_image_library');
            $config['source_image'] = $this->CI->config->item('FAL_captcha_base_image_path').$this->CI->config->item('FAL_captcha_image_base_image');
            $config['new_image'] = $this->CI->config->item('FAL_captcha_image_path').$image;
            $config['wm_text'] = $securityCode;
            $config['wm_type'] = 'text';
            $config['wm_font_path'] = $this->CI->config->item('FAL_captcha_image_font');
            $config['wm_font_size'] = $this->CI->config->item('FAL_captcha_image_font_size');
            $config['wm_font_color'] = $this->CI->config->item('FAL_captcha_image_font_color');
            $config['wm_vrt_alignment'] = 'top';
			$config['wm_hor_alignment'] = 'left';
			$config['wm_padding'] = '10';

            $image =& get_instance();
            $image->load->library('image_lib');
            $image->image_lib->initialize($config); 
            
            if ( ! $image->image_lib->watermark())
			{
			    echo $image->image_lib->display_errors();
			};
			
            $this->CI->db_session->set_userdata('FreakAuth_captcha', $securityCode);			
            return $this->CI->config->item('FAL_captcha_image');
            
        
    }
	
    // --------------------------------------------------------------------
    
    /**
     * Generates a random string.
     *
     * @param integer $minLength
     * @param integer $maxLength
     * @param boolean $useUpper
     * @param boolean $useNumbers
     * @param boolean $useSpecial
     * @return $key random string
     */
    function _generateRandomString()
    {
        $charset = "abcdefghijklmnopqrstuvwxyz";
        if ($this->CI->config->item('FAL_captcha_upper_lower_case'))
            $charset .= "ABCDEFGHIJKLMNPQRSTUVWXYZ";
        if ($this->CI->config->item('FAL_captcha_use_numbers'))
            $charset .= "23456789";
		if ($this->CI->config->item('FAL_captcha_use_specials'))
            $charset .= "~@#$%^*()_+-={}|][";
            
        $length = mt_rand($this->CI->config->item('FAL_captcha_min'), $this->CI->config->item('FAL_captcha_max'));
        if ($this->CI->config->item('FAL_captcha_min') > $this->CI->config->item('FAL_captcha_max'))
            $length = mt_rand($this->CI->config->item('FAL_captcha_max'), $this->CI->config->item('FAL_captcha_min'));

        $key = '';
        for ($i = 0; $i < $length; $i++)
            $key .= $charset[(mt_rand(0, (strlen($charset)-1)))];

        return $key;
    }

    // --------------------------------------------------------------------
    
    /**
     * Sends an email from the system to a given email address.
     *
     * @access private
     * @param varchar $email
     * @param varchar $subject
     * @param text $message
     */
    function _sendEmail($email, $subject, $message)
    {
        $tobj =& get_instance(); 
        $tobj->load->library('email');
        $tobj->email->clear();
        $tobj->email->from($this->CI->config->item('FAL_user_support'), $this->CI->config->item('FAL_website_name').' '.$this->CI->config->item('FAL_email_from'));
        $tobj->email->to($email);
        $tobj->email->subject($subject);
        $tobj->email->message($message);
        $tobj->email->send();
    }
	
    // --------------------------------------------------------------------
    
    /**
     * Sends an activation email from the system to the newly registered user
     *
     * @access private
     * @param integer $id
     * @param unknown_type $user
     * @param unknown_type $email
     * @param varchar $activation_code
     */
    function _sendActivationEmail($id, $user, $password_email, $email, $activation_code)
    {
        $activation_url = site_url($this->CI->config->item('FAL_activation_uri').'/'.$id.'/'.$activation_code);
        $data = array('activation_url' => $activation_url,
                      'user_name' => $user,
                      'password'=>$password_email);

        $message = $this->CI->load->view($this->CI->config->item('FAL_activation_email'), $data, true);
		
        $subject= '['.$this->CI->config->item('FAL_website_name').'] '.$this->CI->lang->line('FAL_activation_email_subject');
        $this->_sendEmail($email, $subject , $message);
    }
	
    // --------------------------------------------------------------------
    
    /**
     * Sends an email from the system to the user that has forgotten the
     * password the e-mail contains the link to make the reset password start.
     *
     * @access private
     * @param unknown_type $id
     * @param unknown_type $user
     * @param unknown_type $email
     * @param unknown_type $activation_code
     */
    function _sendForgottenPasswordEmail($id, $user, $email, $activation_code)
    {
        $activation_url = site_url($this->CI->config->item('FAL_forgottenPasswordReset_uri').'/'.$id.'/'.$activation_code);
        $data = array('activation_url' => $activation_url,
                      'user_name' => $user);

        $message = $this->CI->load->view($this->CI->config->item('FAL_forgotten_password_email'), $data, true);
		
        $subject= '['.$this->CI->config->item('FAL_website_name').'] '.$this->CI->lang->line('FAL_forgotten_password_email_subject');
        
        $this->_sendEmail($email, $subject, $message);
    }

    // --------------------------------------------------------------------
    
	/**
	 * Sends and e-mail to the user after resetting the password
	 * The e-mail contains the new login informations
	 *
	 * @access private
	 * @param integer $id
	 * @param varchar $user
	 * @param varchar $email
	 * @param varchar $password
	 */
    function _sendForgottenPasswordResetEmail($id, $user, $email, $password)
    {
        $data = array('password' => $password,
                      'user_name' => $user,
                      'change_password_link'=> site_url($this->CI->config->item('FAL_changePassword_uri'))
                      );
                      
		
        // displays message to the user on screen
        $message = $this->CI->load->view($this->CI->config->item('FAL_forgotten_password_reset_email'), $data, true);
		
        $subject= '['.$this->CI->config->item('FAL_website_name').'] '.$this->CI->lang->line('FAL_forgotten_password_email_reset_subject');
        // sends e-mail to the user to reset password
        $this->_sendEmail($email, $subject, $message);
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Sends an email from the system to the user that has changed the password
     * the e-mail has the newly generated password.
     * @access private
     * @param unknown_type $id
     * @param unknown_type $user
     * @param unknown_type $email
     * @param unknown_type $activation_code
     */
    function _sendChangePasswordEmail($id, $user, $email, $password_email)
    {
        $data = array('user_name' => $user,
                      'password'=>$password_email);

        $message = $this->CI->load->view($this->CI->config->item('FAL_change_password_email'), $data, true);
		
        $subject= '['.$this->CI->config->item('FAL_website_name').'] '.$this->CI->lang->line('FAL_forgotten_password_email_reset_subject');
        $this->_sendEmail($email, $subject , $message);
    }
    

    // --------------------------------------------------------------------
    
    /**
     * Gets login form input values.
     *
     * @return array
     */
    function getLoginForm()
    {
        $values['user_name'] = $this->CI->input->post('user_name');
        $values['password'] = $this->CI->input->post('password');
        
        //$values[$this->CI->config->item('FAL_<your field>_field')] = $this->CI->input->post($this->CI->config->item('FAL_<your field>_field'));
        
        return $values;
    }

    // --------------------------------------------------------------------

    /**
     * Gets registration form input values.
     *
     * @return array
     */
    function getRegistrationForm()
    {
        $values['user_name'] = $this->CI->input->post('user_name', TRUE);
        $values['password'] = $this->CI->input->post('password');
        $values['email'] = $this->CI->input->post('email');
        if ($this->CI->config->item('FAL_use_country'))
            $values['country_id'] = $this->CI->input->post('country_id');
            
        //$values[$this->CI->config->item('FAL_<your field>_field')] = $this->CI->input->post($this->CI->config->item('FAL_<your field>_field'));
        
        return $values;
    }
    
  	// --------------------------------------------------------------------
  	/**
  	 * Custom encoding method for added security
  	 *
  	 * @param string $_password
  	 * @return encoded password
  	 */
  	function _encode($password)
  	{
		$majorsalt=null;
		
		// if you set your encryption key let's use it
  		if ($this->CI->config->item('encryption_key')!='')
		{
			// conctenates the encryption key and the password
			$_password = $this->CI->config->item('encryption_key').$password;
		}
		else {$_password=$password;}
		
		// if PHP5
		if (function_exists('str_split'))
		{
		    $_pass = str_split($_password);       
		}
		// if PHP4
		else
		{
			$_pass = array();
		    if (is_string($_password))
		    {
		    	for ($i = 0; $i < strlen($_password); $i++)
		    	{
		        	array_push($_pass, $_password[$i]);
		        }
		     }
		}
		
		// encrypts every single letter of the password
		foreach ($_pass as $_hashpass) 
		{
			$majorsalt .= md5($_hashpass);
		}
		
        // encrypts the string combinations of every single encrypted letter
        // and finally returns the encrypted password
		return $password=md5($majorsalt);
		
  	}
  	
  	// --------------------------------------------------------------------
  	
  	/**
  	 * Needed to display and edit user profile data
  	 *
  	 * @param integer user id $id
  	 * @return array of user profile data-> $data['user_profile']
  	 */
  	function _getUserProfile($id)
  	{	
  		
		  		//lets get fields names from config
  		$field_name=$this->CI->config->item('FAL_user_profile_fields_names');
  		
  		//lets get fields validation rules from config
  		$field_rule=$this->CI->config->item('FAL_user_profile_fields_validation_rules');
  		
  		
  		//array of fields
  		$db_fields=$this->CI->userprofile->getTableFields();

  		//number of DB fields -1
  		//I put a -1 because I must subtract the 'id' field
  		$num_db_fields=count($db_fields) - 1;
  		
  		
  		if ($num_db_fields!=0) 
  		{	
			
	  		$query=$this->CI->userprofile->getUserProfileById($id);
		  		
	  		if ($query->num_rows() == 1)
		    {
				$row = $query->row();
		
				for ($i=1; $i<=$num_db_fields;  $i++)
				{
				 	$field = $db_fields[$i];
				 	$data[$field]=$row->$db_fields[$i];			 			
				}
			  		
			 	return $data;

		    }
	  		else 
		    {
		       //set_error_flash_message
		       //set FLASH MESSAGE
		       // $this->CI->db_session->set_flashdata('flashMessage', 'No profile found for this user');
               
               // grahack: removed this flash message since there is no redirection
               // (message was displayed in the next page)
               // anyway, the view file
               // views/FreakAuth_light/template_admin/users/detail.php
               // displays "no data in DB: please add them"
		    }
  		}
		else 
		    {
		       return false;
		    }
  		
  	}
  	
  	// --------------------------------------------------------------------
  	
  	/**
  	 * Needed to dynamically build rules and fields from config array for add
     * and edit custom user profile.
  	 *
  	 * @return array of data['rules'] and data['fields']
  	 */
  	function _buildUserProfileFieldsRules()
  	{
  		// lets get fields names from config
  		$field_name=$this->CI->config->item('FAL_user_profile_fields_names');
  		
  		// lets get fields validation rules from config
  		$field_rule=$this->CI->config->item('FAL_user_profile_fields_validation_rules');
  	
  		
  		// array of fields
  		$db_fields=$this->CI->userprofile->getTableFields();

  		// number of DB fields -1
  		// I put a -1 because I must subtract the 'id' field
  		$num_db_fields=count($db_fields) - 1;
		
  		// I use 'for' instead of 'foreach' because I have to escape the
        // 'id' field that has key=0 in my array
	  	for ($i=1; $i<=$num_db_fields;  $i++)
		{
			 $field = $db_fields[$i];
			 // creates rules
			 // $data['rules'][$field] = $field_rule[$field];
			 // if the rule for the fields in DB has been specified in the
             // config array
             // let's assign it, otherwise don't assign anything
			 array_key_exists($field, $field_rule) ? $data['rules'][$field] = $field_rule[$field] : '';
			 // creates fields
			 // if the custom field name for the field in DB has been specified
             // in the config array
			 // let's assign it otherwise let's call it with the name in DB
			 array_key_exists($field, $field_name) ? $data['fields'][$field] = $field_name[$field] : $data['fields'][$field] = $field;
		}

		
		return $data;
  	}
  		
}