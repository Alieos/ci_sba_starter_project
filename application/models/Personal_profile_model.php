<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Personal_profile_model.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 06 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
class Personal_profile_model extends CI_Model
{
	public function get_by_id()
	{
		$query = $this->db->get_where(TABLER_USER, array('user_id' => $this->session->userdata('user_id')));
		return $query->row_array();
	}

	public function get_by_username()
	{
		$query = $this->db->get_where(TABLER_USER, array('username' => $this->session->userdata('username')));
		return $query->row_array();
	}

	public function update($personal_profile=FALSE)
	{
		if($personal_profile)
		{
			$temp_array = array(
				'username' => $personal_profile['username'],
				'name' => $personal_profile['name'],
				'password_hash' => $personal_profile['password_hash']
			);

			$this->db->set('last_updated', now('c'));
            $this->db->update(TABLE_USER, $temp_array, array('user_id' => $this->session->userdata('user_id')));
            return $this->db->affected_rows();
		}
		else
		{
			return FALSE;
		}
	}

} //end Personal_profile_model class