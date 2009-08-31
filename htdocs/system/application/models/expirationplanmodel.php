<?php
/**
 * Class Expiration
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
 * @version 	0.2
 */

Class Expirationplanmodel extends model{
	function Expirationplanmodel(){
		parent::Model();
		
		//table name
		$this->_table='expirationplan';
		$this->_table_radgroupreply = 'radgroupreply';
		$this->_table_radgroupcheck = 'radgroupcheck';
	}
	
	/**
	 * get all fields from the postplan table
	 *
	 * @param string $fields
	 * @param integer $limit
	 * @param string $where
	 * @return array
	 */
	function getExpirationPlan($fields = null, $limit = null, $where = null){ 
		($fields != null) ? $this->db->select($fields): '';
		($limit != null) ? $this->db->limit($limit): '';
		($where != null) ? $this->db->where($where): '';
		
		return $this->db->get($this->_table);
	}
	
	
	/**
	 * Save changes the prices
	 *
	 */
	
	function save(){
		//insert into Expiration Plan table
		$this->db->insert($this->_table,$_POST);
		
		//properties
		$data['groupname'] = $_POST['name'];
		
		//insert into radgroupreply table
		//max download speed
		if($_POST['bw_download'] != '') {
			$data['attribute']='WISPr-Bandwidth-Max-Down';
			$data['op']=':=';
			$data['value'] = $_POST['bw_download']*1000;
			
			$this->db->insert($this->_table_radgroupreply,$data);
		}
		
		//max upload speed
		if($_POST['bw_upload'] != '') {
			$data['attribute']='WISPr-Bandwidth-Max-Up';
			$data['op']=':=';
			$data['value'] = $_POST['bw_upload']*1000;
			
			$this->db->insert($this->_table_radgroupreply,$data);
		}
		
		//account expiration
		if($_POST['type']=='valid_untill'){
			$data['attribute']='Expiration';
			$data['op']=':=';
			$data['value'] = $_POST['bw_upload']*1000;
			
			$this->db->insert($this->_table_radgroupreply,$data);
		}
		
		//maximum packets being transfered
		if($_POST['type']=='packet'){
			$data['attribute']='Max-All-MB';
			$data['op']=':=';
			$data['value'] = $_POST['amount']*1024*1024;
			
			$this->db->insert($this->_table_radgroupcheck,$data);
		}
		
		//Idle-Timeout
		if($_POST['IdleTimeout']){
			$data['attribute'] = 'Idle-Timeout';
			$data['op'] = ':=';
			$data['value'] = $_POST['IdleTimeout']*60;
			
			$this->db->insert($this->_table_radgroupreply,$data);
		}
		
		//Simultaneous-Use
		$data['attribute'] = 'Simultaneous-Use';
		$data['op'] = ':=';
		$data['value'] = '1';
		$this->db->insert($this->_table_radgroupcheck,$data);
		
		//Accounting status update inteval
		//FreeRadius will update the accounts usage information within the given time (in sec)
		$data['attribute'] = 'Acct-Interim-Interval';
		$data['op'] = ':=';
		$data['value'] = '120';
		$this->db->insert($this->_table_radgroupreply,$data);
	}
	
	/**
	 * Delete expiration plan, defined by id on $this->uri->segment()
	 *
	 */
	function deleteExpirationPlan(){
		
		$this->db->query('delete expirationplan,radusergroup,voucher,radcheck,radgroupreply,radgroupcheck from expirationplan left join radusergroup on expirationplan.name=radusergroup.groupname left join voucher on expirationplan.name = voucher.billingplan left join radcheck on voucher.username = radcheck.username left join radgroupreply on radgroupreply.groupname = expirationplan.name left join radgroupcheck on radgroupcheck.groupname = expirationplan.name where expirationplan.name =\''.$this->uri->segment(5).'\'');		

	}
	
}