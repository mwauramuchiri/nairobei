<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Site_back_m extends MY_Model
{
	protected $_table_name = 'backgrounds';
	protected $_order_by = 'id';
	protected $_timestamps = FALSE;

	public function get_current()
	{
		$this->_table_name = 'site_active_background';
		$back =  (array)parent::get_by(array('id' => 1), TRUE);
		$this->_table_name = 'backgrounds';
		if (isset($back['background_id'])) {
			return (array)parent::get_by(array('id'=> (int)$back['background_id']), TRUE);
		} else {
			return null;
		}
		
	}

	public function set_new($id)
	{
		if (!$id) {
			/**
			* This should never happen
			* except in some other parallel universe where the basic rules of logic are different
			* or in a hackers mind so ...
			*/
			return FALSE;
		} else {
			$id = (int)$id;
			$this->_table_name = 'backgrounds';
			/**
			* look for the image, if it exists set it
			*/
			if (parent::get_by(array('id' => $id), TRUE)) {

				$this->_table_name = 'site_active_background';
				return parent::save(array('background_id' => $id),1);

			} else {
				/**
				* the image somehow does not exist!! am puzzled as well 
				* maybe it was delete just before the request was processed
				* throw some generic error message
				* like 'If you're reading this its too late :P'
				*/
				return FALSE;
			}
		}
	}
		

	public function get_all()
	{
		$this->_table_name = 'backgrounds';
		return parent::get();
	}

	public function insert_new($data)
	{
		$this->_table_name = 'backgrounds';
		return parent::save($data, NULL);
	}

	public function delete_img($id)
	{

		return parent::delete($id);
	}

}
?>