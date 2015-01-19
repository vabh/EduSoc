<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo site_url();?>assets/css/basic.css" />   
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
        <div class="row">
            <div class="span12 well" align="center">
                <?php
                if ($this->session->userdata('userType') == 'student')
                {?>
                    <a class='btn pull-left' href='<?= site_url()."study/".$coursecode;?>'><i class='icon-backward'></i>Course Home Page</a>
                <?php
                }
                else if($this->session->userdata('userType') == 'instructor')
                {?>
                    <a class='btn pull-left' href='<?= site_url()."course/continue/".$coursecode;?>'><i class='icon-backward'></i>Course Home Page</a>
                <?php
                }?>
                <br>
                <ul class="pager">
                    <li class="previous">
                      <?php echo "<a href='".$prev."'>Previous</a>";?>
                    </li>
                    <li class="next">
                       <?php echo "<a href='".$next."'>Next</a>";?>
                    </li>
                </ul>
                <hr>
                <p class="lead text-left">
                <?php
                echo $heading;
                ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="span7 well" id="video-container">
                <?php
                if(isset($video))
                {?>
                <video width="500px" controls>
                    <source src="<?php echo site_url ().'coursedata/video/'.$video;?>" type="video/mp4">
                    Your browser does not support HTML5 Video.
                </video>
                <?php }?>
            </div>
            <div class="span4" id="image-container">
                <?php
                if (isset($image))
                    echo "<img src = '".site_url ().'coursedata/image/'.$image."'/>";
                ?>
            </div>
        </div>
        <div class="row">
            <div class="row span12 well">
            <?php echo "<p class='lead text-left'>".$text."</p>";?>
            </div>
        </div>
    </div>
    <script src="<?= site_url();?>assets/js/jquery.js"></script>
    <script src="<?= site_url();?>assets/js/scripts.js"></script>
</body>
</html>