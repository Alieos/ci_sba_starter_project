<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: view_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 06 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $personal_profile
 * @var $access
 */
?><!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('admin/_snippets/meta'); ?>
<?php $this->load->view('admin/_snippets/head_resources'); ?>
</head>
<body>
<div id="wrapper">
<?php $this->load->view('admin/_snippets/navbar'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="<?=site_url(ADMIN_START_PAGE);?>">Home</a></li>
            <li class="active">View Personal Profile</li>
        </ol>

        <div class="row">
            <div id="main" class="col-lg-12">
                <h1 class="page-header"><i class="fa fa-eye fa-fw"></i> View Personal Profile&nbsp;
                    <div class="btn-group">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-gavel fa-fw"></i> Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?=site_url('admin/personal_profile/edit');?>"><i class="fa fa-pencil-square-o fa-fw"></i> Edit User</a></li>
                        <li><a href="<?=site_url('admin/personal_profile/change_password');?>"><i class="fa fa-key fa-fw"></i> Change Password</a></li>
                    </ul>
                </div>
                </h1>

                <?php $this->load->view('admin/_snippets/message_box'); ?>
                
                <div class="row">
                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-10">
                                
                                <form id="view_user" class="form-horizontal">
                                    <fieldeset>
                                        <legend>User's Details</legend>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Username</label>
                                            <div class="col-md-10">
                                                <p id="username" class="form-control-static">
                                                    <?=$user['username'];?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Name</label>
                                            <div class="col-md-10">
                                                <p id="name" class="form-control-static">
                                                    <?=$user['name'];?>
                                                </p>
                                            </div>
                                        </div>
                                    </fieldeset>

                                    <fieldset>
                                        <legend>Admin</legend>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Status</label>
                                            <div class="col-md-10">
                                                <p id="status" class="form-control-static">
                                                    <span class="label label-default label-<?=strtolower($user['status']);?>"><?=$user['status'];?></span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Date Added</label>
                                            <div class="col-md-10">
                                                <p id="date_added" class="form-control-static">
                                                    <?=format_dd_mmm_yyyy_hh_ii_ss($user['date_added']);?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Last Updated</label>
                                            <div class="col-md-10">
                                                <p id="last_updated" class="form-control-static">
                                                    <?=format_rfc($user['last_updated']);?>
                                                </p>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <?php $this->load->view('admin/_snippets/footer'); ?>
    </div>
</div>
</div>
<?php $this->load->view('admin/_snippets/body_resources') ;?>
</body>
</html>
