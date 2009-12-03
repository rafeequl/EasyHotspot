<?php

Class Onlineusermodel extends model {

	function onlineusermodel(){
		parent::Model();
	
		$this->_table_acct = 'radacct';
	
	}
	
	function get_onlineusers() {
 	// this works no matter what ...I think !!!
		// return $this->db->query('select username, MAX(acctstarttime) as start, MAX(acctstoptime) as stop, sum(acctsessiontime) as time,sum(acctoutputoctets)+sum(acctinputoctets) as packet from radacct group by username having (start > stop) or (stop IS NULL)');
		return $this->db->query('select username, MAX(acctstarttime) as start, (acctstoptime) as stop, sum(acctsessiontime) as time,sum(acctoutputoctets)+sum(acctinputoctets) as packet from radacct  where (acctstoptime IS NULL) group by username');
	}

}

?>
	
