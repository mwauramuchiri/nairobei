<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends MY_Controller
{

	function __construct ()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		
		//$group = array(1, 3);
		// Login check
		if (!$this->ion_auth->logged_in() | !$this->ion_auth->in_group(1)) {
			/**
			* strictly no idler's
			* tresspassers will be prosecuted
			* or shot
			*
			* - by management
			**/
			redirect('auth/login');
		}
		$this->usr();
	}

	private function usr()
	{
		$usr = $this->ion_auth->user()->row();
		$user_groups = $this->ion_auth->get_users_groups($usr->id)->result();
		$this->data['active_user'] = array(
			'id' => (int)$usr->id,
			'name' => $usr->first_name.' '.$usr->last_name,
			'email' => $usr->email,
			'photo' => $usr->photo,
			'group' => (int)$user_groups[1]->id
			);
	}
}

?>