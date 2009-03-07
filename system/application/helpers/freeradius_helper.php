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
 
 
 function freeradius_disconnectuser($username){
 
 	system('echo \"User-Name=\''.$username.'" | radclient -x 127.0.0.1:3779 disconnect easyhotspot');
 	
 }
