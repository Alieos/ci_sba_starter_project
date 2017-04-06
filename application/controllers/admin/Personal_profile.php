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
		$this->load->model('Personal_profile_model');
	}

	public function index()
	{
		redirect('admin/personal_profile/view');
	}

	public function view()
	{

	}

	public function edit()
	{
		
	}

	private function _set_rulet_edit($personal_profile)
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

	}

	private function _set_rules_change_password()
	{
		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|min_length[6]|max_length[512]');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]|max_length[512]');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm New Password',
			'trim|required|matches[new_password]|min_length[6]|max_length[512]');
	}

} //end Personal_profile controller class