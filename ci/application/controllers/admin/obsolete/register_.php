<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* access: beast_mode only
*/
class Register extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		//are you, trully, who you say you are?
		if(!$this->ion_auth->is_admin())
		{
			redirect('admin/user');
		}



	}

	public function index()
	{


		$this->form_validation->set_rules('first_name','First name','trim|required');
		$this->form_validation->set_rules('last_name','Last name','trim|required');
		$this->form_validation->set_rules('username','Username','trim|required|is_unique[users.username]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password','Password','trim|min_length[8]|max_length[20]|required');
		$this->form_validation->set_rules('confirm_password','Confirm password','trim|matches[password]|required');

		if (!$this->form_validation->run()) {
			//what happened?
			$this->load->view('admin/register_v');
		} else {
			/**
			* additional userdata
			*/
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');

			/**
			* ion_auth required params
			*/
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			/**
			* any other jibberish goes here in this array
			* about, profile pic link etc
			* 
			*/
			$additiona_data = array(
				'username' => $username,
				'first_name' => $first_name,
				'last_name' => $last_name
				);

			$this->load->library('ion_auth');


			//dump($username);

			
			if ($this->ion_auth->register($username,$password,$email,$additiona_data)) {

				$_SESSION['auth_message'] = 'Account created successfully!';
				$this->session->mark_as_flash('auth_message');
				/**
				* redirect route
				* login: if users register themselves
				* admin/site: if users are created manually
				*/
				redirect('admin/site/');



			} else {
				$_SESSION['auth_message'] = $this->ion_auth->errors();
				$this->session->mark_as_flash('auth_message');
				redirect('admin/register/');
			}
			



		}
	}





}

?>