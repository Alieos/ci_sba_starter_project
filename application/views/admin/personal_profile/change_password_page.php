<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: reset_password_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 06 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $personal_profile
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
            <li><a href="<?=site_url('admin/personal_profile/view');?>">View Personal Profile</a></li>
            <li class="active">Change Password</li>
        </ol>

        <div class="row">
            <div id="main" class="col-lg-12">

                <h1 class="page-header"><i class="fa fa-key fa-fw"></i> Change Password</h1>

                <?php $this->load->view('admin/_snippets/validation_errors_box'); ?>
                <?php $this->load->view('admin/_snippets/message_box'); ?>

                <div class="row">
                    <div class="col-md-9">
                        
                        <form id="create_form" class="form-horizontal" method="post" data-parsley-validate>
                            <fieldset>
                                <legend>User's Details</legend>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Username</label>
                                    <div class="col-md-9">
                                        <p id="username" class="form-control-static">
                                            <?=$personal_profile['username'];?>
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Name</label>
                                    <div class="col-md-9">
                                        <p id="name" class="form-control-static">
                                            <?=$personal_profile['name'];?>
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                        <a id="reset_password_btn" class="btn btn-default"
                                           href="<?=site_url('admin/personal_profile/edit');?>">
                                            <i class="fa fa-pencil-square-o fa-fw"></i> Edit Personal Profile
                                        </a>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset>
                                <legend>Password</legend>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="old_password">
                                        Old Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="password" id="old_password" name="old_password" class="form-control"
                                               required minlength="6" maxlength="512" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="new_password">
                                        New Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="password" id="new_password" name="new_password" class="form-control"
                                            required minlength="6" maxlength="512" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="confirm_new_password">
                                        New Confirm Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="password" id="confirm_new_password" name="confirm_new_password" class="form-control"
                                            required minlength="6" maxlength="512" matches="#new_password" />
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>Admin</legend>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-9">
                                        <p id="status" class="form-control-static">
                                            <span class="label label-default label-<?=strtolower($personal_profile['status']);?>"><?=$personal_profile['status'];?></span>
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Date Added</label>
                                    <div class="col-md-9">
                                        <p id="date_added" class="form-control-static">
                                            <?=format_dd_mmm_yyyy_hh_ii_ss($personal_profile['date_added']);?>
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Last Updated</label>
                                    <div class="col-md-9">
                                        <p id="last_updated" class="form-control-static">
                                            <?=format_rfc($personal_profile['last_updated']);?>
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
