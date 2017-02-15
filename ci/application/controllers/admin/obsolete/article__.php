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
		
		$this->load->model('article_m');
		
	}

	public function index()
	{

	}

	public function upload()
	{
		$config['upload_path'] = './tinymce/blog_media/';
		$config['max_size'] = 2048000;
		$config['overwrite'] = FALSE;
		//$config['encrypt_name'] = TRUE;
		$config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff';
		$this->load->library('upload',$config);

		if ( !$this->upload->do_upload('main_image')) {
			/**
			* if youre reading this its too late
			*/

			dump($this->upload->display_errors());

			$this->data['upload_error'] = $this->upload->display_errors();
			//echo $this->data['upload_error'];
			return FALSE;
		} else {
			$img_data = $this->upload->data();
			$dtails = '/tinymce/blog_media/'.$img_data['file_name'];
			dump($dtails);
			return($dtails);

		}
	}


	/**
	* For creating and editing blog articles
	* 
	*/

	
	public function edit($id = NULL)
	{
		// dump((int)$this->ion_auth->get_user_id());
		// Fetch a article or set a new one
		dump($_FILES);

		if ($id) {
			if (!$this->article_m->get($id)) {
				show_404();
			}
			$this->data['article'] = $this->article_m->get($id);
			count($this->data['article']) || $this->session->set_flashdata('article_err', 'That article is non existent');
			$edit = TRUE;
		}
		else {
			$edit = FALSE;
			$this->data['article'] = $this->article_m->get_new();
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
					//show_404(); 
					return show_error("Some error");
				}
				
			}
			dump($this->input->post());
			if(array_key_exists('draft',$post)){
				$data['type'] = 0;
			} elseif (array_key_exists('publish',$post)) {
				$data['type'] = 1;
			} 


			$image = $this->upload();
			if($image == FALSE){
				
				//echo $image;

			} else {
				$data['main_image'] = $image;
				
				dump($data);
				//redirect('admin/user');
			}
			$this->article_m->saveme($data, $id);
			

			
		}
		
		// Load the view
		$this->load->view('admin/article/article_v', $this->data);
	}





}


?>