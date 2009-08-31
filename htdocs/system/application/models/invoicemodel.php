<?php

Class Invoicemodel extends model {

	function invoicemodel(){
		parent::Model();
	
		$this->_table_invoice = 'invoice';
		$this->_table_invoice_detail = 'invoice_detail';
		$this->load->model('postpaidmodel');
	}
	
	function get($fields = null, $where = null, $limit = null){
		($fields != null) ? $this->db->select($fields) :'';
		
		($where != null) ? $this->db->where($where) :'';
		
		($limit != null) ? $this->db->limit($limit['start'],$limit['end']) :'';

		$this->db->order_by('id','desc');

		return $this->db->get($this->_table_invoice);
	}
	
	function getDetail($fields = null, $where = null, $limit = null){
		($fields != null) ? $this->db->select($fields) :'';
		
		($where != null) ? $this->db->where($where) :'';
		
		($limit != null) ? $this->db->limit($limit['start'],$limit['end']) :'';
		
		return $this->db->get($this->_table_invoice_detail);

	}
	
	function insert($username){

		//account
		$accounta = $this->postpaidmodel->getAccountList(null,array('username'=>$username));
		$account = $accounta->row();
		
		//invoice data
		$acc['realname'] = $account->realname;
		$acc['username'] = $account->username;
		($account->bill_by=='time') ? $acc['used'] = $account->time_used :$acc['used'] = $account->packet_used ;
		$acc['bill_by'] = $account->bill_by;
		$acc['date'] = date("Y/m/d");
		($account->bill_by=='time') ? $acc['current_total'] = $account->time_price : $acc['current_total'] = $account->packet_price;
		
		//check if used null
		if($acc['used']==null)
			return false;
		
		//start transaction
		$this->db->trans_start();
		$this->db->insert($this->_table_invoice,$acc);
		
		//invoice detail data
		$account_usage = $this->postpaidmodel->getAccountUsage(null,array('username'=>$username));
		foreach($account_usage->result() as $row){
			$acc_usage['realname'] = $row->realname;
			$acc_usage['username'] = $row->username;
			$acc_usage['start'] = $row->start;
			$acc_usage['stop'] = $row->stop;
			$acc_usage['bill_by'] = $row->bill_by;
			($row->bill_by == 'time') ? $acc_usage['used'] = $row->time_used : $acc_usage['used'] = $row->packet_used;
			($row->bill_by == 'time') ? $acc_usage['total'] = $row->time_price : $acc_usage['total'] = $row->packet_price;
//TODO Need to check this logic in next step -lincoln
			if ($acc_usage['stop'] == null) { $acc_usage['stop'] = $acc_usage['start']; }
			$this->db->insert($this->_table_invoice_detail,$acc_usage);
		}
		
		
		//delete current postpaid account
		$this->postpaidmodel->deleteAccount();
		
		$this->db->trans_complete();
		
		return true;
		
	}
	
	function delete(){
		
		$this->db->trans_start();
		//invoive table
		$this->db->where('username',$this->uri->segment(3));
		$this->db->delete($this->_table_invoice);
		
		//invoice detail table
		$this->db->where('username',$this->uri->segment(3));
		$this->db->delete($this->_table_invoice_detail);		
		//OK stops here
		
		$this->db->trans_complete();
	}
	
	function search($limit = null){
		//search by username or realname
		$this->db->like('username',$this->db_session->userdata('search'));
		$this->db->orlike('realname',$this->db_session->userdata('search'));
		
		//limit
		($limit !=null ) ? $this->db->limit($limit['start'],$limit['end']) :'';
		
		return $this->db->get($this->_table_invoice);
	}

}
