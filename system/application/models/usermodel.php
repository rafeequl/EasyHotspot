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


class Usermodel extends Model 
{
	
	// ------------------------------------------------------------------------
	/**
	 * initialises the class inheriting the methods of the class Model 
	 *
	 * @return Usermodel
	 */
    function Usermodel()
    {     
        parent::Model();
        
        //FreakAuth_light table prefix
        $this->_prefix = $this->config->item('FAL_table_prefix');
        $this->_table=$this->_prefix.'user';
    }
	
        // ------------------------------------------------------------------------
    
    /**
     * Retrieves all records and all fields (or those passed in the $fields string)
     * from the table user. It is possible (optional) to pass the wonted fields, 
     * the query limit, and the query WHERE clause.
     *
     * @param string of fields wanted $fields
     * @param array $limit
     * @param string $where
     * @return query string
     */
	function getUsers($fields=null, $limit=null, $where=null)
	{	
		($fields != null) ? $this->db->select($fields) :'';
		
		($where != null) ? $this->db->where($where) :'';
		
		($limit != null ? $this->db->limit($limit['start'], $limit['end']) : '');
        
		//returns the query string
		return $this->db->get($this->_table);
	}
	
	// ------------------------------------------------------------------------
    
    /**
     * Retrieves all records and all fields (or those passed in the $fields string)
     * from the table user. It is possible (optional) to pass the wonted fields, 
     * the query limit.
     * The query WHERE clause is set to retrieve only users with role 'admin' and 'superadmin'
     *
     * @param string $fields
     * @param array $limit
     * @return query string
     */
	function getAdmins($fields=null, $limit=null)
	{	
		$fields!=null ? $this->db->select($fields) :'';
        $this->db->where("role='admin' OR role='superadmin'");
		
		($limit != null ? $this->db->limit($limit['start'], $limit['end']) : '');

		//returns the query
		return $this->db->get($this->_table);
	}
	
	// ------------------------------------------------------------------------
    
    /**
     * From the parameter $id from the table user 
     * retrieves the username and returns it as a string
     * 
     * @param integer $id
     * @return string (username)
     */
	function getUserById($id)
	{	
		//SELECT name FROM user WHERE id = $id 
		$this->db->where('id', $id);
        
		//returns the query string
		return $this->db->get($this->_table);
	}
	

	// ------------------------------------------------------------------------
	
	/**
	 * Finds the user that requested a password_remind
	 * 
	 * @param varchar $email
	 * @return array
	 * @todo change it and make it look for the username instead
	 * @todo make it throw an error message if results <=0
	 */
	function getUserForForgottenPassword($email)
	{
		//WHERE email = $email
	    $this->db->where('email', $email);
	    
	    //SELECT * FROM user
        return $this->db->get($this->_table);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Finds the user that requested a password_remind
	 * after clicking on the reset link
	 *
	 * @param integer $id
	 * @param varchar $activation_code
	 * @return array
	 */
	
	function getUserForForgottenPasswordReset($id, $activation_code)
	{
		$this->db->where('id', $id);
        $this->db->where('forgotten_password_code', $activation_code);
        
        return $this->db->get($this->_table);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Queries the user table to get user data (login and password)
	 *
	 * @param varchar $username
	 * @param varchar $password
	 * @return array
	 */
	function getUserForLogin($username, $password)
	{	
		$this->db->where('user_name', $username);
        $this->db->where('password', $password);
        
        return $this->db->get($this->_table);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Queries the user table to get user data (login and password)
	 *
	 * @param varchar $username
	 * @param varchar $password
	 * @return array
	 */
	function getUserByUsername($username)
	{	
		$this->db->where('user_name', $username);
        
        return $this->db->get($this->_table);
	}
		
	// ------------------------------------------------------------------------
	
	/**
	 * Inserts the values into the user table)
	 *
	 * @param unknown_type $id
	 */
	function insertUser($data)
	{
        $this->db->insert($this->_table, $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Updates the user activation_code when he request a new password
	 *
	 * @param integer $id
	 * @param varchar $activation_code
	 * @todo its redundant: it's the same than function updateUserForRegistration($id, $activation_code)
	 */
	function updateUserForForgottenPassword($id, $activation_code)
	{
	    $this->db->set('forgotten_password_code', $activation_code);
        $this->db->where('id', $id);
        $this->db->update($this->_table);
	}
	
	// ------------------------------------------------------------------------
	/**
	 * Updates the user password
	 * Resets to '' the forgotten password code field
	 *
	 * @param integer $id
	 * @param varchar $encrypted_password
	 */
	function updateUserForForgottenPasswordReset($id, $encrypted_password)
	{
	    $this->db->set('password', $encrypted_password);
        $this->db->set('forgotten_password_code', null);
        $this->db->where('id', $id);
        $this->db->update($this->_table);
    }
    
    // ------------------------------------------------------------------------
    
    /**
     * After the user registered and after inserting the first values with the function insertUserForRegistration()
     * it updates the activation_code field inserting a random code
     *
     * @param unknown_type $id
     * @param unknown_type $activation_code
     */
    function updateUserForRegistration($id, $activation_code)
    {
        $this->db->set('activation_code', $activation_code);
        $this->db->where('id', $id);
        $this->db->update($this->_table);
    }
    
    // ------------------------------------------------------------------------

    /**
     * Updates the user last_visit field after login
     *
     * @param integer $id
     */
    function updateUserForLogin($id)
    {
        $this->db->set('last_visit', date ("Y-m-d H:i:s"));
        $this->db->where('id', $id);
        $this->db->update($this->_table);
    }
    
    // ------------------------------------------------------------------------
	
	/**
	 * Updates the user by $where array condition
	 *
	 * @param array with where condition 'table_field'=>'value' $where
	 * @param array with 'table_field'=>'value' of data to update $data
	 */
	function updateUser($where, $data)
	{
        $this->db->where($where);
        $this->db->update($this->_table, $data);
	}
	
	    // ------------------------------------------------------------------------
	
	/**
	 * Deletes the user by $id (primary key in the table)
	 *
	 * @param integer for the "where id='$id'" condition
	 */
	function deleteUser($id)
	{
        $this->db->where('id', $id);
        $this->db->delete($this->_table);
	}
}
?>