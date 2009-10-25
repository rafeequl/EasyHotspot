<?php
/**
 * Class Postplanmodel
 * handles controller Class Postpaid Plan requests dealing with user table in DB
 * 
 *
 * @package     EasyHotspot
 * @subpackage  Models
 * @category    Postpaid Plan
 * @author      Rafeequl Rahman Awan
 * @copyright   Copyright (c) 2009, easyhotspot.sf.net
 * @license		http://www.gnu.org/licenses/gpl.html
 * @link 		http://easyhotspot.sourceforge.net
 * @version 	1.0
 */

Class Postplanmodel extends model{
	function Postplanmodel(){
		parent::Model();
		
		//table name
		$this->_table='postplan';
		$this->_table_postpaid_account = 'postpaid_account';
		$this->_table_radreply = 'radreply';
	}
	
	/**
	 * get all fields from the postplan table
	 *
	 * @param string $fields
	 * @param integer $limit
	 * @param string $where
	 * @return array
	 */
	function getPostPlan($fields = null, $limit = null, $where = null){ 
		($fields != null) ? $this->db->select($fields): '';
		($limit != null) ? $this->db->limit($limit): '';
		($where != null) ? $this->db->where($where): '';
		
		return $this->db->get($this->_table);
	}
	
	/**
	 * Retrive price /byte 
	 *
	 * @return array
	 */
	
	function getPerByte(){
		$this->db->select('price');
		$this->db->where('name=\'packet\'');
		
		return $this->db->get($this->_table);

		
	}	
	
	/**
	 * Retrive price /minute 
	 *
	 * @return array
	 */
	function getPerMinute(){
		$this->db->select('price');
		$this->db->where('name=\'time\'');
		
		return $this->db->get($this->_table);

		
	}
	
	function getIdleTimeout(){
		$this->db->select('price');
		$this->db->where('name=\'idletimeout\'');
		
		return $this->db->get($this->_table);
		
	}
	
	function getDownloadRate(){
		$this->db->select('price');
		$this->db->where('name=\'bw_download\'');
		
		return $this->db->get($this->_table);
		
	}
	
	function getUploadRate(){
		$this->db->select('price');
		$this->db->where('name=\'bw_upload\'');
		
		return $this->db->get($this->_table);
		
	}
	
	/**
	 * Save changes the prices
	 *
	 */
	
	function save(){
		//update price perminute
		$time=array('price'=>$_POST['time']);
		$this->db->where('name','time');
		$this->db->update($this->_table,$time);
		
		
		//update price perbyte
		$packet=array('price'=>$_POST['packet']);
		$this->db->where('name','packet');
		$this->db->update($this->_table,$packet);
		
		//update idle timeout
		$packet=array('price'=>$_POST['idletimeout']);
		$this->db->where('name','idletimeout');
		$this->db->update($this->_table,$packet);
		
		//update download rate
		$packet=array('price'=>$_POST['bw_download']);
		$this->db->where('name','bw_download');
		$this->db->update($this->_table,$packet);
		
		//update upload rate
		$packet=array('price'=>$_POST['bw_upload']);
		$this->db->where('name','bw_upload');
		$this->db->update($this->_table,$packet);
		
		$postpaid_accounts = $this->db->get($this->_table_postpaid_account);
		
		foreach ($postpaid_accounts->result() as $account) {
			//update radreply value
			
			//update bw_download
			$where = array('username' => $account->username, 'attribute' => 'WISPr-Bandwidth-Max-Down');
			$value = array('value' => $_POST['bw_download']);
			$this->db->where($where);
			$this->db->update($this->_table_radreply,$value);
			
			//update bw_upload
			$where = array('username' => $account->username, 'attribute' => 'WISPr-Bandwidth-Max-Up');
			$value = array('value' => $_POST['bw_upload']);
			$this->db->where($where);
			$this->db->update($this->_table_radreply,$value);
			
			//update IdleTimeout
			$where = array('username' => $account->username, 'attribute' => 'Idle-Timeout');
			$value = array('value' => $_POST['idletimeout']*60);
			$this->db->where($where);
			$this->db->update($this->_table_radreply,$value);
			
		}
		
	}
	
}