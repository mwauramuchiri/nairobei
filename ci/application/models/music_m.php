<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* music_m.php
*/
class Music_m extends MY_Model
{
	protected $_table_name = '';
	protected $_primary_key = 'id';
	protected $_order_by = '';

	public function like($id,$ip,$like)
	{
		//check if they've liked it before
		$this->_table_name = 'music_likes';
		$this->_order_by = 'id';
		$where = array(
			'like_ip_address' => $ip,
			'music_id' => (int)$id
			);
		$data = $where;
		$data['liked'] = $like;
		$this->db->where($where);
		$res = parent::get(NULL,FALSE);
		if (count($res) != 0) {
			$like_id = (int)$res[0]->id;
		} else {
			$like_id = NULL;
		}
		// check if the article exists
		$this->_table_name = 'music';
		$where = array('id' => (int)$id);
		$this->db->where($where);
		$resp = parent::get(NULL,FALSE);
		if(count($resp)){
			$this->_table_name = 'music_likes';
			return parent::save($data,$like_id);
		} else {
			return FALSE;
		}
	}

	public function get_likes($id = NULL, $ip = NULL)
	{
		$this->_table_name = 'music_likes';
		$this->_order_by = 'id';
		//id music_id like_ip_address liked
		$where = array();
		$where['liked'] = 1;
		//return count(parent::get_by($where));
		if ($ip != NULL) {
			$where['like_ip_address'] = $ip;
			$this->db->select('music_id');
			return parent::get_by($where);
		} elseif ($id != NULL) {
			$where['music_id'] = (int)$id;
			$this->db->where($where);
			//return count(parent::get(NULL,FALSE));
			return parent::get(NULL,FALSE);
		} else {
			return NULL;
		}
	}
	public function get($what = NULL, $_I_ = NULL)
	{
		$ret = array();
		$li = array();
		$lis = array();
		if ($what == NULL && $_I_ == NULL) {
			$this->_table_name = 'music_sites';
			$ret[] = parent::get();
			$this->_table_name = 'music';
			$ret[] = parent::get();
			$i = 1;
			while ( $i <= 3) {
				$li = (array)$this->from_json($i,true);
				if (array_key_exists('list', $li)) {
					$lis[] = $li['list'];
				} else {
					$lis[] = null;
				}
				
				$i++;
			};
			$ret[] = $lis;
			return $ret;
		} elseif ($what == NULL && $_I_ != NULL) {
			$this->_table_name = 'music';
			return parent::get($_I_, TRUE);
		} elseif ($what == TRUE && $_I_ != NULL) {
			$this->_table_name = 'music_sites';
			return parent::get($_I_, TRUE);
		} else {
			return NULL;
		}
	}


	public function save($data, $id = NULL,$tbl = NULL)
	{
		if ($tbl) {
			$this->_table_name = $tbl;
		} else {
			$this->_table_name = 'music_active';
		}
		
		return parent::save($data, $id);
	}
	
	private function from_json($id, $s = NULL)
	{
		$dd = null;
		$this->_table_name = 'music_active';
		$d = (array)parent::get((int)$id, TRUE);
		if (isset($d['setting_list'])) {
			$dd = json_decode($d['setting_list']);
		}
		
		if ($s != NULL) {
			return $dd;
		} else  {
			return $this->append_stuff($d['table'],$dd->list);
		}
	}

	private function append_stuff($tbl,$value)
	{
		$this->_table_name = $tbl;
		$ret = array();
		foreach ($value as $val) {
			$dt = (array)parent::get((int)$val, TRUE);
			if (!empty($dt)) {
				$ret[] = $dt;
			} else {
				break;
			}
		}
		return (!empty($ret)) ? $ret : NULL;
	}

	public function get_new($what = NULL)
	{
		$obj = new stdClass();
		switch ($what) {
			case 'site':
				$obj->id = '';
				$obj->name = '';
				$obj->link_to_logo = '';
				$obj->link_to_site = '';
				break;

			case 'music':
				$obj->id = '';
				$obj->title = '';
				$obj->artist = '';
				$obj->embed_link = '';
				$obj->buy_link = '';
				$obj->coment = '';
				break;
			
			default:
				$obj = false;
				break;
		}
		return $obj;
	}
}
?>