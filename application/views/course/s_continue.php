<!doctype HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= site_url();?>assets/css/basic.css" />   
    <style>
    td{padding: 3px;}
    </style>
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
            <div class="span8">
                <div class="row">
                    <p class="unit-name"><?= $courseName; ?></p>
                    <div class="span8 progress progress-info progress-striped active" style="height: 30px;">
                        <div class="bar" style="width: 0%; height: 100%"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="span8">
                        <div class="span12 page-header">
                    <?php
                    $totalPages = 0;
                        for($i = 0; $i < count($units); $i++)
                        {
                            $u = $units[$i];
                            echo "<div class='row'><div class='span7 unit-container'>";
                            echo "<span class='unit-name'>".$u['unitName']."</span>";

                            for($j = 0; $j < count($chapters[$i]); $j++)
                            {
                                echo "<div class='accordion' id='accordion".$j."'>";
                                echo "<div class='accordion-group'>";
                                    //accordion heading
                                    echo '<div class="accordion-heading">';
                                        echo '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.$j.'" href="#'.$chapters[$i][$j]['chapterID'].'">';
                                            echo $chapters[$i][$j]['chapterName'];
                                        echo '</a>';
                                    echo '</div>';
                                    //heading end
                                $n = count($pages[$i][$j]);
                                $totalPages = $totalPages + $n;
                                    echo '<div id="'.$chapters[$i][$j]['chapterID'].'" class="accordion-body collapse">';
                                        echo '<div class="accordion-inner"><table>';
                                        for($k = 0; $k < $n; $k++)
                                        {
                                            echo "<tr><td>".(in_array($pages[$i][$j][$k]['pageID'], $visitedPages)?"<i class='icon-ok'></i>":" ")."</td><td>".($i+1)."-".($j+1)."-".($k+1).": </td><td><a href='".site_url()."study/page/".$pages[$i][$j][$k]['pageID']."'>".$pages[$i][$j][$k]['heading']."</a></td></tr>";
                                        }
                                        echo '</table></div>';
                                    echo '</div>';
                                echo "</div></div>";//accordion-group end
                            }
                            echo "</div></div>";
                        }
                    ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span3 offset1">
                <?php
                if ($progress['lastPage'] == '0')
                {
                    $page = $courseID.'-U1-C1-P1';
                    echo '<a href="'.site_url().'study/page/'.$page.'" class="btn btn-large btn-success" style="width: 180px;">Start!</a>';
                }
                else
                   echo '<a href="'.site_url().'study/page/'.$progress['lastPage'].'" class="btn btn-large btn-success" style="width: 180px;">Continue!</a>';
                
                if($progress['certified'] == '1' )
                    echo "<p style='margin-top:10px;' class='alert alert-success'>You have been certified with a percentage of <strong>".$progress['percentage']."</strong></p>";               
                else if($totalPages == count($visitedPages) && $totalPages != 0)
                    echo "<p style='margin-top:10px;' class='alert alert-success'>Looks like you have completed studying everything! <a href='".site_url()."exam/".$courseID."'>Ready to take the test?</a></p>";
                ?>
                <p><a href="<?php echo site_url()."course/profile/".$courseID?>">Course Profile</a></p>
                <p><a href="<?php echo site_url()."forum/".$courseID?>">View Forum</a></p>
                <p><a href="<?php echo site_url()."student/studygroup/".$courseID?>">Study Group</a></p>
                
            </div>
        </div>
       
    </div>  
    <script src="<?= site_url();?>assets/js/jquery.js"></script>
    <script src="<?= site_url();?>assets/js/scripts.js"></script>
    <script>
    <?php
        if($totalPages != 0)
            echo "var p='".count($visitedPages)*100/$totalPages."';";
        else
            echo "var p='0';";
    ?>
        var w = parseInt(p) * 620 / 100;
        var progress = setInterval(function() {
            var $bar = $('.bar');
            
            if ($bar.width() >= w || $bar.width()+62 >= w) {
                $bar.width(w);
                clearInterval(progress);
                $('.progress').removeClass('active');
            } 
            else{
                $bar.width($bar.width()+62);
            }
            //$bar.text(parseInt($bar.width()*100/620) + "%");
        }, 1);
    </script>
</body>
</html>