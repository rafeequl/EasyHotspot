<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Helper for the radius server
 * 
 * @package     Easyhotspot
 * @subpackage  Helpers
 * @category    URL helper
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
 
function anchor($uri = '', $title = '', $attributes = '')
{
	$title = (string) $title;

	if ( ! is_array($uri))
	{
		$site_url = ( ! preg_match('!^\w+://!i', $uri)) ? site_url($uri) : $uri;
	}
	else
	{
		$site_url = site_url($uri);
	}

	if ($title == '')
	{
		$title = $site_url;
	}

	if ($attributes == '')
	{
		$attributes = ' title="'.$title.'"';
	}
	else
	{
		$attributes = _parse_attributes($attributes);
	}

	return '<a href="'.$site_url.'"'.$attributes.'><span>'.$title.'</span></a>';
}
