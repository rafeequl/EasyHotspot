<?php
/**
 * Class Billingplanmodel
 * handles controller Class Billing Plan requests dealing with user table in DB
 * 
 *
 * @package     EasyHotspot
 * @subpackage  Models
 * @category    Billing Plan
 * @author      Rafeequl Rahman Awan
 * @copyright   Copyright (c) 2008, easyhotspot.sf.net
 * @license		http://www.gnu.org/licenses/gpl.html
 * @link 		http://easyhotspot.sourceforge.net
 * @version 	1.0
 */


class Billingplanmodel extends model {
	
	function Billingplanmodel(){
		parent::Model();
		
		//table name
		$this->_table='billingplan';
		$this->_table_radgroupreply = 'radgroupreply';
		$this->_table_radgroupcheck = 'radgroupcheck';
	}
	
	 /**
     * Retrieves all records and all fields (or those passed in the $fields string)
     * from the table billing_plan. It is possible (optional) to pass the wonted fields, 
     * the query limit, and the query WHERE clause.
     *
     * @param string of fields wanted $fields
     * @param array $limit
     * @param string $where
     * @return query string
     */
	function getBillingPlan($fields = null, $limit = null, $where = null){
		
		($fields != null) ? $this->db->select($fields) :'';
		
		($where != null) ? $this->db->where($where) :'';
		
		($limit !=null ) ? $this->db->limit($limit['start'],$limit['end']) :'';
		
		//return the query string
		return $this->db->get($this->_table);
		
	}
	
	/**
	 * Add new billing plan
	 *
	 */
	function addBillingPlan(){
		//insert into Billing Plan table
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
		
		//maximum time
		if($_POST['type']=='time'){
			$data['attribute']='Max-All-Session';
			$data['op']=':=';
			$data['value'] = $_POST['amount']*60;
			
			$this->db->insert($this->_table_radgroupcheck,$data);
		}
		
		//maximum packets being transfered
		if($_POST['type']=='packet'){
			$data['attribute']='Max-All-MB';
			$data['op']=':=';
			$data['value'] = $_POST['amount']*1024*1024;
			
			$this->db->insert($this->_table_radgroupcheck,$data);
		}
		
		//voucher lifetme
		#if($_POST['valid_for'] != ''){
		#	$data['attribute']='Expiration';
		#	$data['op']=':=';
		#	$data['value'] = $_POST['valid_for'];
		#	
		#	$this->db->insert($this->_table_radgroupcheck,$data);
		#}
		
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
	 * Delete billing plan, defined by id on $this->uri->segment()
	 *
	 */
	function deleteBillingPlan(){
		
		$this->db->query('delete billingplan,radusergroup,voucher,radcheck,radgroupreply,radgroupcheck from billingplan left join radusergroup on billingplan.name=radusergroup.groupname left join voucher on billingplan.name = voucher.billingplan left join radcheck on voucher.username = radcheck.username left join radgroupreply on radgroupreply.groupname = billingplan.name left join radgroupcheck on radgroupcheck.groupname = billingplan.name where billingplan.name =\''.$this->uri->segment(5).'\'');		

	}
	
	function getBillingPlanStat(){
	
		return $this->db->query('select b.name as billingplan, if(count(u.groupname) is not null, count(u.groupname),0)as qty from billingplan b left join radusergroup u on b.name=u.groupname group by b.name;');
	}
}
