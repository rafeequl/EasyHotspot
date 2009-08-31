<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Helper for the FreakAuth library
 * 
 * @package     FreakAuth_light
 * @subpackage  Helpers
 * @category    Authentication
 * @author      Daniel Vecchiato (danfreak) & Christophe Gragnic (grahack)
 * @copyright   Copyright (c) 2007, 4webby.com
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @link 		http://4webby.com/freakauth
 * @link 		http://www.ciforge.com/trac/freakauth/
 * @version 	1.1
 */
// ------------------------------------------------------------------------
/**
 * Cheks if we have extensions to the Freakauth_light class
 * The class extending it should be called MyFAL and the file
 * You can place them either in system/libraries or in application/libraries
 * 
 * - libraries/MyFAL.php
 */
function loadFalExtension()
{
    $obj =& get_instance();
    if ($obj->config->item('FAL_use_extensions'))
    {
        if (file_exists(APPPATH.'libraries/MyFAL'.EXT) OR file_exists(BASEPATH.'libraries/MyFAL'.EXT))
        {
            //let's load the core library (i.e. FreakAuth_light.php) extension
            $obj->load->library('MyFAL');
    
            $obj->freakauth_light = & new MyFAL();
            log_message('debug', 'MyFAL library loaded');
            log_message('debug', 'MyFAL class assigned to $this->CI->freakauth_light');
        }
        else
        {
            log_message('debug', 'MyFAL class not found');
        }
    }
}
// ------------------------------------------------------------------------
//
// Returns the currently logged on user's name.
// Returns an empty string if no user is logged in.
//
function getUserName()
{
    $obj =& get_instance();
    //loadFalExtension();
    return $obj->freakauth_light->getUserName();
}

// ------------------------------------------------------------------------
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
    $obj =& get_instance();
    loadFalExtension();
    return $obj->freakauth_light->getUserProperty($prop);
}

// ------------------------------------------------------------------------
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
	$obj =& get_instance();
	loadFalExtension();
    return $obj->freakauth_light->getUserPropertyFromId($id, $prop);
}

// ------------------------------------------------------------------------
//
// Checks to see if a user is an administrator.  
// Returns true if FreakAuth system is not activated.
// Returns true if admin or superadmin, otherwise false.
//
function isAdmin()
{
    $obj =& get_instance();
    loadFalExtension();
    return $obj->freakauth_light->isAdmin();
}

// ------------------------------------------------------------------------
//
// Checks to see if a user is logged in.  
// Returns true if FreakAuth system is not activated.
// Returns the user_id if valid, otherwise false.
//
function isValidUser()
{
    $obj =& get_instance();
    loadFalExtension();
    return $obj->freakauth_light->isValidUser();
}

// ------------------------------------------------------------------------
	/**
	* Function used to used to check if a logged in members belongs to the custom role (group) specified in the first parameter
     * it requires 2 optional parameters
     * The first parameter specifies the user groups as a comma separated string(NB: just comma separated WITHOUT SPACES->'user,admin'<--RIGHT 'user,admin'<--WRONG)
     * The second parameter specifies whether we want to check to the specified groups ONLY or for AT LEAST those group membership in the hierarchy
     * (returns true also if the logged user belongs to a group higher in the hierarchy)
     * 
     * example usage in a view to echo something depending on it's role (it can be a menu option for example)
     * 
     * 1) <?=belongsToGroup() ? $display-this : $display_that;?> //displays-this if the visitor is logged in and he is AT LEAST an user, $display_that otherwise
     * 2) <?=belongsToGroup('user,editor')? $display-this : $display_that;?>  //displays-this if the visitor is logged in and he is AT LEAST an user or an editor (therefore it displays-this also if he belongs to user-groups higher in the hierarchy (i.e. superadmin), $display_that otherwise
     * 3) <?=belongsToGroup('admin', true)? $display-this : $display_that;?>  //displays-this if the visitor is logged in and is an 'admin' ONLY, $display_that otherwise 
     * 
     * @param string containing comma separated user groups i.e. "user, editor, moderator"
     * @param boolean $_only
     * @return true/false
     */
function belongsToGroup($group=null, $only=null)
{
    $obj =& get_instance();
    loadFalExtension();
    return $obj->freakauth_light->belongsToGroup($group, $only);
}
// ------------------------------------------------------------------------
/**
 * Returns the login anchor (message) namely 
 * IF A USER IS LOGGED IN:
 * "Welcome the_user_name / logout"
 * 
 * IF A USER IS NOT LOGGED IN:
 * "Welcome guest / login"
 * 
 * you can customise the appearance of these messages modifying the views used
 * to display the loginAnchor(): the files are in 
 * $obj->config->item('FAL_template_dir').content/login_anchor_guest
 * and
 * $obj->config->item('FAL_template_dir').content/login_anchor_user
 * 
 * If you use a controller not named "auth" to handle login and logout actions
 * you must specify the controller/method that handles them when calling this function
 * ------------------------------------------------------
 * usage examples in a view:
 * ------------------------------------------------------
 * <?=loginAnchor('auth/login', 'auth/logout');?>
 *
 * @param string $login_uri the controller/method that handles the login action
 * @param string $logout_uri the controller/method that handles the logout action
 * @param unknown_type $logout_attributes
 * @param unknown_type $login_attributes
 * @return the message in a view
 */
