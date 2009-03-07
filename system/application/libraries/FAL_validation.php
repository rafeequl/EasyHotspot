<?php if (!defined('BASEPATH')) exit('No direct script access permitted.');
/**
 * This library handles extending the CI core validation class, instead of using CALLBACKS in the rules.
 *
 * Why? for code reusability and tidyness!
 *
 * For example, in a normal validation rule call you would do this (with a callback):
 * |required|min_length[3]|max_length[30]|callback_username_login_check|
 *
 * But because of this library we simply call the callback as though it were a normal validation function:
 * |required|min_length[3]|max_length[30]|username_login_check|
 *
 * It is now reusable (abstract) and much easier to type as a rule!
 *
 * ---------------------------------------------------------------------------------
 * Copyright (C) 2007  Authlib Team - http://www.ciforge.com/freakauth/
 * ---------------------------------------------------------------------------------
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed with the hope that it will be useful,
 * but, WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *-----------------------------------------------------------------------------------
 * @package     	FreakAuth_light
 * @subpackage  	Library extension for CI_Validation
 * @category    	Authentication/Authorization
 * @author      	Daniel Vecchiato <info@4webby.com> & Alexander Springmeyer <parnell.s@comcast.net> & Christophe gragnic <christophegragnic@yahoo.fr>
 * @copyright   	Copyright &copy; 2007 Authlib Team - http://www.ciforge.com/freakauth/
 * @license			http://www.gnu.org/licenses/lgpl.html
 * @link 			http://www.ciforge.com/freakauth/
 * @version 		1.1
 * @tutorial        http://www.ciforge.com/trac/freakauth/wiki/FreakAuthDoc
 */
class FAL_validation extends CI_Validation
{
	var $CI;
	function FAL_validation()
	{
		parent::CI_Validation();
		log_message('debug', 'FAL_validation Library Initialized.');
		$this->CI->load->model('FreakAuth_light/usertemp', 'UserTemp', TRUE);
 		$this->CI->load->model('usermodel', 'UserModel', TRUE);
 		//$this->CI->load->model('userprofile', 'UserProfile', TRUE);
 		$this->CI->load->model('country', 'Country', TRUE);
	}
	
	// --------------------------------------------------------------------
	/**
	 * Function used for login validation
	 * validates username and password simultaneusly
	 * if they passed previous distinct/individual validation
	 *
	 * @param string $username_login   the username passed by previous validation
	 * @param string $password_login   the password passed by previous validation
	 * @return boolean
	 */
	
	function login_check($username_login, $password_login)
	{
		//Use the input username and checks against 'users' table
        $query = $this->CI->UserModel->getUserByUsername($username_login);
	
        if (($query != null) && ($query->num_rows() == 0))
	    {
	        //debugging
	        //echo '<br>username not found<br>';
	        $username_cond = false;
		}
		else 
		{
			//debugging
			//echo '<br>username found<br>';
			$username_cond = true;
		}
		
		//debugging
		//echo isset($password_login) ? '<br>password set<br>' : '<br>not set<br>';
		//echo $password_login;
		
		if ($username_cond == true AND isset($password_login) AND $password_login!='')
		{
	        //encrypts the random password using the md5 encryption
	        $encrypted_password = $this->CI->freakauth_light->_encode($password_login); 	                
	        $query = $this->CI->UserModel->getUserForLogin($username_login , $encrypted_password);
		
	        if (($query != null) && ($query->num_rows() == 0))
		    {
		        //we didn't find the password
		    	$pass_cond = FALSE;
		    	//debugging
		    	//echo '<br>password not found<br>';
			}
			else 
			{
				//we found the password
				$pass_cond = TRUE;
				//debugging
				//echo '<br>password found<br>';
			}
		}
		//username not found or password empty
		else 
		{
			$pass_cond = FALSE;
			//debugging
			//echo '<br>username not  found or password empty<br>';
		}
		
		//do we passed validation?
		if ($username_cond == TRUE AND $pass_cond == TRUE)
		{
			return true;
		}
		else 
		{
			//let's set the message
			$this->login_error_message = $this->_error_prefix.$this->CI->lang->line('FAL_invalid_username_password_message').$this->_error_suffix;
			return false;
		}
	}
	
	// --------------------------------------------------------------------

	/**
	 * RULES HELPER FUNCTION
	 * Password validation callback for password validation
	 * 
	 * @access private
	 * @param varchar $value
	 * @return boolean
	 * 
	 */
	
	function password_check($value)
	{	
		$callback = 'password_check';
	    return $this->is_valid_text($callback, $value, $this->CI->config->item('FAL_user_password_min'), $this->CI->config->item('FAL_user_password_max'));
	}
	
	// --------------------------------------------------------------------
        
    /**
     * Rule used in admin backend: it get applyed only if the password field
     * has a value, namely if the password get changed
     *
     * @param form value $value
     * @return boolean
     */
	function password_backend_check($value)
	{	
		if ($value!='' AND isset($_POST['id']))
		{
			$callback = 'password_backend_check';
			return $this->is_valid_text($callback, $value, $this->CI->config->item('FAL_user_password_min'), $this->CI->config->item('FAL_user_password_max'));
		}
	   
	}
	
