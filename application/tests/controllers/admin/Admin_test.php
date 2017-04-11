<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Admin_test.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 08 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/

class Admin_test extends TestCase
{
    const DO_ECHO = FALSE;

    const STATUS_ACTIVATED = 'Activated';
    const STATUS_DEACTIVATED = 'Deactivated';

    const USERNAME = 'admin';
    const PASSWORD = 'password';

    public function setUp()
    {
        $this->resetInstance();
        $CI =& get_instance();
        $CI->load->model('Migration_model');
        $CI->Migration_model->reset();

        $CI->load->model('User_log_model');
        $CI->load->library('session');
        $this->_truncate_table();
        $this->_login();
    }

    public function tearDown()
    {
        $this->_logout();
        $this->_truncate_table();
    }

    #region Helper Function
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

    private function _truncate_table($do_echo=FALSE)
    {
        $CI =& get_instance();
        $CI->load->database();
        $CI->load->model('User_model');
        $CI->db->truncate(TABLE_USER);

        $admin = array(
            'username' => $this::USERNAME,
            'name' => 'Default Admin',
            'password_hash' => password_hash($this::PASSWORD, PASSWORD_DEFAULT),
            'access' => 'A',
            'status' => $this::STATUS_ACTIVATED
        );
        $CI->User_model->insert($admin);

        if($do_echo)
        {
            echo "\n--- truncated table " . TABLE_USER;
            echo "\n||| count users: " . $CI->User_model->count_all() . "\n";
        }

        $CI->db->truncate(TABLE_USER_LOG);
        if($do_echo)
        {
            echo "\n--- truncated user log table ---\n";
        }
    }
    #endregion

    #region Test Functions
    public function test_index()
    {
        if($this::DO_ECHO) echo "\n+++ test_index +++";
		$this->request('GET', 'admin/admin/index');
		$this->assertResponseCode(302);
		$this->assertRedirect('admin/admin/start');
    }

    public function test_start()
    {
        if($this::DO_ECHO) echo "\n+++ test_start +++\n";
        $output = $this->request('GET', 'admin/admin/start');
        $this->assertResponseCode(200);
        $this->assertContains('Welcome', $output);
    }
    #endregion

} //end Admin_test class