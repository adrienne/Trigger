<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Trigger Vars Class
 *
 * Contains Trigger variables.
 *
 * @package		Trigger
 * @author		Addict Add-ons Dev Team
 * @copyright	Copyright (c) 2010 - 2011, Addict Add-ons
 * @license		
 * @link		
 */

class Vars
{

	function Vars()
	{
		$this->EE =& get_instance();		
	}

	// --------------------------------------------------------------------------
	
	/**
	 * Server Path
	 *
	 * Returns the server path to the ee root
	 *
	 * @access	public
	 * @return	string
	 */
	public function server_root()
	{
		$server = $_SERVER["SCRIPT_FILENAME"];
		
		$server = str_replace('/'.SYSDIR.'/index.php', '', $server);
		
		return $server;
	}

	// --------------------------------------------------------------------------
	
	/**
	 * App Server Path
	 *
	 * Returns the 'expressionengine' server path
	 *
	 * @access	public
	 * @return	string
	 */
	public function app_path()
	{
		$server = str_replace('index.php', '', $_SERVER["SCRIPT_FILENAME"]);
	
		return $server.'expressionengine';
	}

	// --------------------------------------------------------------------------
	
	/**
	 * Server Name
	 *
	 * Returns the name of the server from SERVER_NAME
	 *
	 * @access	public
	 * @return	string
	 */
	public function server_name()
	{
		return $_SERVER["SERVER_NAME"];
	}

	// --------------------------------------------------------------------------
	
	/**
	 * License Number
	 *
	 * Returns the name of the EE license number
	 *
	 * @access	public
	 * @return	string
	 */
	public function license()
	{
		$key = $this->EE->config->item('license_number');
	
		if(!$key):
		
			return "license is empty";
		
		else:
		
			return $key;
		
		endif;
	}

	// --------------------------------------------------------------------------
	
	/**
	 * Debug Level
	 *
	 * Returns the current debug level
	 *
	 * @access	public
	 * @return	string
	 */
	public function debug_level()
	{
		return $this->EE->config->item('debug');
	}

	// --------------------------------------------------------------------------
	
	/**
	 * Site Name
	 *
	 * Returns the current debug level
	 *
	 * @access	public
	 * @return	string
	 */
	public function site_name()
	{
		return $this->EE->config->item('site_name');
	}

	// --------------------------------------------------------------------------
	
	/**
	 * Auto Base URL
	 *
	 * Figures out the base URL.
	 * For use with setting values
	 *
	 * @access	public
	 * @return	string
	 */
	public function auto_base_url()
	{
		$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$base_url .= "://".$_SERVER['HTTP_HOST'];
		$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']); 
		
		// Remove the system dir.
		$base_url = str_replace('/'.SYSDIR.'/', '', $base_url);
	
		return $base_url;
	}

}

/* End of file commands.php.php */
/* Location: ./trigger/core/drivers/php/commands.php.php */