<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Personal_profile_test.jpg
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 08 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
class Personal_profile_model_test extends TestCase
{
	const DO_ECHO = FALSE;

	const USERNAME = 'admin';
	const PASSWORD = 'password';

	public function setUp()
	{
		$this->resetInstance();
		$CI =& get_instance();
		$CI->load->model('Migration_model');
		$CI->Migration_model->reset();

		$CI->load->library('session');
		$this->_login();
	}

	public function tearDown()
	{
		$this->_logout();
	}
	#region Helper Functions
	private function _login()
	{
		$this->request('POST', 'admin/authenticate/login',
			array(
				'username' => $this::USERNAME,
				'password' => $this::PASSWORD
			)
		);
		$this->request('GET', 'admin/authenticate/start');
		if($this::DO_ECHO) echo "\n--- logged in\n";
	}

	private function _logout()
	{
		$this->request('GET', 'admin/authenticate/logout');
		$this->request('GET', 'admin/authenticate/login');
		if($this::DO_ECHO) echo "\n--- logged out\n";
	}

	public function test_get_by_id()
	{
		if($this::DO_ECHO) echo "\n+++ test_get_by_id +++\n";
		$CI =& get_instance();
		$CI->load->model('Personal_profile_model');
		$personal_profile = $CI->Personal_profile_model->get_by_id();
		$this->assertEquals('Default Admin', $personal_profile['name']);
	}

	public function test_get_by_username()
	{
		if($this::DO_ECHO) echo "\n+++ test_get_by_id +++\n";
		$CI =& get_instance();
		$CI->load->model('Personal_profile_model');
		$personal_profile = $CI->Personal_profile_model->get_by_username();
		$this->assertEquals('Default Admin', $personal_profile['name']);
	}

	public function test_update()
	{
		if($this::DO_ECHO) echo "\n+++ test_update +++\n";
		$CI =& get_instance();
		$CI->load->model('Personal_profile_model');
		$personal_profile = $CI->Personal_profile_model->get_by_id();
		$personal_profile['username'] = 'default_admin';
		$CI->Personal_profile_model->update($personal_profile);
		$updated_profile = $CI->Personal_profile_model->get_by_id();
		$this->assertEquals('default_admin', $updated_profile['username']);

		$this->assertFalse($CI->Personal_profile_model->update(FALSE));
	}
	#endregion

} //end Personal_profile_test class