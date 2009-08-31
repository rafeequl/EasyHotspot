<?php if (!defined('BASEPATH')) exit('No direct script access permitted.');

class easyhotspot_validation extends CI_Validation
{
	var $CI;
	function easyhotspot_validation()
	{
		parent::CI_Validation();

		log_message('debug','Easyhotspot Validation Library Initialized.');
		$this->CI->load->model('billingplanmodel');
		$this->CI->load->model('postpaidmodel');
		$this->CI->load->model('postplanmodel');
		$this->CI->load->model('vouchermodel');
		
	}
	
	function check_duplicate_username($value){
		//get submited username
		$where = array('username'=>$value);
		$fields = 'username';
		
		//check on the postpaid_account table
		$query = $this->CI->postpaidmodel->getAccount($fields,$where);
		
		//set message if there's duplication
		if($query->num_rows > 0){
			$this->set_message('check_duplicate_username', 'Username '.$value.' has already taken, please choose another');
			return false;
		}else{
			return true;
		}
		
	}
	
	function check_duplicate_billingplan($value){
		//get submited username
		$where = array('name'=>$value);
		$fields = 'name';
		
		//check on the postpaid_account table
		$query = $this->CI->billingplanmodel->getBillingplan($fields,null,$where);
		
		//set message if there's duplication
		if($query->num_rows > 0){
			$this->set_message('check_duplicate_billingplan', 'There is already Billing Plan named '.$value.', please choose another name.');
			return false;
		}else{
			return true;
		}
	}
}

?>