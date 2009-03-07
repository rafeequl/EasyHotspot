<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php

Class StatisticModel extends model {

	function Statisticmodel(){
		parent::Model();
		
	}
	
	function getOnlineUser(){
		//return $this->db->query('select distinct username from radacct where acctstoptime = \'0000-00-00\'');
	}
	
	function getTotalOnlineUser(){
		//return $this->db

	}
}
?>