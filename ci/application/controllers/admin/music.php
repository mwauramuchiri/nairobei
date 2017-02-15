<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* music section admin controller
*/
class Music extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$group = array(3,6);
		if (!$this->ion_auth->in_group($group)) {
			# super admin & music admin
			redirect('admin','refresh');
		}
	}

	public function _remap($value)
	{

		$this->load->model('music_m');
		$val = (int)$value;
		if ($value == 'index') {
			$this->_index();
		} elseif ($val == 1) {
			// setting the selected items
			$this->_set();
		} elseif ($val == 2) {
			// edit or add music
			if ($this->uri->segment(4)) {
				$this->_upload_music($this->uri->segment(4));
			} else {
				$this->_upload_music();
			}
		} elseif ($val == 3) {
			$this->_upload_site($this->uri->segment(4));

		} else {
			$this->_index();
		}
	}

	private function _upload_site($id = NULL)
	{
		// id name link_to_logo link_to_site
		if ($id) {
			$this->data['site'] = $this->music_m->get(TRUE,(int)$id);
		} else {
			$this->data['site'] = $this->music_m->get_new('site');
		}
		if ($this->input->post()) {
			if (strlen($this->input->post('id')) > 0) {
				$id = (int)$this->input->post('id');
			}
			//dump($this->_upload());
			$save = $this->music_m->array_from_post(array(
				'name', 
				'link_to_site'
				));
			$up = $this->_upload();
			if ($up != FALSE) {
				$link_to_logo = '/tinymce/blog_media/'.$up['upload_data']['file_name'];
				$save['link_to_logo'] = $link_to_logo;
			}
			$this->music_m->save($save,$id,'music_sites');
			redirect('admin/music');

		}
		$this->_index();
	}

	private function _upload()
	{
		$config['upload_path'] = './tinymce/blog_media/';
		$config['max_size'] = 2048000;
		$config['overwrite'] = FALSE;
		$config['encrypt_name'] = TRUE;
		$config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('link_to_logo')) {
			$error = array('error' => $this->upload->display_errors());
			return FALSE;
		} else {
			$data = array('upload_data' => $this->upload->data());
			return $data;
		}
	}

	private function _upload_music($id = NULL)
	{
		//dump($id);
		if ($id) {
			$this->data['song'] = $this->music_m->get(NULL,(int)$id);
		} else {
			$this->data['song'] = $this->music_m->get_new('music');
		}
		if ($this->input->post()) {

			if (strlen($this->input->post('id')) > 0) {
				$id = (int)$this->input->post('id');
			}

			$dt = $this->music_m->array_from_post(array(
				'title', 
				'artist', 
				'embed_link', 
				'buy_link',
				'coment'
				));
			$this->music_m->save($dt,$id,'music');
			redirect('admin/music');
		}

		$this->_index();
	}

	private function _set()
	{
		/**
		*
		*	TODO: add validation on client side
		*
		*
		*
		*/
		$data = array();
		$dt = array();
		$data[] = array(
			'list' => $this->input->post('music_sites')
			);
		$data[] = array(
			'list' => $this->input->post('latest_music')
			);
		$data[] = array(
			'list' => $this->input->post('music_picks')
			);
		$i = 0;
		$j = 3;
		while ($i < $j) {
			$dt['setting_list'] = json_encode($data[$i]);
			$this->music_m->save($dt,$i+1);
			$i++;
		}
		redirect('admin/music');

	}
	
	private function _index()
	{
		$t = $this->music_m->get();
		$this->data['sites'] = $t[0];
		$this->data['music'] = $t[1];
		$this->data['list'] = $t[2];
		if (!isset($this->data['song'])) {
			$this->data['song'] = $this->music_m->get_new('music');
		}
		if (!isset($this->data['site'])) {
			$this->data['site'] = $this->music_m->get_new('site');
		}

		$this->load->view('admin/music/music_v', $this->data);
	}
}



?>