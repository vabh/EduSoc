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
            <div class="span8" style='margin-top: 20px;'>
                    <?php
                    if(isset($notifications)){
                        echo "<div style='line-height: 1.5;'>";
                        for($i = 0; $i < count($notifications['instructor']); $i++)
                        {
                            $dt = date("d-m-Y", strtotime($notifications['instructor'][$i]['dateOfCreation']));
                            
                            echo "<div class='media'>";
                                echo '<a class="pull-left" href="#">';
                                    echo "<img class='media-object' style='width:54px; height:54px;' src='".site_url()."images/course.gif'>";  
                                echo '</a>';
                                echo '<div class="media-body">';
                                    echo "<a href='".site_url()."profile/".$notifications['instructor'][$i]['userID']."' target='_blank'>".$notifications['instructor'][$i]['firstName']." ".$notifications['instructor'][$i]['lastName']."</a> created a course <a href='".site_url()."course/profile/".$notifications['instructor'][$i]['courseID']."' target='_blank'>".$notifications['instructor'][$i]['courseName']."</a> on ".$dt."<br>";  
                                echo "</div>";
                            echo "</div>";
                        }

                        for($i = 0; $i < count($notifications['student']); $i++)
                        {

                            $startDate = date("d-m-Y", strtotime($notifications['student'][$i]['startDate']));
                            $endDate = isset($notifications['student'][$i]['endDate'])?date("d-m-Y", strtotime($notifications['student'][$i]['endDate'])):"";

                            echo "<div class='media'>";
                                echo '<a class="pull-left" href="#">';
                                    if($endDate != "")
                                        echo "<img class='media-object' style='width:54px; height:54px;' src='".site_url()."images/gradcap.gif'>";
                                    else
                                        echo "<img class='media-object' style='width:54px; height:54px;' src='".site_url()."images/study.png'>";
                                echo '</a>';
                                echo '<div class="media-body">';
                                    if($endDate != "")
                                        echo "<a href=".site_url()."profile/".$notifications['student'][$i]['userID']." target='_blank'>".$notifications['student'][$i]['firstName']." ".$notifications['student'][$i]['lastName']."</a> has completed <a href='".site_url()."course/profile/".$notifications['student'][$i]['courseID']."' target='_blank'>".$notifications['student'][$i]['courseName']."</a> on ".$endDate." with ".$notifications['student'][$i]['percentage']."%<br>";
                                    else
                                        echo "<a href=".site_url()."profile/".$notifications['student'][$i]['userID']." target='_blank'>".$notifications['student'][$i]['firstName']." ".$notifications['student'][$i]['lastName']."</a> has signed up for <a href='".site_url()."course/profile/".$notifications['student'][$i]['courseID']."' target='_blank'>".$notifications['student'][$i]['courseName']."</a> on ".$startDate."<br>";
                                echo "</div>";
                            echo "</div>";

                            
                        }
                        echo "</div>";
                    }
                    else
                        echo "<h2>Add friends, and see what they are busy studying!</h2>";
                    ?>
                </div>
                
                <div class="span4">

                    <a href="<?php echo site_url();?>instructor/bio" class='btn btn-success'>Update Bio</a><br><br>
                    <a id="create" href="<?php echo site_url();?>course/create" class="btn btn-primary">Create Course</a>
                    <a href="<?php echo site_url();?>course/exam" class='btn btn-primary'>Create Exam</a><br><br>
                
                <?php
                    if(isset($instructing))
                    {  
                        echo '<ul class="nav nav-list"><li class="nav-header">My Courses</li><li class="divider"></li>';
                        for ($i = 0; $i < count($instructing); $i++)
                            echo "<li><a href='".site_url()."course/continue/".$instructing[$i]['courseID']."'>".$instructing[$i]['courseName']."</a></li>"; 
                        echo "</ul>";
                    }
                ?>
                </div>
        </div>
    </div>
    <script src="<?php echo site_url();?>assets/js/jquery.js"></script> 
    <script src="<?php echo site_url();?>assets/js/scripts.js"></script> 
    <?php
    if($this->session->userdata('instructorStatus') != 'approved')
    {?>
    <script> 
        var e = document.getElementById('create');
        e.className = e.className + ' disabled';
        e.href = null;
        
        
        onload=function()//notifications
            {
            
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            
            xmlhttp.open("GET","<?php echo site_url();?>users/updateNotifications",true);
            xmlhttp.send();
            }
            
    </script>
    
    <?php } ?>
</body>
</html>