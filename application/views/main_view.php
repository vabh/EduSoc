<!doctype HTML>
<html lang="en">
    <head>
        <title>OLE</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="<?php echo site_url();?>assets/css/basic.css" />
        <link rel="stylesheet" href="<?php echo site_url();?>assets/css/bootstrap-responsive.css" />
        
        <style>
            #full-screen-slider {
                margin-bottom: 0;
                }
                .carousel .carousel-inner .item img {
                width: 100%;
                }
                .all-sliders {
                position: fixed;
                top: 25px;
                left: 25px;
                right: 25px;
                color: white;
                z-index: 10;
                }
                .all-sliders:hover {
                color: white;
                }
                .dropdown-menu>li>a:hover{
                background: #fff;
            }
        </style>
    </head>
    <body style="padding-top:0px;">
        <div class="navbar-wrapper all-sliders">
       
            <div class="container">

                <div class="navbar">
                <div class="navbar-inner">
                   
                    <a class="brand" href="#">EduSoc</a>
                    <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
                    <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li><a href="#">Home</a></li>
                        <li><a href="<?php echo site_url();?>signup">Sign Up</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <?php
                                if(isset($message))
                                echo "<li><a class='alert alert-error'>".$message."</a></li>";
                                ?>
                                <li><?php echo form_open("login");?></li>
                                <li><a><input type="text" name="username" id="sername" placeholder="Username" required/></a></li>
                                <li><a><input type="password" name="password" id="password" placeholder="Password" required/></a></li>
                                <li><a><input type="submit" class="btn btn-success" value="Start Learning"/></a></li>
                            </ul>
                        </li>
                    </ul>
                    </div><!--/.nav-collapse -->
                </div><!-- /.navbar-inner -->
                </div><!-- /.navbar -->

            </div> <!-- /.container -->
        </div>
        
        <div id="full-screen-slider" class="carousel slide">
      <div class="carousel-inner">
        <div class="active item">
          <img src="<?php echo site_url();?>images/carousel/1.jpg">
          <div class="carousel-caption">
            <h4><b>Education that knows no bounds</b></h4>
            <p>
              Education such that you can learn anything from anywhere at anytime
            </p>
          </div>
        </div>
          <div class="item">
          <img src="<?php echo site_url();?>images/carousel/5.jpg">
          <div class="carousel-caption">
            <h4><b>A system of education managed by you, for you</b></h4>
            <p>
              Anyone can apply for being a course instructor! 
              So you design your course, to your specifications!
            </p>
          </div>
        </div>
        <div class="item">
          <img src="<?php echo site_url();?>images/carousel/2.jpg">
          <div class="carousel-caption">
            <h4><b>Education is a Social Activity</b></h4>
            <p>
              Learn with your friends, collaborate and spread the cheer of education.
              Together we stand!
            </p>
          </div>
        </div>
          <div class="item">
          <img src="<?php echo site_url();?>images/carousel/3.jpg">
          <div class="carousel-caption">
            <div class="carousel-caption">
            <h4><b>A World of knowledge awaits you</b></h4>
            <p>
              The range of courses are limitless. Join us today!
            </p>
          </div>
          </div>
        </div>
          <div class="item">
          <img src="<?php echo site_url();?>images/carousel/4.jpg">
          <div class="carousel-caption">
          <h4><b>A system of education managed by you, for you</b></h4>
            <p>
              Anyone can apply for being a course instructor! 
              So you design your course, to your specifications!
            </p>
          </div>
        </div>
          <div class="item">
          <img src="<?php echo site_url();?>images/carousel/6.jpg">
          <div class="carousel-caption">
            <h4><b>Education is a Social Activity</b></h4>
            <p>
              Learn with your friends, collaborate and spread the cheer of education.
              Together we stand!
            </p>
          </div>
        </div>
          <div class="item">
          <img src="<?php echo site_url();?>images/carousel/7.jpg">
          <div class="carousel-caption">
            <h4><b>Education that knows no bounds</b></h4>
            <p>
              Education such that you can learn anything from anywhere at anytime
            </p>
          </div>
        </div>
          
      </div>
      <a class="left carousel-control" href="#full-screen-slider" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#full-screen-slider" data-slide="next">&rsaquo;</a>
    </div>
        
        <script src="<?php echo site_url();?>assets/js/jquery.js"></script>
        <script src="<?php echo site_url();?>assets/js/scripts.js"></script>
        <script type="text/javascript">
            <?php
            if(isset($message))
                echo "$('.dropdown-toggle').dropdown('toggle');";
            ?>
            $('.dropdown-menu input').click(function(e){e.stopPropagation();});
            $('.carousel').carousel({interval :3000})  
            
            
            $(document).ready(function() {
              function setFullScreen() {
                  browserHeight = $(window).height();
                  $("#full-screen-slider .carousel-inner .item img").css({
                  height: browserHeight
                  });
              }

              setFullScreen();

              $(window).resize(function() {
                  setFullScreen();
              });

              $("#slider-fluid-banner").carousel({ interval: 7000 });
              $("#slider-fluid-products").carousel({ interval: 8000 });
              $("#slider-fixed-banner").carousel({ interval: 7000 });
              $("#slider-fixed-products").carousel({ interval: 8000 });
              $("#patnerSlider").carousel({ interval: 5000 });
            });

            
        </script>
    </body>
</html>