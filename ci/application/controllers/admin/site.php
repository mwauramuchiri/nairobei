<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* access: beast_mode only
* site settings and stuff
*/
class Site extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		//are you, trully, who you say you are?
		if(!$this->ion_auth->is_admin())
		{
			redirect('admin/refactor');
		}


		// Load stuff
		$this->load->model('site_back_m');
		$this->load->model('gava_ad_m');

		//fetch stuff
		/*
		* so what happens if the picture was deleted from the server by other means???
		*/
		$this->data['all_background'] = objarr_to_arrarr($this->site_back_m->get_all());
		$this->data['curr_background'] = $this->site_back_m->get_current();
		$this->data['gava_ads'] = $this->gava_ad_m->get();
		if (!$this->uri->segment(4)){
			if(!isset($this->data['advert_edit'])) {
				$this->data['advert_edit'] = $this->gava_ad_m->get_new();
			}
		}

			
	}


	public function index()
	{
		$this->load->view('admin/site_v',$this->data);
	}

	private function up()
	{
		$config['upload_path'] = './img/';
		$config['max_size'] = 20480000;
		$config['overwrite'] = FALSE;
		$config['encrypt_name'] = TRUE;
		$config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff';
		$this->load->library('upload',$config);
		if ( !$this->upload->do_upload('image')) {
			/**
			* if youre reading this its too late
			*
			*/
			return FALSE;
		} else {
			$img_data = $this->upload->data();
			return '/img/'.$img_data['file_name'];
		}
	}
	public function gava_ad($val = NULL)
	{
		$id = (int)$val;
		if ($this->input->post('link')) {
			if ($this->input->post('id')) {
				$d = $this->input->post('id');
			} else {
				$d = NULL;
			}
			$data = $this->gava_ad_m->array_from_post(array(
				'text', 
				'link', 
			));
			$image_link = $this->up();
			if ($image_link) {
				$data['image_link'] = $image_link;
			};
			$this->gava_ad_m->save($data,$d);
			redirect('admin/site');
		}
		if ($this->input->post('advertise')) {
			$this->gava_ad_m->advertise($this->input->post('advertise'));
			redirect('admin/site');
		}
		if ($id != 0) {
			# manage
			$this->data['advert_edit'] = $this->gava_ad_m->get($id,TRUE);
			$this->index();
		} elseif ($val == 'delete') {
			# delete something
			$d = (int)$this->uri->segment(5);
			if ($d != 0) {
				$this->gava_ad_m->delete($d);
			}
			redirect('admin');
		}
	}

	public function background()
	{
		/**
		*
		* A method to change the site background
		*
		*/
		if ($this->input->post('ajax')) {

			
			if ($this->input->post('id')) {
				$id = (int)$this->input->post('id');
			}


			if (!$id) {
				$response['error'] = 'Please choose a background image to set';
				header("content-type:application/json");
				echo json_encode($response);
				exit;
			} else {
				/**
				* TODO: error handling
				*/

				if ($this->site_back_m->set_new($id)) {
					$response['success'] = 'Background image to successfully changed!';
					$response['new_image'] = $id;
					header("content-type:application/json");
					echo json_encode($response);
					exit;
				} else {
					$response['error'] = 'Background image could not be changed';
					header("content-type:application/json");
					echo json_encode($response);
					exit;
				}
				
			}
		
		} else {
			/**
			*	go die
			*/
			redirect('admin/site');
		}
	}

	public function upload_image()
	{
		# save the damn file
		$config['upload_path'] = './img/';
		$config['max_size'] = 2048000;
		$config['overwrite'] = FALSE;
		$config['encrypt_name'] = TRUE;
		$config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff';
		$this->load->library('upload',$config);

		if ( !$this->upload->do_upload()) {
			/**
			* if youre reading this its too late
			*
			*/
			redirect('admin');
		} else {
			$dtails = array();
			$img_data = $this->upload->data();
			$dtails['image_url'] = '/img/'.$img_data['file_name'];
			if ($this->input->post('owner')) {
				$dtails['owner'] = $this->input->post('owner');
			}
			if ($this->input->post('ig_link')) {
				$dtails['ig_link'] = $this->input->post('ig_link');
			}
			if ($this->input->post('twitter_link')) {
				$dtails['twitter_link'] = $this->input->post('twitter_link');
			}
			// put it in the db
			$this->site_back_m->insert_new($dtails);
			redirect('admin');
		}
	}

	public function delete_img($id = NULL)
	{
		if ($id == NULL) {
			//return FALSE;
		} else {
			$pre = (array)$this->site_back_m->get($id, TRUE);
			$id = (int)$id;
			$filename = '.'.$pre['image_url'];
			$this->site_back_m->delete($id);
			if (file_exists($filename)) {
				unlink($filename);
				//file completely deleted
				//return TRUE;
			} else {
				//file not exist
				//echo "not there stupid";
				//return FALSE;
			}
		}
		redirect('admin');
	}
}



?>