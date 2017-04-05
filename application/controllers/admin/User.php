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

} //end User controller class