<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="<?= site_url()?>assets/css/basic.css" />    
        <script type="text/javascript">
            var hash = {
            '.mp4'  : 1,
            '.jpg' : 2
            };

            function check_extension(filename,submitId,type) {
                var i = filename.lastIndexOf('.');
                var ext = '';
                if (i != -1) {
                    ext = filename.substr(i);
                } 
                var submitEl = document.getElementById(submitId);
                if (hash[ext] == type) {
                    submitEl.disabled = false;
                    return true;
                } else {
                    alert("Invalid filename, please select another file");
                    submitEl.disabled = true;
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a href="<?php echo site_url();?>" class="brand">OLE</a>
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
                <div class="span12 well" align="center">
                    <p class="lead">
                    
                    <?php
                    $path = site_url()."course/new/page/".$chapterID;
                    echo form_open_multipart($path);
                    ?>
                    
                    <input type="text" class="span6" name="heading" id="heading" placeholder="Page Heading" required><br>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="span6 well" id="video-container">
                    Upload Video: <input type="file" name="video" id="video" onchange="check_extension(this.value,'upload',1)"><br>
                </div>
                <div class="span4" id="image-container">
                    Upload Image: <input type="file" name="image" id="image"><br>
                </div>
            </div>
            <div class="row">
                <div class="row span12 well" align="center">
                    Text:<br><textarea name="text" id="text" class="span10" rows="5" required></textarea><br>
                    <input type="submit" id="upload"/>
                    </form>
                </div>
            </div>
        </div>
    <script src="<?php echo site_url();?>assets/js/jquery.js"></script>
    <script src="<?php echo site_url();?>assets/js/scripts.js"></script>
    </body>
    
</html>