<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: create_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 06 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
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
            <li class="active">Create User</li>
        </ol>

        <div class="row">
            <div id="main" class="col-lg-12">

                <h1 class="page-header"><i class="fa fa-plus fa-fw"></i> Create User</h1>

                <div class="row">
                    <div class="col-md-10">
                        
                        <form id="create_form" class="form-horizontal" method="post" data-parsley-validate>
                            <fieldset>
                                <legend>User's Details</legend>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="username">
                                        Username <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" id="username" name="username" class="form-control"
                                            required maxlength="512" value="<?=set_value('username');?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="name">
                                        Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" id="name" name="name" class="form-control"
                                            required maxlength="512" value="<?=set_value('name');?>" />
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>Password</legend>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="password">
                                        Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="password" id="password" name="password" class="form-control"
                                            required minlength="6" maxlength="512" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="confirm_password">
                                        Confirm Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control"
                                            required minlength="6" maxlength="512" matches="#password" />
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>Admin</legend>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="access">
                                        Access <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <?php foreach($access as $key=>$access_option): ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="access_<?=$key;?>" name="access[]"
                                                        value="<?=$key;?>" required <?=set_checkbox('access[]', $key); ?>
                                                        data-parsley-errors-container="#accessErrors"> <?=$access_option;?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>

                                        <div id="accessErrors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Status</label>
                                    <div class="col-md-10">
                                        <p id="status" class="form-control-static">
                                            <span class="label label-default label-activated">Activated</span>
                                        </p>
                                    </div>
                                </div>
                            </fieldset>
                            <br/>

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
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
