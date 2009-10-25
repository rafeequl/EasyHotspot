<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CONFIGURATION ARRAY FOR THE Easyhotspot library
 *
 * @package     easyhotspot
 * @subpackage  Config
 * @category    Configuration
 * @author      Rafeequl Rahman Awan (rafeequl@gmail.cm)
 * @copyright   Copyright (c) 2007, rafeequl rahman awan
 * @license     http://www.gnu.org/licenses/gpl.txt
 * @link        http://easyhotspot.sourceforge.net
 * @version     0.1
 */

$config['EASYHOTSPOT_VERSION']='0.2';
$config['EASYHOTSPOT_THEME']='default';

$config['CHILLISPOT_COFIG_FILE']='/etc/chilli.conf';

#$config['access_controller'] = 'chillispot-hc';

$config['company_name'] = 'EasyHotspot OpenSource';
$config['company_address_line1'] = 'Legian Street';
$config['company_address_line2'] = 'Kuta';
$config['company_address_line3'] = 'Bali - Indonesia';
$config['company_phone'] = '+62 231 999999';

$config['currency_symbol'] = '$ ';
$config['currency_symbol_pdf'] = '$ ';
$conifg['company_tax_code'] = '';
$config['admin_price_input'] = 'converted';
$config['thousands_separator'] = ',';
$config['decimal_separator'] = '.';
$config['decimal_places'] = '2';

$config['CHILLISPOT_CONFIG_FILE'] = '/etc/chilli.conf';

$config['postpaid_acct_interim_interval'] = '120';
$config['voucher_acct_interim_interval'] = '120';

//Freeradius
$config['radiusserver'] = '127.0.0.1:3799';
$config['radiuscommand'] = 'radclient -x';
$config['radiussecret'] = 'easyhotspot';

?>
