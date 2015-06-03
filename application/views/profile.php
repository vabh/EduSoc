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
        
        <div class="row">
            <div class="span3 page-header text-center" style="border-right:1px solid black;">
                <h3><img src="<?php if (isset($basic['photo'])) echo site_url ()."images/profile/".$basic['photo'];?>" class="img-polaroid span2"><br><br><br><br></h3>
                <!--Last seen: <?php if (isset($basic['lastLogin'])) echo $basic['lastLogin'];?><!--.'<br>converted:'.human_to_unix($basic['lastLogin']).'<br>current time:'.unix_to_human(human_to_unix($basic['lastLogin']));?> <br>-->
            </div>
            <div class="span5">
                <div class="page-header">
                    <h2>
                    <?php 
                    $this->load->helper('date');
                    echo $basic['firstName']." ".$basic['lastName'];
                    ?>
                    </h2>
                    <br>
                    <small>Email: <?php echo $basic['email']?></small>
                </div>
                
                <br>
                <?php
                if (isset($basic['username']))
                {?>
                    Username: <?php echo $basic['username'];?>
                <?php
                }
                ?>
                <br>
                <?php
                if (isset($basic['gender']))
                {?>
                    Username: <?php echo $basic['gender'];?>
                <?php
                }
                ?>
                <br>
                <?php
                if (isset($basic['dob']))
                {?>
                    Username: <?php echo $basic['dob'];?>
                <?php
                }
                ?>
                    <br>
                    
                
                <br>
                <?php
                //print_r($instructor);
                if(isset($instructor))
                {
                ?>
                    Organization: <?php if (isset($instructor['organization'])) echo $instructor['organization'];?> <br>
                    Position:<?php if (isset($instructor['position'])) echo $instructor['position'];?> <br>
                    Desc:<?php if (isset($instructor['des'])) echo $instructor['des'];?> <br>
                    Bio:<a href="<?php echo site_url()."instructor/viewBio/".$instructor['filename'];?>" target="_BLANK">Click</a><br>

                    Popularity:<?php if (isset($instructor['demand'])) echo $instructor['demand'];?> <br>
                <?php
                }
                if(!empty($recentActivity))
                {
                    echo '<ul class="nav nav-list"><li class="nav-header">Recent Activity</li><li class="divider"></li>';
                    for($i = 0; $i < count($recentActivity); $i++)
                    {
                        if (!empty($recentActivity[$i]['endDate']))
                        {
                            echo "<li>Completed the course <a href='".site_url()."course/profile/".$recentActivity[$i]['courseID']."'>".$recentActivity[$i]['courseName']."</a></li>";
                        }
                        else if (!empty($recentActivity[$i]['startDate']))
                        {
                            echo "<li><a href='".site_url()."course/profile/".$recentActivity[$i]['courseID']."'>Started the course ".$recentActivity[$i]['courseName']."</a></li>";
                        }
                    }
                    echo "</ul>";
                }
                ?>
            </div>
            <div class='span4'>
                <?php
                if(isset($friendStatus))
                {
                    if ($friendStatus == '1')
                        echo "<i class='icon-ok'></i> Friends";
                    if ($friendStatus == '-1')
                        echo "Not Friends";
                    if ($friendStatus == '2')
                        echo "Friend Request Sent";
                    if ($friendStatus == '0')
                        echo "<a href='".site_url()."add/friend/".$basic['userID']."'>Add friend</a>";
                    
                }
                if(isset($friends))
                {
                    echo "<br>".$basic['firstName']."'s Friends:<br>";
                    for($i = 0; $i < count($friends); $i++)
                    {

                        echo '<div class="media">';
                        echo '<a class="pull-left thumbnail">';
                           echo "<img style='height:64px; width:64px;'src='".site_url()."images/profile/".$friends[$i]['photo']."'>";
                        echo "</a>";
                        echo '<div class="media-body">';
                            echo "<a href='".site_url()."profile/".$friends[$i]['userID']."'>".$friends[$i]['firstName']." ".$friends[$i]['lastName']."</a><br>";
                        echo '</div></div>';
                    }
                }
                
               /*
                if(isset($awaitingFriendReq))
                {
                    echo '<br>Friend Requests:';
                    // print_r($awaitingFriendReq);
                    for($i = 0; $i < count($awaitingFriendReq); $i++)
                    {
                        echo "<a href='".site_url()."profile/".$awaitingFriendReq[$i]['userID']."'>".$awaitingFriendReq[$i]['firstName']." ".$awaitingFriendReq[$i]['lastName']."  </a> -- <a href='".site_url()."respondFriendReq/".$awaitingFriendReq[$i]['userID']."/1'>"."Accept</a> or <a href='".site_url()."respondFriendReq/".$awaitingFriendReq[$i]['userID']."/2'>"."Decline</a> <br>";
                    }
                }
                * */
            ?>
            </div>
        </div>
    </div>
    <script src="<?= site_url();?>assets/js/jquery.js"></script> 
    <script src="<?= site_url();?>assets/js/scripts.js"></script> 
    </body>
</html>