	// --------------------------------------------------------------------

    /**
     * RULES HELPER FUNCTION
     * User name validation callback for validation against min-max length settings
     *
     * @access private
     * @param varchar $value
     * @return boolean
     */
    function username_check($value)
	{	
		$callback = 'username_check';
	    return $this->is_valid_text($callback, $value, $this->CI->config->item('FAL_user_name_min'), $this->CI->config->item('FAL_user_name_max'));
	}
	
	// --------------------------------------------------------------------
	
    /**
     * RULES HELPER FUNCTION
     * User name duplicate validation callback for validation against duplicate username in DB
     *
     * @access private
     * @param varchar $value
     * @return boolean
     */
    function username_duplicate_check($value)
	{
	    //Use the input username and check against 'users' table
        //query in main user table (users already activated)
        $query = $this->CI->UserModel->getUserByUsername($value);
        
        //query in temporary user table (users waiting for activation)
        //only if registration with email verification
        if (!$this->CI->config->item('FAL_register_direct'))
        {
            $fields='id';
            $where=array('user_name'=>$value);
            $query_temp = $this->CI->UserTemp->getUserTempWhere($fields, $where);
        }
        
        //setting the right condition depending on registration type
        if ($this->CI->config->item('FAL_register_direct'))
        {
            $condition = (($query != null) && ($query->num_rows() > 0)) ?  TRUE : FALSE;
        }
        else 
        {
            $condition = (($query != null) && ($query->num_rows() > 0) OR ($query_temp != null) && ($query_temp->num_rows() > 0)) ? TRUE : FALSE;
        }
        
        //checking if condition satisfied
        if ($condition == TRUE)
	    {
	        $this->set_message('username_duplicate_check', $this->CI->lang->line('FAL_in_use_validation_message'));
		    return false;
		}
		else 
		{
		    return true;
		}
	}
	
	// --------------------------------------------------------------------
	
    /**
     * User name duplicate validation callback for validation against duplicate username in DB.
     * Used in backend.
     *
     * @access private
     * @param varchar $value
     * @return boolean
     */
    function username_backend_duplicate_check($value)
	{
		//checks if the request comes from add or edit actions
        $fields='id';
		$where= isset($_POST['id']) ? array('id !='=> $_POST['id'], 'user_name'=>$value) : array('user_name'=>$value);
        $query = $this->CI->UserModel->getUsers($fields, $limit=null, $where);
        
        //query in temporary user table (users waiting for activation)
        //only if registration with email verification
        if (!$this->CI->config->item('FAL_register_direct'))
        {
            $fields='id';
            $where = array('user_name'=>$value);
            $query_temp = $this->CI->UserTemp->getUserTemp($fields, $limit=null, $where);
        }
        
        //setting the right condition depending on registration type
        if ($this->CI->config->item('FAL_register_direct'))
        {
            $condition = (($query != null) && ($query->num_rows() > 0)) ?  TRUE : FALSE;
        }
        else 
        {
            $condition = (($query != null) && ($query->num_rows() > 0) OR ($query_temp != null) && ($query_temp->num_rows() > 0)) ? TRUE : FALSE;
        }
        
        //checking if condition satisfied
        if ($condition == TRUE)
	    {
	        $this->set_message('username_backend_duplicate_check', $this->CI->lang->line('FAL_in_use_validation_message'));
		    return false;
	    }
	    else
	    {
	        return true;
	    }
	}
	
	// --------------------------------------------------------------------
	
    /**
     * RULES HELPER FUNCTION
     * User name duplicate validation callback for validation against duplicate username in DB
     *
     * @access private
     * @param varchar $value
     * @return boolean
     */
    function email_duplicate_check($value)
	{
	    //Use the input e-mail and check against 'users' table
        //query in main user table (users already activated)
        $query = $this->CI->UserModel->getUserForForgottenPassword($value);
        
        if (($query != null) && ($query->num_rows() > 0))
	    {
	        $this->set_message('email_duplicate_check', $this->CI->lang->line('FAL_user_email_duplicate'));
		    return false;
		}
		
        //query in temporary user table (users waiting for activation)
        //only if registration with email verification
        if (!$this->CI->config->item('FAL_register_direct'))
        {
    		$fields='id';
            $where=array('email'=>$value);
            $query_temp = $this->CI->UserTemp->getUserTempWhere($fields, $where);
            
            if (($query_temp != null) && ($query_temp->num_rows() > 0))
    	    {
    	        $this->set_message('email_duplicate_check', $this->CI->lang->line('FAL_usertemp_email_duplicate'));
    		    return false;
    		}
        }
        
		return true;
	}
	
	// --------------------------------------------------------------------
	
