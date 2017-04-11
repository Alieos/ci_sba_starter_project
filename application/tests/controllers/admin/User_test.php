<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Authenticate_test.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 08 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
class User_test extends TestCase
{
    const DO_ECHO = TRUE;

    const STATUS_ACTIVATED = 'Activated';
    const STATUS_DEACTIVATED = 'Deactivated';

    const USERNAME = 'admin';
    const PASSWORD = 'password';

    public function setUp()
    {
        if($this::DO_ECHO) echo "\n+++ setUp +++\n";
        $this->resetInstance();
        $CI =& get_instance();
        $CI->load->model('Migration_model');
        $CI->Migration_model->reset();

        $CI->load->model('User_log_model');
        $CI->load->library('session');
        $CI->load->library('form_validation');
        $this->_truncate_table();
        $this->_login();
    }

    public function tearDown()
    {
        if($this::DO_ECHO) echo "\n+++ tearDown +++\n";
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
        $this->request('GET', 'admin/admin/start');
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

    private function _sample_user_record($with_status=TRUE)
    {
        if($with_status)
        {
            return array(
                'username' => 'john_doe',
                'name' => 'John Doe',
                'password' => '123456',
                'confirm_password' => '123456',
                'access[]' => array('A'),
                'status' => 'Activated'
            );
        }
        else
        {
            return array(
                'username' => 'john_doe',
                'name' => 'John Doe',
                'password' => '123456',
                'confirm_password' => '12345',
                'access[]' => array('A')
            );
        }
    }
    #endregion

    #region Test Functions
    public function test_index()
    {
        $this->request('GET', 'admin/user/index');
        $this->assertResponseCode(302);
        $this->assertRedirect('admin/user/browse');
    }

    public function test_browse()
    {
        $output = $this->request('GET', 'admin/user/browse');
        $this->assertResponseCode(200);
        $this->assertContains('Users', $output);
    }

    public function test_create()
    {
        if($this::DO_ECHO) echo "+++ test_create +++\n";
        $output = $this->request('GET', 'admin/user/create');
        $this->assertResponseCode(200);
        $this->assertContains('Create User', $output);
    }

    /**
     * @group totest
     */
    public function test_create_success()
    {
        if($this::DO_ECHO) echo "+++ test_create_success +++\n";
        $CI =& get_instance();
        $CI->load->library('form_validation');
        $this->request('POST', 'admin/user/create',
            array(
                'username' => 'john_doe',
                'name' => 'John Doe',
                'password'=> '123456',
                'confirm_password' => '123456',
                'access[]' => array('A')
            )
        );
        $output = $this->request('GET', 'admin/user/create');
        echo "\n" . $output;
        $this->assertResponseCode(302);
        $this->assertRedirect('admin/user/view/2');

        $output = $this->request('GET', 'admin/user/view/2');
        $this->assertContains($output, 'User record created.');
    }

    public function test_create_validate_username()
    {
        if($this::DO_ECHO) echo "+++ test_create_validate_username +++\n";
        $this->markTestIncomplete();
    }

    public function test_create_validate_name()
    {
        if($this::DO_ECHO) echo "+++ test_create_validate_name +++\n";
        $this->markTestIncomplete();
    }

    public function test_create_validate_password()
    {
        if($this::DO_ECHO) echo "+++ test_create_validate_password +++\n";
        $this->markTestIncomplete();
    }

    public function test_create_validate_access()
    {
        if($this::DO_ECHO) echo "+++ test_create_validate_access +++\n";
        $this->markTestIncomplete();
    }

    public function test_view()
    {
        if($this::DO_ECHO) echo "+++ test_view +++\n";
        $this->markTestIncomplete();
    }

    public function test_view_invalid_record()
    {
        if($this::DO_ECHO) echo "+++ test_view_invalid_record +++\n";
        $this->markTestIncomplete();
    }

    public function test_edit()
    {
        if($this::DO_ECHO) echo "+++ test_edit +++\n";
        $this->markTestIncomplete();
    }

    public function test_edit_invalid_record()
    {
        if($this::DO_ECHO) echo "+++ test_edit_invalid_record +++\n";
        $this->markTestIncomplete();
    }

    public function test_edit_success()
    {
        if($this::DO_ECHO) echo "+++ test_edit_success +++\n";
        $this->markTestIncomplete();
    }

    public function test_edit_validate_username()
    {
        if($this::DO_ECHO) echo "+++ test_edit_validate_username +++\n";
        $this->markTestIncomplete();
    }

    public function test_edit_validate_name()
    {
        if($this::DO_ECHO) echo "+++ test_edit_validate_name +++\n";
        $this->markTestIncomplete();
    }

    public function test_edit_validate_access()
    {
        if($this::DO_ECHO) echo "+++ test_edit_validate_access +++\n";
        $this->markTestIncomplete();
    }

    public function test_edit_validate_status()
    {
        if($this::DO_ECHO) echo "+++ test_edit_validate_status +++\n";
        $this->markTestIncomplete();
    }

    public function test_reset_password()
    {
        if($this::DO_ECHO) echo "+++ test_reset_password +++\n";
        $this->markTestIncomplete();
    }

    public function test_reset_password_invalid_record()
    {
        if($this::DO_ECHO) echo "+++ test_reset_password_invalid_record +++\n";
        $this->markTestIncomplete();
    }

    public function test_reset_password_success()
    {
        if($this::DO_ECHO) echo "+++ test_reset_password_success +++\n";
        $this->markTestIncomplete();
    }

    public function test_reset_password_validation()
    {
        if($this::DO_ECHO) echo "+++ test_reset_password_validation +++\n";
        $this->markTestIncomplete();
    }
    #endregion

} //end User_test class