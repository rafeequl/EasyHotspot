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

	$result = system('echo "User-Name=\''.$username.'\'" | '.$radiuscommand.' '.$radiusserver.' disconnect '.$radiussecret);
	
 }
?>
