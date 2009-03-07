<?php
/**
 * Class Usermodel
 * handles controller Class FreakAuth requests dealing with user table in DB
 * 
 *
 * @package     FreakAuth_light
 * @subpackage  Models
 * @category    Authentication
 * @author      Daniel Vecchiato (danfreak)
 * @copyright   Copyright (c) 2007, 4webby.com
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @link 		http://4webby.com/freakauth
 * @version 	1.1
 */


class Userprofile extends Model 
{
	
	// ------------------------------------------------------------------------
	/**
	 * initialises the class inheriting the methods of the class Model 
	 *
	 * @return Usermodel
	 */
    function Userprofile()
    {     
        parent::Model();
        
        //FreakAuth_light table prefix
        $this->_prefix = $this->config->item('FAL_table_prefix');
        $this->_table = $this->_prefix.'user_profile';
    }
	
    // ------------------------------------------------------------------------
    
    /**
     * From the parameter $id from the table user 
     * retrieves the username and returns it as a string
     * 
     * @param integer $id
     * @return string (username)
     */
	function getUserProfileById($id)
	{	
		//SELECT name FROM user WHERE id = $id 
		$this->db->where('id', $id);
        
		//returns the username
		return $this->db->get($this->_table);
	}
	
		
	// ------------------------------------------------------------------------
	
	/**
	 * After pressing the activation link in the e-mail gets the user_temp fields and inserts the values into the user table
	 * (new registered user)
	 *
	 * @param unknown_type $id
	 */
	function insertUserProfile($data)
	{
        $this->db->insert($this->_table, $data);
	}
	
    
    // ------------------------------------------------------------------------
    
    function getTableFields()
    {
    	return $this->db->list_fields($this->_table);
    }
    
    // ------------------------------------------------------------------------
    
    function updateUserProfile($id, $data)
    {	
    	$this->db->where('id', $id);
    	$this->db->update($this->_table, $data);
    }

	    // ------------------------------------------------------------------------
	
	/**
	 * deletes the user by 'id' field
	 *
	 * @param profile id field 
	 */
	function deleteUserProfile($id)
	{
        $this->db->where('id', $id);
        $this->db->delete($this->_table);
	}
}
?>