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
        <div class="span7">
        
        <div class="page-header">
            <h2>
            <?php 
                echo $courseName;
            ?>
            </h2>
            <br>
            <small>About: <?php echo $description?></small>
        </div>
            Units in this course:
            <?php
        for($i = 0; $i < count($units); $i++)
        {
            $u = $units[$i];

            echo "<br>".$u['unitName'];
            
        }
        ?>
        </div>
    <div class='span4'>
                <?php
                if($signed == 1 && $this->session->userdata('userType') == 'student')
                {
                    if ($progress['lastPage'] == '0')
                    {
                        $page = $courseID.'-U1-C1-P1';
                        echo 'You are signed up for this course!<a href="'.site_url().'study/page/'.$page.'" class="btn btn-large btn-success" style="width: 180px;">Start!</a>';
                    }
                    else
                    echo 'You are signed up for this course!<br><a href="'.site_url().'study/page/'.$progress['lastPage'].'" class="btn btn-large btn-success" style="width: 180px;">Continue!</a><br>';
                }
                else if ($signed == 0 && $this->session->userdata('userType') == 'student')
                {
                    echo 'Sign up for this course today!<br><a href="'.site_url().'course/study/'.$courseID.'" class="btn btn-large btn-success" style="width: 180px;">Sign up!</a><br>';
                }
                if(isset($coursetakers))
                {
                    echo "<br>People studying ".$courseName.":<br>";
                    for($i = 0; $i < count($coursetakers); $i++)
                    {

                        echo '<div class="media">';
                        echo '<a class="pull-left thumbnail">';
                           echo "<img style='height:64px; width:64px;'src='".site_url()."images/profile/".$coursetakers[$i]['photo']."'>";
                        echo "</a>";
                        echo '<div class="media-body">';
                            echo "<a href='".site_url()."profile/".$coursetakers[$i]['userID']."'>".$coursetakers[$i]['firstName']." ".$coursetakers[$i]['lastName']."</a><br>";
                        echo '</div></div>';
                    }
                }
                
               
            ?>
            </div>
        </div>
    <script src="<?php echo site_url();?>assets/js/jquery.js"></script>
    <script src="<?php echo site_url();?>assets/js/scripts.js"></script>
</body>
</html>