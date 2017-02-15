<?php
/** 
* @param hhiglifr
* search things
*
*
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends Frontend_Controller {
	function _construct()
	{
		parent::_construct();
		
	}


	public function _remap($value)
	{
		$this->load->model('blog_m');
		$this->load->model('music_m');
		$this->load->model('gava_ad_m');
		/**
		* http://127.0.0.1/nairobei/public/index.php/article: $value = string 'index' (length=5)
		* http://127.0.0.1/nairobei/public/: - root_dir: $value = string 'index' (length=5)
		* http://127.0.0.1/nairobei/public/index.php/article/1: $value = string '1' (length=1)
		* http://127.0.0.1/nairobei/public/index.php/article/1/something_else: 
		*				- $value = string '1' (length=1)
		*				- $this->uri->segment(3) = string 'something_else' (length=14)
		*/

		if ((int)$value > 0) {
			// link to view a single article
			$this->get_it((int)$value,$this->uri->segment(3));
		} elseif ($value == 'history') {
			// link to view all articles in history category
			$this->category('history');
		} elseif ($value == 'gava-kilo-nusu') {
			// link to view all articles in gava_kilo_nusu category
			$this->category('gava_kilo_nusu');
		} elseif ($value == 'like') {
			//http://127.0.0.1/nairobei/public/index.php/article/like/1/like
			//http://127.0.0.1/nairobei/public/index.php/article/like/1/unlike


			// aka no direct script access
			if ((int)$this->uri->segment(3) != NULL && $this->uri->segment(4) != NULL) {
				//check segment 4
				if ($this->uri->segment(4) == 'like') {
					$this->like((int)$this->uri->segment(3), 1, 1);
				} elseif ($this->uri->segment(4) == 'unlike') {
					$this->like((int)$this->uri->segment(3), 0, 1);
				} elseif ($this->uri->segment(4) == 'like_m') {
					$this->like((int)$this->uri->segment(3), 1, 0);
				} elseif ($this->uri->segment(4) == 'unlike_m') {
					$this->like((int)$this->uri->segment(3), 0, 0);
				} else {
					redirect('/');
				}
				

			} else {
				redirect('/');
			}
		} else {
			$this->index();
		}
		

	}

	private function like($id,$like,$type)
	{
		/**
		*
		*	JSON! oh json!
		*
		*/
		$ip = $this->input->ip_address();
		switch ($type) {
			case 0:
				# they liked a song
				//echo "You want to like track number: ".$id;
				if ($this->music_m->like($id,$ip,$like)) {
					/*$response['success'] = 'success!';
					header("content-type:application/json");
					echo json_encode($response);
					exit;*/
				} else {
					/*$response['error'] = 'error!';
					header("content-type:application/json");
					echo json_encode($response);
					exit;*/
				}
				redirect('/');
				break;
			case 1:
				# they liked an article
				if ($this->blog_m->like($id,$ip,$like)){
					/*$response['success'] = 'success!';
					header("content-type:application/json");
					echo json_encode($response);
					exit;*/
				} else {
					/*$response['error'] = 'error!';
					header("content-type:application/json");
					echo json_encode($response);
					exit;*/
				}
				redirect('/');
				break;
		}
	}

	private function get_music_likes($val)
	{
		$a = 0;
		while ($a < count($val)) {
			$l = $this->music_m->get_likes($val[$a]['id']);
			$ll = array();
			foreach ($l as $key) {
				$ll[] = $key->like_ip_address;
			}
			if (in_array($this->input->ip_address(), $ll)) {
				$val[$a]['i_like'] = 1;
			} else {
				$val[$a]['i_like'] = 0;
			}
			$val[$a]['likes'] = $ll;
			$a++;
		}

		return $val;
	}

	private function _music($val)
	{
		$sites = array();
		$latest_music = array();
		$music_picks = array();
		$i = 0;
		$j = 3;
		while ($i < $j) {
			if (count($val[2][$i])) {
				foreach ($val[2][$i] as $item) {
					switch ($i) {
						case 0:
							foreach ($val[0] as $smth) {
								$smth = (array)$smth;
								if ($item == $smth['id']) {
									$sites[] = $smth;
								}
							}
							break;
						case 1:
							foreach ($val[1] as $smth) {
								$smth = (array)$smth;
								if ($item == $smth['id']) {
									$latest_music[] = $smth;
								}
							}
							break;
						case 2:
							foreach ($val[1] as $smth) {
								$smth = (array)$smth;
								if ($item == $smth['id']) {
									$music_picks[] = $smth;
								}
							}
							break;
					}
				}
			}
			$i++;
		}
		$this->data['top_music_sites'] = $sites;
		$this->data['latest_music'] = $this->get_music_likes($latest_music);
		$this->data['music_picks'] = $this->get_music_likes($music_picks);
	}

	private function index()
	{
		$hist = $this->blog_m->get_articles('history', 1);
		$gava = $this->blog_m->get_articles('gava_kilo_nusu', 5);
		$this->data['gava_ad'] = $this->gava_ad_m->client_side_get();
		$this->_music($this->music_m->get());

		
		if ($hist != NULL) {
			$hist->likes = $this->blog_m->get_likes($hist->id);
			$this->data['latest_history'] = $this->blog_m->append_author($hist);
		} else {
			$this->data['latest_history'] = $hist;
		}
		
		foreach ($gava as $gav) {
			$gav->likes = $this->blog_m->get_likes($gav->id);
			$this->data['latest_gava_kilo_nusu'][] = $this->blog_m->append_author($gav);
		}

		$my_likes = $this->blog_m->get_likes(NULL,$this->input->ip_address());
		foreach ($my_likes as $me_likey) {
			$this->data['my_likes'][] = (int)$me_likey->article_id;
		}

		$this->load->view('article/home_v',$this->data);
	}

	/**
	*
	*	functionality for viewing articles by category
	*
	*/
	private function category($str)
	{
		$dd = $this->blog_m->get_articles($str);
		$this->data['category'] = $str;
		foreach ($dd as $d) {
			$this->data['all_by_category'][] = $this->blog_m->append_author($d);
		}
		
		$this->load->view('article/category_v',$this->data);

	}



	/**
	*
	* view a single article
	*
	*/
	private function get_it($id, $slug)
	{
    	// Fetch the article
		$article = $this->blog_m->get($id);
    	// redirect if not found
    	count($article) || show_404();
    	$this->data['article'] = $this->blog_m->append_author($article);

		
    	// Redirect if slug was incorrect
    	$requested_slug = $slug;
    	$set_slug = $this->data['article']->slug;
    	if ($requested_slug != $set_slug) {
    		redirect('article/' . $this->data['article']->id . '/' . $this->data['article']->slug, 'location', '301');
    	}

    	// Load view
    	$this->load->view('article/single_v', $this->data);
    }
}
?>