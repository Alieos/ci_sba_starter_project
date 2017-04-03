<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Admin.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 02 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		redirect('admin/admin/start');
	}

	public function start()
	{
		$this->load->view('admin/admin/start_page');
	}
	
} // end Admin controller class