<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
/**
 * Class Vouchermodel
 * handles controller Class Voucher requests dealing with user table in DB
 * 
 *
 * @package     EasyHotspot
 * @subpackage  Models
 * @category    Voucher
 * @author      Rafeequl Rahman Awan
 * @copyright   Copyright (c) 2008, easyhotspot.sf.net
 * @license		http://www.gnu.org/licenses/gpl.html
 * @link 		http://easyhotspot.sourceforge.net
 * @version 	1.0
 */
Class Vouchermodel extends model {
	function Vouchermodel(){
		parent::Model();
		
	//table name
	$this->_table='voucher_list';
	$this->_table_voucher = 'voucher';
	$this->_table_radcheck = 'radcheck';
	$this->_table_usergroup = 'radusergroup';
	
	$this->load->model('billingplanmodel');
	$this->load->helper('randomuser');

	
	}
	
	function getVoucher($fields = null, $where = null, $limit = null, $order = null){
		($fields != null) ? $this->db->select($fields) :'';
		
		($where != null) ? $this->db->where($where) :'';
		
		($limit != null) ? $this->db->limit($limit['start'],$limit['end']) :'';

		($order != null) ? $this->db->order_by($order['field'],$order['dir']) : $this->db->order_by('id','desc');
		
		return $this->db->get($this->_table);
	}
	
	
	function deleteVoucher(){
		//Start transaction
		$this->db->trans_start();
						
		//Voucher table
		$this->db->where('username',$this->uri->segment(3));
		$this->db->delete($this->_table_voucher);
			
		//usergroup table
		$this->db->where('username',$this->uri->segment(3));
		$this->db->delete($this->_table_usergroup);
				
		//radcheck table
		$this->db->where('username',$this->uri->segment(3));
		$this->db->delete($this->_table_radcheck);
				
		//OK stops here
		
		$this->db->trans_complete();
	}
	
	function editVoucher(){
		//Start transaction
		$this->db->trans_start();
		
		//Voucher table
		$voucher_change = array('password'=>$_POST['password'],'billingplan'=>$_POST['billingplan']);
		$this->db->where('username',$_POST['username']);
		$this->db->update($this->_table_voucher,$voucher_change);
		
		//Radcheck table
		$radcheck_change = array('value'=>$_POST['password']);
		$this->db->where('username',$_POST['username']);
		$this->db->update($this->_table_radcheck,$radcheck_change);
		
		//Usergroup table
		$usergroup_change = array('groupname' => $_POST['billingplan']);
		$this->db->where('username',$_POST['username']);
		$this->db->update($this->_table_usergroup,$usergroup_change);
		
		
		$this->db->trans_complete();
	}
	
	function deleteExpireVoucher(){
		
	}
	
	function generateVoucher(){
		$billingplan_name = $_POST['billingplan'];
		
		$numberofvoucher = $_POST['numberofvoucher'];
		
		$billingplan_detail = $this->billingplanmodel->getBillingPlan(null,null,array('name'=>$billingplan_name));
		if($billingplan_detail->num_rows()>0){
			$billingplan=$billingplan_detail->row();
		
		//insert to database
		for($i=0;$i<$numberofvoucher;$i++){
			$user = generate_random_user();
			$groupname = $billingplan->name;
			$value = $billingplan->amount;
			$valid_for = $billingplan->valid_for;
			
			

			if($this->vouchermodel->VoucherExist($user['username'])){			//check username for duplication 
			
				$i--; //repeat the step
				continue;
			}else {
				//We want everything O.K
				$this->db->trans_start();
				
				//Voucher table
				$voucher = array('username'=>$user['username'],'password'=>$user['password'],'billingplan'=>$groupname);
				$this->db->insert($this->_table_voucher,$voucher);
			
				//usergroup table
				$usergroup = array('username'=>$user['username'],'groupname'=>$groupname,'priority'=>'1');
				$this->db->insert($this->_table_usergroup,$usergroup);
				
				//radcheck table
				$radcheck = array('username'=>$user['username'],'attribute'=>'Cleartext-Password','op'=>':=','value'=>$user['password']);
				$this->db->insert($this->_table_radcheck,$radcheck);
				
				//Expiration with format = November 28 2007 20:26:43
				$month = date('F');
				$day = date('j');
				$year = date('Y');
				$time = '24:00:00';
				
				$date = mktime(0,0,0, date('m'), $day+$valid_for, $year);
				
				$date = date("F j Y", $date)." ".$time;
				$radcheck = array('username'=>$user['username'],'attribute'=>'Expiration','op'=>':=','value'=>$date);
				$this->db->insert($this->_table_radcheck,$radcheck);
				
				//OK stops here
				$this->db->trans_complete();
			}
			

		}
		
		}
	}
	
	
	function setPrintedVoucher(){
		$this->db->where('username',$this->uri->segment(3));
		$this->db->update($this->_table_voucher,array('isprinted'=>'1'));
	}
	
	function searchVoucher($limit = null){
		//search by username or realname
		$this->db->like('username',$this->db_session->userdata('search'));
		
		//limit
		($limit !=null ) ? $this->db->limit($limit['start'],$limit['end']) :'';
		
		return $this->db->get($this->_table);
	
	}
	
	function VoucherExist($username){
		$query=$this->vouchermodel->getVoucher(null,array('username'=>$username));
		
		if($query->num_rows > 0)
			return true;
		else 
			return false;
	}
	
	function getVoucherStatistics(){
		//get voucher list
		$vouchers = $this->vouchermodel->getVoucher();
		$data['created'] = $vouchers->num_rows;
		
		//get used voucer
		$voucher_used = $this->db->query('select*from voucher_list where time_used is not NULL');
		$data['used'] = $voucher_used->num_rows();
		
		//get expired user
		$expired = $this->vouchermodel->getVoucher(null,array('valid'=>'exp'));
		$data['expired'] = $expired->num_rows();
		
		
		return $data;
	}
	
}
