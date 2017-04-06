<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Personal_profile.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 06 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
class Personal_profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_log_model');
		$this->load->model('Personal_profile_model');
	}

	public function index()
	{
		redirect('admin/personal_profile/view');
	}

	public function view()
	{
		$this->User_log_model->validate_access();
		$personal_profile = $this->Personal_profile_model->get_by_id();
		if($personal_profile)
		{
			$data = array(
				'personal_profile' => $personal_profile
			);
			$this->load->view('admin/personal_profile/view_page', $data);
		}
		else
		{
			$this->_resolve_invalid_record();
		}
	}

	public function edit()
	{
		$this->User_log_model->validate_access();
		$personal_profile = $this->Personal_profile_model->get_by_id();
		if($personal_profile)
		{
			$this->_set_rules_edit($personal_profile);
			if($this->form_validation->run())
			{
				if($this->Personal_profile_model->update($this->_prepare_personal_profile_array($personal_profile)))
				{
					$this->User_log_model->log_message('Personal profile UPDATED.');
					$this->session->set_userdata('message', 'Personal profile <mark>updated</mark>.');
					redirect('admin/personal_profile/view');
				}
				else
				{
					$this->User_log_model->log_message('Unable to UPDATE personal profile.');
					$this->session->set_userdata('message', '<mark>Unable</mark> to update personal profile.');
				}
			}
			$data = array(
				'personal_profile' => $personal_profile
			);
			$this->load->model('admin/personal_profile/edit_page', $data);
		}
		else
		{
			$this->_resolve_invalid_record();
		}
	}

	private function _set_rules_edit($personal_profile)
	{
		if($this->input->post('username') == $personal_profile['username'])
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[512]');
		}
		else
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]|max_length[512]');
		}

		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[512]');
	}

	private function _prepare_personal_profile_array($personal_profile)
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]|max_length[512]');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[512]');
		return $personal_profile;
	}

	public function change_password()
	{
		$this->User_log_model->validate_access();
		$personal_profile = $this->Personal_profile->get_by_id();
		if($personal_profile)
		{
			$this->_set_rules_change_password();
			if($this->form_validation->run())
			{
				if(password_verify($this->input->post('password'), $personal_profile['password_hash']))
				{
					$user['password_hash'] = password_hash($this->input->post('new_password', PASSWORD_DEFAULT));
					if($this->Personal_profile_model->update($personal_profile))
					{
						$this->User_log_model->log_message('PASSWORD UPDATED.');
						$this->session->set_userdata('message', '<mark>Password updated</mark>.');
						redirect('admin/personal_profile/view');
					}
					else
					{
						$this->User_log_model->log_message('Unable to UPDATE PASSWORD.');
						$this->session->set_userdata('message', '<mark>Unable</mark> to update password.');
					}
				}
				else
				{
					$this->session->set_userdata('message', 'Old Password is incorrect.');
				}
			}
			$data = array(
				'personal_profile' => $personal_profile
			);
			$this->load->view('admin/personal_profile/change_password_page', $data);
		}
		else
		{
			$this->_resolve_invalid_record();
		}
	}

	private function _set_rules_change_password()
	{
		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|min_length[6]|max_length[512]');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]|max_length[512]');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm New Password',
			'trim|required|matches[new_password]|min_length[6]|max_length[512]');
	}

	private function _resolve_invalid_record()
	{
		$this->session->set_userdata('message', 'Profile not found.');
			redirect(	'admin/authenticate/logout');
	}

} //end Personal_profile controller class