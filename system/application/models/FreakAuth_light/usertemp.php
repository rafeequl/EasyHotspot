<?php
/**
 * Class UserTemp
 * handles controller Class FreakAuth requests dealing with user_temp table in DB
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


class UserTemp extends Model 
{
	
	// ------------------------------------------------------------------------
	/**
	 * initialises the class inheriting the methods of the class Model 
	 *
	 * @return User_tempmodel
	 */
    function UserTemp()
    {        
        parent::Model();
        
        //FreakAuth_light table prefix
        $this->_prefix = $this->config->item('FAL_table_prefix');
        $this->_table = $this->_prefix.'user_temp';
    }
	
    /**
     * Retrieves all records and all fields (or those passed in the $fields string)
     * from the table user_temp
     *
     * @param string of fields wanted $fields
     * @param array $limit
     * @return query string
     */
	function getUserTemp($fields=null, $limit=null, $where=null)
	{	
		($fields != null) ? $this->db->select($fields) :'';
		
		($where != null) ? $this->db->where($where) :'';
		
		($limit != null ? $this->db->limit($limit['start'], $limit['end']) : '');
        
		//returns the username
		return $this->db->get($this->_table);
	}
	
	    /**
     * Retrieves all records and all fields (or those passed in the $fields string)
     * from the table user_temp
     *
     * @param array $where
     * @return query string
     */
	function getUserTempWhere($fields=null, $where=null)
	{	
		($fields != null) ? $this->db->select($fields) :'';
		
		($where != null) ? $this->db->where($where) :'';
        
		//returns the username
		return $this->db->get($this->_table);
	}
		
    // ------------------------------------------------------------------------
	
	/**
	 * Insert values in user_temp table after the first registration wizard
	 *
	 * @param array $values
	 * @todo merge this function with function updateUserForRegistration
	 */
	function insertUserForRegistration($values)
	{
	   /* foreach($values as $key=>$value)
            
	    	$this->db->set($key, $value);*/
        
        $this->db->insert($this->_table, $values);
	}
	
	/**
	 * Queries the usertemp table to get user data (login and password)
	 *
	 * @param varchar $username
	 * @param varchar $password
	 * @return array
	 */
	function getUserLoginData($username, $password)
	{	
		$this->db->where('user_name', $username);
        $this->db->where('password', $password);
        
        return $this->db->get($this->_table);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Finds the user that needs to bee activate after he pressed
	 * the activation link in the e-mail
	 *
	 * @param integer $id
	 * @param varchar $activation_code
	 * @return unknown
	 */
	function getUserForActivation($id, $activation_code)
	{	
		// WHERE id = $id
		$this->db->where('id', $id);
		//AND activation_code = $activation_code
        $this->db->where('activation_code', $activation_code);
               
        return $this->db->get($this->_table);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Deletes the user_temp record
	 * it's used to delete the record after activation while moving it 
	 * to the user table
	 *
	 * @param integer $id
	 */
	function deleteUserAfterActivation($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->_table); 
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Needed by the library FreakAuth function cleanExpiredUserTemp()
	 *
	 * @return unknown
	 */
	function getUserTempCreated()
	{	
		return $this->db->query('SELECT id AS id, UNIX_TIMESTAMP(created) AS created FROM '.$this->_table);
		 
	}
		
}
?>