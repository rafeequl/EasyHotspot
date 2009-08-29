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
		//insert into Billing Plan table but first we (may) need to convert the price to float
		//because in Europe 5 EURO and 60 cents would  be written as 1,60 whereas 5 DOLLARS 60 cent
		//would usually be written as 5.60. We remove the currency_symbol, then the thousands_separator
		//and finally swap the decimal_separator to a period. Now we hopefully have a floating point.
		//Note that if someone inputs an illegal value e.g. 6.70 then it'll end up as 670 euros.

		if ($this->config->item('admin_price_input') == 'converted' ) {
			$_POST['price'] = str_replace($this->config->item('currency_symbol'),"",$_POST['price']);
			$_POST['price'] = str_replace($this->config->item('thousands_separator'),"",$_POST['price']);
			$_POST['price'] = str_replace($this->config->item('decimal_separator'),".",$_POST['price']);
		}

		$this->db->insert($this->_table,$_POST);
		
		//properties
		$data['groupname'] = $_POST['name'];
		
		//insert into radgroupreply table. Currently same for all access_controllers
		//max download speed
		if($_POST['bw_download'] != '') {
			$data['attribute']='WISPr-Bandwidth-Max-Down';
			$data['op']=':=';
			$data['value'] = $_POST['bw_download'];
			
			$this->db->insert($this->_table_radgroupreply,$data);
		}
		
		//max upload speed Currently same for all access_controllers
		if($_POST['bw_upload'] != '') {
			$data['attribute']='WISPr-Bandwidth-Max-Up';
			$data['op']=':=';
			$data['value'] = $_POST['bw_upload'];
			
			$this->db->insert($this->_table_radgroupreply,$data);
		}
		
		//Maximum time - needed by both FreeRadius (at logon) and ChilliSpot (when logged on)
		//Currently same for all access_controllers
		if($_POST['type']=='time'){
			$data['attribute']='Session-Timeout';
			$data['op']=':=';
			$data['value'] = $_POST['amount']*60;
			
			$this->db->insert($this->_table_radgroupcheck,$data);
			$this->db->insert($this->_table_radgroupreply,$data);
		}
		
		//Duplicate the maximum packets needed by both FreeRadius (at logon) and ChilliSpot (when logged on)
		//This is altered according to the access_controllers. 
		if($_POST['type']=='packet'){
			if ($this->config->item('access_controller') == 'chillispot-hc') {
				if ($_POST['amount'] >= 2048) { $_POST['amount'] = 2047; }
				$data['attribute']='ChilliSpot-Max-Total-Octets';
				$data['op']=':=';
				$data['value'] = $_POST['amount']*1024*1024;
				$this->db->insert($this->_table_radgroupcheck,$data);
				$this->db->insert($this->_table_radgroupreply,$data);
			} elseif ($this->config->item('access_controller') == 'coovachilli') {
				$data['attribute']='Max-All-MB';
				$data['op']=':=';
				$data['value'] = $_POST['amount'];
				$this->db->insert($this->_table_radgroupcheck,$data);
				$data['attribute']='ChilliSpot-Max-Total-Gigawords';
				$data['op']=':=';
				$data['value'] = intval ($_POST['amount'] / 4096);
				$this->db->insert($this->_table_radgroupreply,$data);
				// We must now use GMP (GNU Multiple Precision) because PHP doesn't use 
				// unsigned integers but coovachilli considers the ChilliSpot-Max-Total-Octets 
				// to be the bottom 32 bits of an unsigned 64 integer
				$data['attribute']='ChilliSpot-Max-Total-Octets';
				$data['op']=':=';
				$i = gmp_init ($_POST['amount']);
				$i = gmp_mod ($i,4096 );
				$i = gmp_mul ($i, (1024 * 1024));
				$data['value'] = gmp_strval ($i);
				$this->db->insert($this->_table_radgroupreply,$data);
			} else {
				if ($_POST['amount'] >= 2048) { $_POST['amount'] = 2047; }
				$data['attribute']='ChilliSpot-Max-Total-Octets';
				$data['op']=':=';
				$data['value'] = $_POST['amount']*1024*1024;
				$this->db->insert($this->_table_radgroupreply,$data);
				$data['attribute']='Max-All-MB';
				$data['op']=':=';
				$data['value'] = $_POST['amount'];
				$this->db->insert($this->_table_radgroupcheck,$data);
			}
		}
		
		//voucher lifetme Currently same for all access_controllers
		#if($_POST['valid_for'] != ''){
		#	$data['attribute']='Expiration';
		#	$data['op']=':=';
		#	$data['value'] = $_POST['valid_for'];
		#	
		#	$this->db->insert($this->_table_radgroupcheck,$data);
		#}
		
		//Idle-Timeout Currently same for all access_controllers
		if($_POST['IdleTimeout']){
			$data['attribute'] = 'Idle-Timeout';
			$data['op'] = ':=';
			$data['value'] = $_POST['IdleTimeout']*60;
			
			$this->db->insert($this->_table_radgroupreply,$data);
		}

		// Acct-Interim-Interval Currently same for all access_controllers
		if($this->config->item('voucher_acct_interim_interval')){
			$data['attribute'] = 'Acct-Interim-Interval';
			$data['op'] = ':=';
			$data['value'] = $this->config->item('voucher_acct_interim_interval');
			
			$this->db->insert($this->_table_radgroupreply,$data);
		}
		
		//Simultaneous-Use Currently same for all access_controllers
		$data['attribute'] = 'Simultaneous-Use';
		$data['op'] = ':=';
		$data['value'] = '1';
		$this->db->insert($this->_table_radgroupcheck,$data);
		
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
