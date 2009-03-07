<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Helper for the Random user genertor library
 * 
 * @package     Easyhotspot
 * @subpackage  Helpers
 * @category    User Generation
 * @author      Rafeequl
 * @copyright   Copyright (c) 2008
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @link 		http://easyhotspot.sf.net
 * @version 	1.0
 */
// ------------------------------------------------------------------------
/**
 * This helper is an adoption from phpmyprepaid user/password generator
 *
 */

function generate_random_user(){
	
		
		//generate random user
		$consts='bcdhgklmnprstvwxyz';
        $vowels='aeiou';
        
		$num= (mt_rand(5, 15));
		
		for ($x=0; $x < 6; $x++) {
			$const[$x] = substr($consts,mt_rand(0,strlen($consts)-1),1);
            $vow[$x] = substr($vowels,mt_rand(0,strlen($vowels)-1),1);
		}
	
		$username = ($const[0] . $vow[0] .$const[2] . $const[1] . $vow[1] . $const[3] . $num);
		
		
		//generate random password
		$consts='bcdgklmnprst';
		$vowels='aeiou';

		for ($x=0; $x < 6; $x++) {
		//	mt_srand ((double) microtime() * 1000000); // no longer required
		$const[$x] = substr($consts,mt_rand(0,strlen($consts)-1),1);
		$vow[$x] = substr($vowels,mt_rand(0,strlen($vowels)-1),1);
		}
		
		$password = ($const[0] . $vow[0] .$const[2] . $const[1] . $vow[1] . $const[3] . $vow[3] . $const[4]);
		
		$user['username'] = $username;
		$user['password'] = $password;
		
	
	
		return $user;
}

?>