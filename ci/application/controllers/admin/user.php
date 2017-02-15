<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class User extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('admin/user/profile_v');
	}

	public function profile()
	{
		/**
		* method to change several user personal details
		* 
		*/
		$this->load->model('user_m');

	}

}



?>