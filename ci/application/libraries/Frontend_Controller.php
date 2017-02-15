<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Frontend_Controller extends MY_Controller
{

	public $data = array();

	function __construct ()
	{
		parent::__construct();
		
		// Load stuff
		$this->load->model('site_back_m');

		
		// Fetch stuff
		$d = $this->site_back_m->get_current();

		/**
		* use it this way: <body background="<?php echo base_url().$back_image ?>">(in the views)
		*
		*/
		$this->data['back_image'] = $d['image_url'];
	}
}