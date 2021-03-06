<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: navbar.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 27 Jan 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
?><!-- Navigation start -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <!-- navbar-header start -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?=site_url('admin/authenticate/start');?>"><img src="<?=RESOURCES_FOLDER;?>project/project-icon.png" alt="Site Logo" height="16px" /> <?=ADMIN_SITE_NAME;?></a>
    </div>
    <!-- navbar-header end -->

    <!-- navbar-top-links start -->
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <?=$this->session->userdata('name');?> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?=site_url('admin/authenticate/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?=site_url('admin/personal_profile/view');?>"><i class="fa fa-eye fa-fw"></i> View Profile</a></li>
                <li><a href="<?=site_url('admin/personal_profile/change_password');?>"><i class="fa fa-key fa-fw"></i> Change Password</a></li>
            </ul>
        </li>
    </ul>
    <!-- navbar-top-links end -->

    <!-- navbar-static start -->
    <div class="navbar-default sidebar" role="navigation">
        <!-- sidebar-collapse start -->
        <div class="sidebar-nav navbar-collapse">

            <ul class="nav" id="side-menu">
                <!-- user module -->
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i> Users<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?=site_url('admin/user/browse');?>"><i class="fa fa-file-text-o fa-fw"></i> Browse Users</a>
                        </li>
                        <li>
                            <a href="<?=site_url('admin/user/create');?>"><i class="fa fa-plus fa-fw"></i> Create User</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- sidebar-collapse end -->
    </div>
    <!-- navbar-static end -->
</nav>
<!-- Navigation end -->