function loginAnchor($login_uri = null, $logout_uri = null, $logout_attributes = null, $login_attributes = null)
{
    $obj =& get_instance();
	$obj->lang->load('freakauth');
	$data['welcome'] = $obj->lang->line('FAL_welcome');
	$tpl_dir = $obj->config->item('FAL_template_dir');
	if (belongsToGroup())
	{
		// if we have a user
		$data['logout_label'] = $obj->lang->line('FAL_logout_label');
		$data['logout_attributes'] = $logout_attributes;
		$data['logout_uri'] = $logout_uri!=null ? $logout_uri : $obj->config->item('FAL_logout_uri');
		return $obj->load->view($tpl_dir.'content/login_anchor_user', $data, true);
	}
	else
	{
		// if we have a guest
		$data['login_label'] = $obj->lang->line('FAL_login_label');
		$data['login_attributes'] = $login_attributes;
		$data['login_uri'] = $login_uri!=null ? $login_uri : $obj->config->item('FAL_login_uri');
		//Disabled since we dont need 
		return $obj->load->view($tpl_dir.'content/login_anchor_guest', $data, true);
	}
}

// ------------------------------------------------------------------------
/**
 * The same as for loginAnchor, but for the admin backend
 * in this case the message is displyed as HTML (no view templates)
 *
 * @param unknown_type $logout_attributes
 * @param unknown_type $login_attributes
 * @return unknown
 */
function loginAnchorAdmin($logout_attributes = null, $login_attributes = null)
{
    $obj =& get_instance();
	$obj->lang->load('freakauth');
	return (isAdmin() ? "welcome ".getUserName()." [ ".anchor($obj->config->item('FAL_logout_uri'), $obj->lang->line('FAL_logout_label'), $logout_attributes)." ]" : "welcome Guest / ".anchor($obj->config->item('FAL_login_uri'), $obj->lang->line('FAL_login_label'), $login_attributes));
}

// ------------------------------------------------------------------------
/**
 * To display the login form in a view use this function.
 * It can be used directly in a view, or passed to the view assigning it 
 * to a variable from a controller
 * 
 * If the form doesn't validate the user is redirected to the
 * controller auth/login
 * ------------------------------------------------------
 * usage examples:
 * ------------------------------------------------------
 * CASE 2: direct use in a view
 * <?=displayLoginForm()?>
 * 
 * CASE 1: ASSIGNING IT TO A VARIABLE IN A CONTROLLER
 * 
 * $data['mylogin'] = displayLoginForm();
 * $this->load->view('my_view', $data)
 * 
 * 
 * @return the login form output
 */
function displayLoginForm()
{
	$obj =& get_instance();
	$obj->load->library('FAL_front', 'fal_front');
	
    return $obj->fal_front->login();
}

// ------------------------------------------------------------------------
/**
 * Displays the registration form.
 * It can be used directly in a view (suggested), or passed to the view assigning it 
 * to a variable from a controller
 * 
 * If the form doesn't validate the user is redirected to the
 * controller auth/register
 * ------------------------------------------------------
 * usage examples:
 * ------------------------------------------------------
 * CASE 2: direct use in a view
 * <?=displayRegitrationForm()?>
 * 
 * CASE 1: ASSIGNING IT TO A VARIABLE IN A CONTROLLER
 * 
 * $data['myregister'] = displayRegitrationForm();
 * $this->load->view('my_view', $data)
 * 
 *
 * @return the registration form output
 */
function displayRegitrationForm()
{
	$obj =& get_instance();
	$obj->load->library('FAL_front', 'fal_front');
	
    return $obj->fal_front->register();
}
// ------------------------------------------------------------------------
/**
 * sets a flash message using db_session library
 * if you set a message string using a language file, you MUST MAKE SURE
 * the language file has been loaded before calling this helper
 * 
 * EXAMPLE USING A STRING:
 * --------------------------------
 * $msg = "hallo gringo";
 * flashMsg($msg);
 * redirect('', 'location');
 * --------------------------------
 *
 * @param sting $msg
 * @return unknown
 */
function flashMsg($msg)
{
	$obj =& get_instance();
	$obj->db_session->set_flashdata('flashMessage', $msg);
    return true;
}
?>