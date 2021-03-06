<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Trigger Packages MOdule
 *
 * @package		Trigger
 * @category	packages
 * @author		Addict Add-ons Dev Team
 * @copyright	Copyright (c) 2011, Addict Add-ons
 */

class Package_mdl extends CI_Model
{
	public $folder = 'packages';

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('file', 'directory'));
   }
    
	// --------------------------------------------------------------------------
	
	/**
	 * Get all the packages in the package
	 * folder. /packages
	 *
	 * @access	public
	 * @return	array
	 */
	function get_packages()
	{
		$files = directory_map(TRIGGER_ADDONS_FOLDER.$this->folder.'/', 1);
		
		$return = array();
		
		foreach($files as $file):
		
			if($file != '' and $file != 'index.html'):
			
				if($details = $this->parse_package_details($file)):
			
					$return[$file] = $details;
				
				endif;
			
			endif;
		
		endforeach;
		
		return $return;
	}
	
	// --------------------------------------------------------------------------

	/**
	 * Read and parse the package packages.txt
	 * details file.
	 *
	 * @access	public
	 * @param	slug
	 * @return	mixed
	 */
	public function parse_package_details($package_slug)
	{
		$package_file = TRIGGER_ADDONS_FOLDER.$this->folder.'/'.$package_slug.'/package.txt';
		
		if(!$package_info = read_file($package_file)):
		
			return FALSE;
		
		endif;
		
		// Trim up our details
		$package_info = trim($package_info);
			
		// Break up into lines
		$lines = explode("\n", $package_info);
		
		// Start off info array with slug
		$info = array('slug'=>$package_slug);
		
		// Break up into key/vals
		foreach($lines as $line):
		
			$line_info = explode(":", trim($line), 2);
		
			if(count($line_info)==2):
			
				$info[trim(str_replace(' ', '_', $line_info[0]))] = trim($line_info[1]);
			
			endif;
		
		endforeach;
		
		// See if we have an icon
		
		if(is_file(TRIGGER_ADDONS_FOLDER.$this->folder.'/'.$package_slug.'/icon.png')):
	
			$info['icon'] = $this->config->item('base_url').SYSDIR.'/expressionengine/third_party/trigger/packages/'.$package_slug.'/icon.png';
		
		else:
		
			$info['icon'] = TRIGGER_IMG_URL.'block.png';
		
		endif;
		
		return $info;
	}

	// --------------------------------------------------------------------------

	/**
	 * Get package contents
	 *
	 * @access	public
	 * @param	string
	 * @return	array
	 */
	public function get_package_contents($package)
	{
		$files = directory_map(TRIGGER_ADDONS_FOLDER.'/'.$this->folder.'/'.$package.'/', 2);
		
		$contents = array();
		
		foreach($files as $folder => $file):
					
			// If we have an array of files, see what they are
			if(is_array($file)):
			
				if($folder == 'snippets' or $folder == 'templates'):
				
					$contents[$folder] = $file;
					
				endif;
			
			// Is this a sequence?
			elseif(substr($file, 0, 4) == 'seq.'):
			
				$contents['sequences'][] = $file;
			
			endif;
					
		endforeach;
		
		return $contents;
	}
}

/* End of file package_mdl.php */