    /**
     * User name duplicate validation callback for validation against duplicate username in DB.
     * This function is used in the backend administration
     *
     * @access private
     * @param varchar $value
     * @return boolean
     */
    function email_backend_duplicate_check($value)
	{ 	
		//Use the input e-mail and check against 'users' table
	    //checks if the request comes from add or edit actions
		//query in main user table (users already activated)
	    $fields='id';
		$where = isset($_POST['id']) ?  array('id !='=> $_POST['id'], 'email'=>$value) : array('email'=>$value);
        $query = $this->CI->UserModel->getUsers($fields, $limit=null, $where);

        if (($query != null) && ($query->num_rows() > 0))
	    {
	        $this->set_message('email_backend_duplicate_check', $this->CI->lang->line('FAL_user_email_duplicate'));
	        $query->free_result();
	        return false;
		}
		
        //query in temporary user table (users waiting for activation)
        //only if registration with email verification
        if (!$this->CI->config->item('FAL_register_direct'))
        {
            $fields='id';
            $where=array('email'=>$value);
            $query_temp = $this->CI->UserTemp->getUserTempWhere($fields, $where);
            
            if (($query_temp != null) && ($query_temp->num_rows() > 0))
    	    {
    	        $this->set_message('email_backend_duplicate_check', $this->CI->lang->line('FAL_usertemp_email_duplicate'));
    		    
    	        $query_temp->free_result();
    	        return false;
    		}
        }
		
        return true;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Checks if the e-mail is already in use 
	 * namely if an user iin DB has the same e-mail
	 *
	 * @param string $value
	 * @return unknown
	 */
	function email_exists_check($value)
	{
	    //Use the input e-mail and check against 'users' table
        //query in main user table (users already activated)
         $query = $this->CI->UserModel->getUserForForgottenPassword($value);


        if (($query != null) && ($query->num_rows() == 0))
	    {
	        $this->set_message('email_exists_check', $this->CI->lang->line('FAL_forgotten_password_user_not_found_message'));
		    return false;
		}		
		
		return true;
	}
	
	// --------------------------------------------------------------------
	
    /**
     * RULES HELPER FUNCTION
     * Security code validation callback for validation
     *
     * @access private
     * @param varchar $value
     * @return boolean
     */
	function securitycode_check($value)
	{
	    if ($this->CI->config->item('FAL_use_captcha_register') OR $this->CI->config->item('FAL_use_captcha_login') OR $this->CI->config->item('FAL_use_captcha_forgot_password'))
	    {
    	    //gets the security code stored in the db_session
	    	$securityCode = $this->CI->db_session->userdata('FreakAuth_captcha');
			
            // erase the code from the session to prevent it to be used a second time
            // see http://www.ciforge.com/trac/freakauth/ticket/20
            $this->CI->db_session->unset_userdata('FreakAuth_captcha');
			
	    	if ($this->CI->config->item('FAL_captcha_case_sensitive')==FALSE)
	    	{
	    		$control= strcmp(strtolower($value), strtolower($securityCode));
	    	}
	    	else {$control= strcmp($value, $securityCode);}
	    	
	    	//compares the security code provided in the input field with that stored in db_session
    	    if ($control != 0)
    	    {
    	        $this->set_message('securitycode_check', $this->CI->lang->line('FAL_captcha_message'));
    		    return false;
    		}
    		else
    		{
    		    return true;
    		}
    	}
    	else
    	{
    		return true;
    	}
	}
	// --------------------------------------------------------------------
	
    /**
     * RULES HELPER FUNCTION
     * Checks if at least 1 country has been chosen in the select country form element
     *
     * @access private
     * @param varchar $value
     * @return boolean
     */
    function country_check($country_id)
	{
	    if ($this->CI->config->item('FAL_use_country'))
	    {
    	    if ($country_id == 0)
    	    {
    	        //$this->validation->country_id= $country_id;
    	    	$this->set_message('country_check', $this->CI->lang->line('FAL_country_validation_message'));
    		    return FALSE;
    		}
    	}
		
		return true;
	}
	
	
	// --------------------------------------------------------------------
	
    /**
     * RULES HELPER FUNCTION
     * Determines if a input text has valid characters and meets min/max length requirements
     *
     * @access private
     * @param unknown_type $callback
     * @param varchar $value
     * @param integer $min
     * @param integer $max
     * @param varchar $invalid_message
     * @param unknown_type $expression
     * @return boolean
     */
    function is_valid_text($callback, $value, $min, $max, $invalid_message = null, $expression = '/^([a-z0-9])([a-z0-9_\-])*$/ix')
	{
	    $message = '';
	    if ((strlen($value) < $min) ||
	        (strlen($value) > $max))
	        $message .= sprintf($this->CI->lang->line('FAL_length_validation_message'), $min, $max);
	        
	    if (!preg_match($expression, $value))
	        $message .= $this->CI->lang->line('FAL_allowed_characters_validation_message');
		
		if ($message != '')
		{
		    if (!isset($invalid_message))
		        $invalid_message = $this->CI->lang->line('FAL_invalid_validation_message');
		    $this->set_message($callback, $invalid_message.$message);
	        return false;
		}
		
		return true;
	}
}
?>