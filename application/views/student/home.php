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
        
        <div class="container ">
            
            <?php
            
            if(isset($studying))
            {?>
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
                    <?php 
                    //enrolled courses
                    if(isset($studying))
                    {
                        if(count($studying) == 0)
                            echo "<h3 style='text-align:center'>Check out our exciting courses, and learn awesome stuff!</h3>";
                        else
                        {
                            echo '<ul class="nav nav-list"><li class="nav-header">My Courses</li><li class="divider"></li>';
                            for ($i = 0; $i < count($studying); $i++)
                                echo "<li><a href='".site_url()."study/".$studying[$i]['courseID']."'>".$studying[$i]['courseName']."</a></li>"; 
                            echo "</ul>";
                        }
                    }
                    ?>
                </div>
            </div>
            <?php }
            
            
            if(!isset($course) && isset($awaitingFriendReq))
                {
                    echo '<br>Friend Requests:';
                    // print_r($awaitingFriendReq);
                    for($i = 0; $i < count($awaitingFriendReq); $i++)
                    {
                        echo "<a href='".site_url()."profile/".$awaitingFriendReq[$i]['userID']."'>".$awaitingFriendReq[$i]['firstName']." ".$awaitingFriendReq[$i]['lastName']."  </a> -- <a href='".site_url()."respondFriendReq/".$awaitingFriendReq[$i]['userID']."/1'>"."Accept</a> or <a href='".site_url()."respondFriendReq/".$awaitingFriendReq[$i]['userID']."/2'>"."Decline</a> <br>";
                    }
                }
                echo "<br><br>";
            
            
            
            
            //course catalog view
            if(isset($course))
            {
                echo "<table class='table table-bordered table-hover'>";
                echo "<thead><tr><th>Course Name</th><th>Subject</th><th>Popularity</th><th>Instructor</th></tr></thead>";
                for($i = 0; $i < count($course);$i++)
                {
                    echo "<tr><td><input type='button' class='btn' value='".$course[$i]['courseName']."' data-course='".$course[$i]['courseID']."' data-signup='".$course[$i]['signup']."'></td>";
                    
                    echo "<td>".$course[$i]['name']."</td>";
                    echo "<td>".(isset($course[$i]['popularity'])?$course[$i]['popularity']:'-')."</td>";
                    echo "<td><a href='".site_url().'profile/'.(isset($course[$i]['username'])?$course[$i]['username']:$course[$i]['userID'])."'>".$course[$i]['firstName']." ".$course[$i]['lastName']."</a></td></tr>";
                }
                echo "</table>";
            }
            
        echo "</div>";
        
        //course catalog view
        if(isset($course))
        {?>
        <!--course modal-->
        <div id="course-modal" class="modal hide fade" tabindex="-1" role="dialog">  
            <img id="loader" style="display:none; height: 100px; width: 100px;" src="<?php echo site_url();?>images/loading.gif">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <div id="modal-header-content"></div>
            </div>
            <div class="modal-body" id="course-desc"></div>
            <div class="modal-footer">
                <a href="" class="btn btn-info pull-left" id="profile-btn">Visit Course Profile</a>
                <a href="" class="btn btn-success" id="study-btn">Sign Up</a>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
        <?php } ?>
        
        
        <div id="notif-modal" class="modal hide fade" tabindex="-1" role="dialog">     
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Notifications</h3>
        </div>
        <div class="modal-body">
            <?php
            
            for($i = 0; $i < count($notifications['instructor']); $i++)
            {
                $dt = date("d-m-Y", strtotime($notifications['instructor'][$i]['dateOfCreation']));
                echo "<a href='".site_url()."profile/".$notifications['instructor'][$i]['userID']."' target='_blank'>".$notifications['instructor'][$i]['firstName']." ".$notifications['instructor'][$i]['lastName']."</a> created a course <a href='".site_url()."course/profile/".$notifications['instructor'][$i]['courseID']."' target='_blank'>".$notifications['instructor'][$i]['courseName']."</a> on ".$dt."<br>";
            }
            
            for($i = 0; $i < count($notifications['student']); $i++)
            {
                
                $startDate = date("d-m-Y", strtotime($notifications['student'][$i]['startDate']));
                $endDate = isset($notifications['student'][$i]['endDate'])?date("d-m-Y", strtotime($notifications['student'][$i]['endDate'])):"";
                
                if($endDate != "")
                    echo "<a href=".site_url()."profile/".$notifications['student'][$i]['userID']." target='_blank'>".$notifications['student'][$i]['firstName']." ".$notifications['student'][$i]['lastName']."</a> has completed <a href='".site_url()."course/profile/".$notifications['student'][$i]['courseID']."' target='_blank'>".$notifications['student'][$i]['courseName']."</a> on ".$endDate." with ".$notifications['student'][$i]['percentage']."%<br>";
                else
                    echo "<a href=".site_url()."profile/".$notifications['student'][$i]['userID']." target='_blank'>".$notifications['student'][$i]['firstName']." ".$notifications['student'][$i]['lastName']."</a> has signed up for <a href='".site_url()."course/profile/".$notifications['student'][$i]['courseID']."' target='_blank'>".$notifications['student'][$i]['courseName']."</a> on ".$startDate."<br>";
            }
            
            
            ?>
        </div>
        <div class="modal-footer">
            
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>
        
        
         
        <script src="<?php echo site_url();?>assets/js/jquery.js"></script> 
        <script src="<?php echo site_url();?>assets/js/scripts.js"></script> 
        
        <script>
            <?php
            $u = $this->session->userdata('userType');
            if($u == 'instructor' || $u == 'admin')
                echo "var dis='0';";
            else echo "var dis='1';";?>
            if(dis == '0')
                $('#study-btn').css('display', 'none');
        //course catalog view
        <?php
        if(isset($course))
        {?>
            <?php echo "var path =\"".site_url()."\";";?>
            $("input[type=button]").click(function(){
                var cId = $(this).data("course");
                if($(this).data('signup') == 1)
                {
                    window.location = path+"study/"+cId;
                }
                else
                {
                    $('#course-modal').modal('show');
                    $('#loader').css('display','block');
                    $('#modal-header-content').html('<h3>'+$(this).val()+'</h3>');
                    
                    $.post(path + 'student/courseInfo',{code: cId},function(e){
                        $('#course-desc').html(e); 
                        $('#loader').css('display','none');
                    });
                    $('#study-btn').attr('href', path+"course/study/" + cId);
                    $('#profile-btn').attr('href', path+"course/profile/" + cId);
                }
            });
        <?php
        }
        ?>
                
        
            onload=function()
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
        
    </body>
</html>