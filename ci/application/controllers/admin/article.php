<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* access: any kind of admin
*/
class Article extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$group = array(3,4,5);
		if (!$this->ion_auth->in_group($group)) {
			redirect('admin','refresh');
		}
		$this->load->model('article_m');
		
	}

	public function index()
	{
		/**
		*
		*	TODO: - create a view with links to the various functionalities
		*		  - the view should also display all user articles
		*
		*/
		//echo "remember: when in doubt use full throttle, it might not deal with the problem, but the doubt will go away :)";
		$this->data['my_articles'] = array();
		$my_articles = $this->article_m->getmine($this->data['active_user']['id']);
		foreach ($my_articles as $article) {
			$this->data['my_articles'][] = (array)$article;
		}
		$this->load->view('admin/article/mine_v',$this->data);
	}

	private function upload()
	{
		$config['upload_path'] = './tinymce/blog_media/';
		$config['max_size'] = 2048000;
		$config['overwrite'] = FALSE;
		$config['encrypt_name'] = TRUE;
		$config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff';
		$this->load->library('upload',$config);

		if ( !$this->upload->do_upload('main_image')) {
			/**
			* if youre reading this its too late
			*/

			$this->data['upload_error'] = $this->upload->display_errors();
			return FALSE;
		} else {
			$img_data = $this->upload->data();
			$dtails = '/tinymce/blog_media/'.$img_data['file_name'];
			return($dtails);

		}
	}


	private function section()
	{
		if (!isset($this->data['article']->category)) {

			if ($this->ion_auth->in_group('super_admin'))
			{
				$this->data['article']->category = '';
			} else {
				if ($this->ion_auth->in_group('histo_admin')){
					$this->data['article']->category = 'history';
				} elseif ($this->ion_auth->in_group('gava_admin')) {
					$this->data['article']->category = 'gava_kilo_nusu';
				}
			}
			//dump($this->data['article']->category);
		} /*else {
			dump($this->data['article']->category);
		}*/
	}

	/**
	* For creating and editing blog articles
	* 
	*/
	public function edit($id = NULL)
	{
		// Fetch a article or set a new one
		if ($id) {
			if (!$this->article_m->get($id)) {
				show_404();
			}
			$this->data['article'] = $this->article_m->get($id);
			count($this->data['article']) || $this->session->set_flashdata('article_err', 'That article is non existent');
			$edit = TRUE;

		} else {
			$edit = FALSE;
			$this->data['article'] = $this->article_m->get_new();
			$this->section();
		}

		//Set the validation rules
		$rules = $this->article_m->rules;
		$this->form_validation->set_rules($rules);
		

		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$post = $this->input->post();

			$data = $this->article_m->array_from_post(array(
				'title', 
				'body', 
				'slug', 
				'category',
			));
			if (!$edit) {

				if ($this->ion_auth->get_user_id()) {

					$data['author'] = (int)$this->ion_auth->get_user_id();

				} else { 

					return show_error("

					 	  Lucifer son of the morning
					      I'm gonna chase you out earth
					 	  <br>...<br>Satan is a evilous man
						  <br>But him can't chucks it on I-man
						  <br>So when I check him my las in hand
						  <br>And if him slip, I gone wid him hand<br>...
					
						  <br><br>I Chase the Devil - Max Romeo
						  <br><br> go die 
					 
					");
				}
				
			}

			if(array_key_exists('draft',$post)){
				$data['type'] = 0;
			} elseif (array_key_exists('publish',$post)) {
				$data['type'] = 1;
			} else {
				$data['type'] = 0;
			}


			$image = $this->upload();
			if($image == FALSE){
				/**
				* the image was not uploaded
				* why???
				*/
				/**
				* TODO: (future version) - deal with this scenario
				*/
			} else {
				$data['main_image'] = $image;
			}
			$this->article_m->saveme($data,$id);
			$str = '/admin/article/';
			redirect($str);
		}
		
		// Load the view
		$this->load->view('admin/article/article_v', $this->data);

	}





}


?>