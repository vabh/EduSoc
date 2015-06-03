<!doctype HTML>
<html lang="en">
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
                    <li><a href="<?php echo site_url();?>profile"><?php echo $this->session->userdata('firstName')." ".$this->session->userdata('lastName');?></a></li>
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
        $n = count($inst);
        if ($n == 0)
            echo "No Pending Permissions.<br><a href='".site_url()."'>Home</a>";
        else{
            echo "<table class='table table-condensed table-bordered'>";
            echo "<thead><th>Name</th><th>Position</th><th>Organization</th><th>Status</th><th>Actions</th></thead>";
            for($i = 0; $i < $n; $i++)
            {   
                
                
                echo "<tr><td><a href='".site_url()."profile/".$inst[$i]['userID']."'> ".$inst[$i]['firstName']." ".$inst[$i]['lastName']."</a></td><td>".$inst[$i]['position']."</td><td>".$inst[$i]['organization'].
                        " </td><td>".ucfirst($inst[$i]['status'])."</td><td><a href='".site_url()."instructor/viewBio/".$inst[$i]['userID']."' class='btn btn-info' target='_blank'>View CV</a></td>
                        <td><a href='".site_url()."admin/verifyInstructor/".$inst[$i]['userID']."/1' class='btn btn-success'>Allow</a></td>
                        <td><a href='".site_url()."admin/verifyInstructor/".$inst[$i]['userID']."/0' class='btn btn-danger'>Deny Permission</a></td></tr>";
                
            }
            echo "</table>";
        }
        ?>
    </div>
    <script src="<?php echo site_url();?>assets/js/jquery.js"></script>
    <script src="<?php echo site_url();?>assets/js/scripts.js"></script>
</body>
</head>
