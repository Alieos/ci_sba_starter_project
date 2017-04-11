<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: edit_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 06 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $user
 * @var $access
 * @var $status
 */
?><!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('admin/_snippets/meta'); ?>
<?php $this->load->view('admin/_snippets/head_resources'); ?>
<!-- Custom Parsley CSS -->
<link href="<?=RESOURCES_FOLDER;?>project/parsley.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
<?php $this->load->view('admin/_snippets/navbar'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="<?=site_url();?>">Home</a></li>
            <li><a href="<?=site_url('admin/user/browse');?>">Users</a></li>
            <li><a href="<?=site_url('admin/user/view/' . $user['user_id']);?>">User ID: <?=$user['user_id'];?></a></li>
            <li class="active">Edit User</li>
        </ol>

        <div class="row">
            <div id="main" class="col-lg-12">

                <h1 class="page-header"><i class="fa fa-pencil-square-o fa-fw"></i> Edit User</h1>

                <div class="row">
                    <div class="col-md-9">

                        <?php $this->load->view('admin/_snippets/validation_errors_box'); ?>
                        <?php $this->load->view('admin/_snippets/message_box'); ?>
                        
                        <form id="create_form" class="form-horizontal" method="post" data-parsley-validate>
                            <fieldset>
                                <legend>User's Details</legend>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="username">
                                        Username <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" id="username" name="username" class="form-control"
                                            required maxlength="512" value="<?=set_value('username', $user['username']);?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="name">
                                        Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" id="name" name="name" class="form-control"
                                            required maxlength="512" value="<?=set_value('name', $user['name']);?>" />
                                    </div>
                                </div>
                            </fieldset>
                            <br/>

                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <a id="reset_password_btn" class="btn btn-default"
                                        href="<?=site_url('admin/user/reset_password/' . $user['user_id']);?>">
                                        <i class="fa fa-key fa-fw"></i> Reset Password
                                    </a>
                                </div>
                            </div>

                            <fieldset>
                                <legend>Admin</legend>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="access">
                                        Access <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <?php
                                        $access_array = str_split($user['access']);
                                        foreach($access as $key=>$access_option):
                                            $checked = FALSE;
                                            foreach($access_array as $access_key=>$access)
                                            {
                                                if($access == $key)
                                                {
                                                    $checked = TRUE;
                                                }
                                            }
                                            ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="access_<?=$key;?>" name="access[]"
                                                        value="<?=$key;?>" required <?=set_checkbox('access[]', $key, $checked); ?>
                                                        data-parsley-errors-container="#accessErrors">&nbsp;<?=$access_option;?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>

                                        <div id="accessErrors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="status">
                                        Status <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select id="status" name="status" class="form-control" required>
                                            <?php foreach($status as $key=>$status_option): ?>
                                                <option id="status_<?=$key;?>" value="<?=$status_option;?>" <?=set_select('status', $status_option, ($user['status'] == $status_option)); ?>><?=$status_option;?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Date Added</label>
                                    <div class="col-md-9">
                                        <p id="date_added" class="form-control-static">
                                            <?=format_dd_mmm_yyyy_hh_ii_ss($user['date_added']);?>
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Last Updated</label>
                                    <div class="col-md-9">
                                        <p id="last_updated" class="form-control-static">
                                            <?=format_rfc($user['last_updated']);?>
                                        </p>
                                    </div>
                                </div>
                            </fieldset>
                            <br/>

                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <button id="submit_btn" class="btn btn-primary" type="submit">
                                        <i class="fa fa-check fa-fw"></i> Submit
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
        <?php $this->load->view('admin/_snippets/footer'); ?>
    </div>
</div>
</div>
<?php $this->load->view('admin/_snippets/body_resources') ;?>
<!-- Parsley -->
<script src="<?=RESOURCES_FOLDER;?>vendor/parsleyjs/parsley.min.js"></script>
</body>
</html>
