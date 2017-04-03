<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Authenticate.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 02 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
class Authenticate extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		redirect('admin/authenticate/login');
	}

	public function login()
	{
		$this->load->view('admin/authenticate/login_page');
	}

	private function _set_rules_login()
	{

	}

	public function logout()
	{
		redirect('admin/authenticate/login');
	}

	public function start()
	{
		redirect('admin/authenticate/login');
	}
	
} // end Authenticate controller class