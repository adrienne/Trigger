<?php

class Commands_channels
{

	function Commands_channels()
	{
		$this->EE =& get_instance();
		
		// -------------------------------------
		// Load the Channel Structure API
		// -------------------------------------
		// We're using the API for this dealio
		// -------------------------------------
		
		$this->EE->load->library( 'Api' );
		
		$this->EE->api->instantiate( 'channel_structure' );
	}

	// --------------------------------------------------------------------------
	
	/**
	 * Create a channel
	 *
	 * @access	public
	 * @param	array
	 * @return	string
	 */
	public function create_channel( $data )
	{
		// Use the current site ID
		$channel_data['site_id']		= $this->EE->config->item('site_id');
		
		// Get some channel data
		$channel_data['channel_name'] 	= $data['channel_name'];
		$channel_data['channel_title']	= $data['channel_title'];
		
		if( $this->EE->api->create_channel( $channel_data ) ):
		
			return "Channel added successfully.";
			
		else:
		
			return "Error in adding channel.";
		
		endif;
	}
	
	function channels()
	{
		$call = $this->EE->api_channel_structure->get_channels();
		
		if( !$call ):
		
			return "there are no channels";
		
		endif;
		
		$channels = $call->result();
		
		$out = "\n";
		
		foreach( $channels as $channel ):
		
			$out .= "$channel->channel_name => $channel->channel_title\n";
		
		endforeach;
		
		return $out;
	}

}

/* End of file commands.channels.php */
/* Location: ./trigger/core/drivers/channels/commands.channels.php */