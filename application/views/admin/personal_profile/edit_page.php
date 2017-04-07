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
            <li class="active">Edit Personal Profile</li>
        </ol>

        <div class="row">
            <div id="main" class="col-lg-12">

                <h1 class="page-header"><i class="fa fa-pencil-square-o fa-fw"></i> Edit Personal Profile</h1>

                <?php $this->load->view('admin/_snippets/validation_errors_box'); ?>
                <?php $this->load->view('admin/_snippets/message_box'); ?>

                <div class="row">
                    <div class="col-md-9">
                        
                        <form id="create_form" class="form-horizontal" method="post" data-parsley-validate>
                            <fieldset>
                                <legend>User's Details</legend>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="username">
                                        Username <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" id="username" name="username" class="form-control"
                                            required maxlength="512" value="<?=set_value('username', $personal_profile['username']);?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="name">
                                        Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" id="name" name="name" class="form-control"
                                            required maxlength="512" value="<?=set_value('name', $personal_profile['name']);?>" />
                                    </div>
                                </div>
                            </fieldset>
                            <br/>

                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <a id="reset_password_btn" class="btn btn-default"
                                        href="<?=site_url('admin/personal_profile/change_password');?>">
                                        <i class="fa fa-key fa-fw"></i> Change Password
                                    </a>
                                </div>
                            </div>

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
