<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* hhigfilr
*/


class Blog_m extends MY_Model
{
	protected $_table_name = 'articles';
	protected $_order_by = 'created desc';
	protected $_timestamps = FALSE;
	
	public function get($id = NULL, $single = FALSE)
	{
		return parent::get($id,$single);
	}

	public function like($id,$ip,$like)
	{
		$this->_table_name = 'articles_likes';
		$this->_order_by = 'id';
		// check if the user has liked the article
		$where = array(
			'like_ip_address' => $ip,
			'article_id' => (int)$id
			);
		$data = $where;
		$data['liked'] = $like;
		$res = parent::get_by($where);

		if (count($res) != 0) {
			//they've liked this post before
			$like_id = (int)$res[0]->id;
		} else {
			$like_id = NULL;
		}
		// check if the article exists
		$this->_table_name = 'articles';
		$where = array('id' => (int)$id);
		if(count(parent::get_by($where))){
			$this->_table_name = 'articles_likes';
			return parent::save($data,$like_id);
		} else {
			return FALSE;
		}
		
	}

	public function get_likes($id = NULL, $ip = NULL)
	{
		$this->_table_name = 'articles_likes';
		$this->_order_by = 'id';
		//id article_id like_ip_address liked
		$where = array();
		$where['liked'] = 1;
		//return count(parent::get_by($where));
		if ($ip != NULL) {
			$where['like_ip_address'] = $ip;
			$this->db->select('article_id');
			return parent::get_by($where);
		} elseif ($id != NULL) {
			$where['article_id'] = (int)$id;
			return count(parent::get_by($where));
		} else {
			return NULL;
		}
	}

	public function append_author($data)
	{
		$this->_table_name = 'users';
		$this->_order_by = 'id';
		// username email first_name last_name photo 
		$this->db->select('username,email,first_name,last_name,photo');
		$this->db->where('id', (int)$data->author);
		$data->author = (array)parent::get(NULL,TRUE);
		return $data;
	}

	public function get_articles($cat = NULL,$lim = NULL)
	{
		$this->_table_name = 'articles';
		$where = array();
		$where['type'] = 1;
		if ($cat != NULL) {
			$where['category'] = $cat;
		};
		if ($lim != NULL) {
			if ($lim == 1) {
				return parent::get_by($where,TRUE);
			} else {
				$this->db->limit($lim);
			}
		}
		return parent::get_by($where);
	}

}


?>