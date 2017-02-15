<?php

/**
* gava_ad_m.php
* 
* functionality for creation and management of government content
*
*/

class Gava_ad_m extends MY_Model
{
	protected $_table_name = 'gava_ads';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'id';
	
	/*public function edit($data,$id = NULL)
	{
		return parent::save($data, $id);
	}*/

	/*public function get($id = NULL, $single = FALSE)
	{

	}*/
	public function advertise($val)
	{
		$t = parent::get(NULL,FALSE);
		foreach ($t as $k) {
			if ((int)$k->id == (int)$val) {
				parent::save(array('active' => 1),(int)$k->id);
			} else {
				parent::save(array('active' => 0),(int)$k->id);
			}	
		}
	}
	
	public function get_new ()
	{
		//id text link image_link active 
		$advert = new stdClass();
		$advert->text = '';
		$advert->link = '';
		$advert->image_link = '';
		return $advert;
	}

	public function client_side_get()
	{
		$this->db->where(array('active' => 1));
		return parent::get();
	}

}

?>