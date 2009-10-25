<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Helper for the radius server
 * 
 * @package     Easyhotspot
 * @subpackage  Helpers
 * @category    Radius helper
 * @author      Rafeequl
 * @copyright   Copyright (c) 2008
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @link 		http://easyhotspot.sf.net
 * @version 	1.0
 */
// ------------------------------------------------------------------------
/**
 * 
 *
 */
 
 
 function freeradius_disconnectuser($username, $radiuscommand, $radiusserver, $radiussecret){
	$ci =& get_instance();
	$result = exec('echo "User-Name=\''.$username.'\'" | '.$radiuscommand.' '.$radiusserver.' disconnect '.$radiussecret);
	$ci->db->query("UPDATE radacct SET acctstoptime=now(), acctterminatecause='Force Disconnect' WHERE username = '$username' and acctstoptime is NULL");
 }
?>
