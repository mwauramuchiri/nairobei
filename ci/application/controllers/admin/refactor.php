<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*
* refactor.php
* what is it that your heart really desires?
*
*/
class Refactor extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function _remap()
	{
		if ($this->ion_auth->in_group(3)) {
			# super admin
			redirect('admin/site','refresh');
		} elseif ($this->ion_auth->in_group(4)) {
			# history admin
			redirect('admin/article','refresh');
		} elseif ($this->ion_auth->in_group(5)) {
			# gava admin
			redirect('admin/article','refresh');
		} elseif ($this->ion_auth->in_group(6)) {
			# music admin
			redirect('admin/music','refresh');
		}
	}
}

?>