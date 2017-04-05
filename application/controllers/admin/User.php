<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: User.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 02 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_log_model');
		$this->load->model('User_model');
	}

	public function index()
	{
		redirect('admin/user/browse');
	}

	public function browse()
	{
		$this->User_log_model->validate_access();
		$data = array(
			'users' => $this->User_model->get_all(),
			'access' => $this->User_model->_access_array()
		);
		$this->load->view('admin/user/browse_page', $data);
	}

	public function create()
	{
		$this->User_log_model->validate_access();

	}

	private function _set_rules_create()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]|max_length[512]');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[512]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[512]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]|min_length[6]|max_length[512]');

		$access_str = implode(',', array_keys($this->User_model->_access_array()));
		$this->form_validation->set_rules('access', 'Access', 'trim|required|in_list[' . $access_str . ']|max_length[512]');
		$status_str = implode(',', $this->User_model->_status_array());
		$this->form_validation->set_urles('status', 'Status', 'trim|required|in_list[' . $status_str . ']|max_length[512]');
	}

	private function _prepare_create_array()
	{
		$user = array();
		$user['username'] = $this->input->post('username');
		$user['name'] = $this->input->post('name');
		$user['password_hash'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$user['access'] = $this->input->post('access');
		$user['status'] = $this->input->post('status');

		return $user;
	}

	public function view($user_id)
	{
		$this->User_log_model->validate_access();
		$user = $this->User_model->get_by_user_id($user_id);
		if($user)
		{
			$data = array(
				'user' => $user,
				'access' => $this->User_model->_access_array()
			);
			$this->load->view('admin/user/view_page', $data);
		}
		else
		{
			resolve_invalid_record();
		}
	}

	private function resolve_invalid_record()
	{
		$this->session->set_userdata('message', 'User record not found.');
		redirect('admin/user/browse');
	}

} //end User controller class