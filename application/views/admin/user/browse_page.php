<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: browse_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 02 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $users
 * @var $access
 */
?><!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('admin/_snippets/meta'); ?>
<?php $this->load->view('admin/_snippets/head_resources_datatables'); ?>
</head>
<body>
<div id="wrapper">
<?php $this->load->view('admin/_snippets/navbar'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="<?=site_url(ADMIN_START_PAGE);?>">Home</a></li>
            <li class="active">Users</li>
        </ol>

        <div class="row">
            <div id="main" class="col-lg-12">
                <h1 class="page-header"><i class="fa fa-file-text-o fa-fw"></i> Browse Users</h1>

                <p class="lead">Click on a 'row' to view a User's record.</p>
                <?php $this->load->view('admin/_snippets/message_box'); ?>
                <?php if( ! $users) $this->load->view('admin/_snippets/no_records_box'); ?>

                
                <div class="row">
                    <div class="col-md-12">

                        <table id="dataTable" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Access</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($users as $key=>$user): ?>
                                <tr id="user_row_<?=$user['user_id'];?>" class="clickable" onclick="goto_view(<?=$user['user_id'];?>)">
                                    <td><?=$user['username'];?></td>
                                    <td><?=$user['name'];?></td>
                                    <td>
                                        <?php
                                            $user_access = str_split($user['access']);
                                            foreach($user_access as $user_access_val)
                                            {
                                                echo '<i class="fa fa-check-square fa-fw"></i>&nbsp;' . $access[$user_access_val] . '<br/>';
                                            }
                                        ?>
                                    </td>
                                    <td><?=$user['status'];?></td>
                                    <td data-sort="<?=format_dd_mm_yyyy_hh_ii_ss($user['last_updated']);?>"
                                        ><?=format_dd_mmm_yyyy($user['last_updated'], ' ');?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
        <?php $this->load->view('admin/_snippets/footer'); ?>
    </div>
</div>
</div>
<?php $this->load->view('admin/_snippets/body_resources_datatables') ;?>
<script>
    $(document).ready(function()
    {
        $('#dataTable').DataTable({
            "order": [[2, 'desc']],
            "responsive": true
        });
    });

    function goto_view(record_id)
    {
        location.href = '<?=site_url("admin/user/view");?>/' + record_id;
    }
</script>
</body>
</html>
