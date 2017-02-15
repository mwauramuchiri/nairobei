<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* article_m
* 
*/
class Article_m extends MY_Model
{
	protected $_table_name = 'articles';
	protected $_order_by = 'id';
	protected $_timestamps = TRUE;
	public $rules = array( 
		'title' => array(
			'field' => 'title', 
			'label' => 'Title', 
			'rules' => 'trim|required|max_length[100]'
		), 
		'slug' => array(
			'field' => 'slug', 
			'label' => 'Slug', 
			'rules' => 'trim|required|max_length[100]|url_title'
		), 
		'body' => array(
			'field' => 'body', 
			'label' => 'Body', 
			'rules' => 'trim|required'
		)
	);


	public function get_new ()
	{
		$article = new stdClass();
		$article->title = '';
		$article->body = '';
		$article->slug = '';
		$article->category = '';
		$article->main_image = '';
		$article->author = 0;
		return $article;
	}


	public function saveme($data,$id)
	{
		/**
		*
		* 	check if author is 0
		* 	if 0 it might bring errors
		*
		* 	i think...
		*
		*/
		//dump($data);

		return parent::save($data,$id);
	}


	public function getmine($usr)
	{
		$this->db->where(array('author' => (int)$usr));
		return parent::get();
	}



}



?>