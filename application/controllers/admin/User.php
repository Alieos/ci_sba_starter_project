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
		$this->load->library('form_validation');
	}

	public function index()
	{
		redirect('admin/user/browse');
		//@codeCoverageIgnoreStart
	}
	//@codeCoverageIgnoreEnd

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
		$this->_set_rules_create();
		if($this->form_validation->run())
		{
			if($user_id = $this->User_model->insert($this->_prepare_create_array()))
			{
				$this->User_log_model->log_message('User record CREATED. | user_id: ' . $user_id);
				$this->session->set_userdata('message', 'User record <mark>created</mark>. <a href="' . site_url('admin/user/create') . '">Create another.</a>');
				redirect('admin/user/view/'. $user_id);
			}
			else
			{
				$this->User_log_model->log_message('Unable to CREATE User record.');
				$this->session->set_userdata('message', 'Unable to <mark>create</mark> User record');
			}
		}
		$data = array(
			'access' => $this->User_model->_access_array(),
			'status' => $this->User_model->_status_array()
		);
		$this->load->view('admin/user/create_page', $data);
	}

	private function _set_rules_create()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_dash|is_unique[user.username]|max_length[512]');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[512]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[512]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]|min_length[6]|max_length[512]');

		$access_str = implode(',', array_keys($this->User_model->_access_array()));
		$this->form_validation->set_rules('access[]', 'Access', 'trim|required|in_list[' . $access_str . ']|max_length[512]');
	}

	private function _prepare_create_array()
	{
		$user = array();
		$user['username'] = $this->input->post('username');
		$user['name'] = $this->input->post('name');
		$user['password_hash'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$user['access'] = implode(',', $this->input->post('access'));
		$user['status'] = $this->User_model->_status_array()[0];

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
			$this->_resolve_invalid_record();
		}
	}

	public function edit($user_id)
	{
		$this->User_log_model->validate_access();
		$user = $this->User_model->get_by_user_id($user_id);
		if($user)
		{
			$this->_set_rules_edit($user);
			if($this->form_validation->run())
			{
				if($this->User_model->update($this->_prepare_edit_array($user)))
				{
					$this->User_log_model->log_message('User record UPDATED. | user_id: ' . $user_id);
					$this->session->set_userdata('message', 'User record <mark>updated</mark>.');
					redirect('admin/user/view/' . $user['user_id']);
				}
				else
				{
					$this->User_log_model->log_message('Unable to UPDATE User record. | user_id: ' . $user_id);
					$this->session->set_userdata('message', '<mark>Unable</mark> to update User record.');
				}
			}
			$data = array(
				'user' => $user,
				'access' => $this->User_model->_access_array(),
				'status' => $this->User_model->_status_array()
			);
			$this->load->view('admin/user/edit_page', $data);
		}
		else
		{
			$this->_resolve_invalid_record();
		}
	}

	private function _set_rules_edit($user)
	{
		if($this->input->post('username') == $user['username'])
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_dash|max_length[512]');
		}
		else
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_dash|is_unique[user.username]|max_length[512]');
		}

		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[512]');
		$access_str = implode(',', array_keys($this->User_model->_access_array()));
		$this->form_validation->set_rules('access[]', 'Access', 'trim|required|in_list[' . $access_str . ']|max_length[512]');
		$status_str = implode(',', $this->User_model->_status_array());
		$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[' . $status_str . ']|max_length[512]');
	}

	private function _prepare_edit_array($user)
	{
		$user['username'] = $this->input->post('username');
		$user['name'] = $this->input->post('name');
		$user['access'] = implode(',', $this->input->post('access'));
		$user['status'] = $this->input->post('status');

		return $user;
	}

	public function reset_password($user_id)
	{
		$this->User_log_model->validate_access();
		$user = $this->User_model->get_by_user_id($user_id);
		if($user)
		{
			$this->_set_rules_reset_password();
			if($this->form_validation->run())
			{
				$user['password_hash'] = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);
				if($this->User_model->update($user))
				{
					$this->User_log_model->log_message('User\'s PASSWORD UPDATED. | user_id: ' . $user_id);
					$this->session->set_userdata('message', 'User\'s <mark>password updated</mark>.');
					redirect('admin/user/view/' . $user['user_id']);
				}
				else
				{
					$this->User_log_model->log_message('Unable to UPDATE User\'s PASSWORD. | user_id: ' . $user_id);
					$this->session->set_userdata('message', 'Unable to <mark>update User\'s password</mark>.');
				}
			}
			$data = array(
				'user' => $user,
				'access' => $this->User_model->_access_array()
			);
			$this->load->view('admin/user/reset_password_page', $data);
		}
		else
		{
			$this->_resolve_invalid_record();
		}
	}

	private function _set_rules_reset_password()
	{
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]|max_length[512]');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm New Password',
			'trim|required|matches[new_password]|min_length[6]|max_length[512]');
	}

	private function _resolve_invalid_record()
	{
		$this->session->set_userdata('message', 'User record not found.');
		redirect('admin/user/browse');
	}

} //end User controller class