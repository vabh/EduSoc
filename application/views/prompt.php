<!doctype HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= site_url()?>assets/css/basic.css" />   
</head>
<body>
	<div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a href="<?php echo site_url();?>" class="brand">EduSoc</a>
                <ul class="nav">
                    <li><a href="<?php echo site_url();?>">Home</a></li>
                    <li><a href="<?php echo site_url()."course/catalog"?>">Courses</a></li>
                </ul>
                <ul class="nav pull-right">
                    <li><a href="<?php echo site_url();?>profile"><?echo $this->session->userdata('firstName')." ".$this->session->userdata('lastName');?></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url()."edit";?>">Edit Profile</a></li>
                            <li><a href="<?php echo site_url()."password/change";?>">Change Password</a></li>
                            <li><a href="<?php echo site_url()."logout";?>">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
	<div class='container'>
		<div class='hero-unit'>
		<?php
			echo "<h3 class='text-error'>".$message."</h3>";
		?>
		</div>
	</div>
	<script src="<?php echo site_url();?>assets/js/jquery.js"></script>
	<script src="<?php echo site_url();?>assets/js/scripts.js"></script>
</body>
</html>