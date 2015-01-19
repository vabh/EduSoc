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
    <div class="container">
        <?php
        if(isset($message) && $message != "")
            echo "<div class='alert alert-error'>".$message."</div>";
        ?>
        <?php echo form_open_multipart('instructor/bio');?>
        
            Name of Organization:<input type="text" name="organization" id="organization" value="<?php echo set_value('organization'); ?>"><br>
            Position:<input type="text" name="position" id="position" value="<?php echo set_value('position'); ?>"><br>
            Details:<textarea name="desc" id="desc"><?php echo set_value('desc'); ?></textarea><br>
            Upload CV:<input type="file" name="cv"/><br>
            <input type="submit" class="btn btn-success">
        </form>
    </div>
    <script src="<?php echo site_url();?>assets/js/jquery.js"></script>
    <script src="<?php echo site_url();?>assets/js/scripts.js"></script>
</body>
</html>