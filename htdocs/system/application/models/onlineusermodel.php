<?php

Class Onlineusermodel extends model {

	function onlineusermodel(){
		parent::Model();
	
		$this->_table_acct = 'radacct';
	
	}
	
	function get_onlineusers() {
 	// this works no matter what ...I think !!!
		return $this->db->query('select username, MAX(acctstarttime) as start, (acctstoptime) as stop, sum(acctsessiontime) as time,(sum(acctoutputoctets)+sum(acctinputoctets))/1048576 as packet from radacct  where (acctstoptime IS NULL) group by username');
	}

}

?>
	
