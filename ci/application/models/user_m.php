<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* user_m
*/
class User_m extends MY_Model
{
	protected $_table_name = 'users';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'id';

	public function photo($val = NULL)
	{
		return $val;
	}
}