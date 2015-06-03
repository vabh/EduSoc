<!doctype html>
<html>
    <head>
        <title>Create Course</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="<?php echo site_url();?>assets/css/basic.css" />
        <script>
            window.onload=function()
            {
                document.getElementById("submitButton").style.display='none';
                document.getElementById("JSsubmitButton").style.display='block';
            }
            function checkCode(str)
            {
                str = str.replace(/\s+/g,' ').replace(/^\s+|\s+$/,'');       
                document.getElementById('code').value = str;
                document.getElementById('loader').style.visibility='visible';
                
		// Check for white space
		if (str.indexOf(' ') >= 0) 
                {                
                    //Check For Spaces
                    document.getElementById("txtHint").innerHTML="No white space allowed";
                    document.getElementById('loader').style.visibility='hidden';
                    return;
                }
                else
                {
                    if (str.length==0)
                    { 
                        document.getElementById("txtHint").innerHTML="";
                        document.getElementById('loader').style.visibility='hidden';
                        return;
                    }
                    if (window.XMLHttpRequest)
                    {// code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp=new XMLHttpRequest();
                    }
                    else
                    {// code for IE6, IE5
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange=function()
                    {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200)
                        {
                            document.getElementById('loader').style.visibility='hidden';
                            document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET","<?php echo site_url(); ?>instructor/checkCodeExists/"+str,true);
                    xmlhttp.send();
                }                
            }
            function showMessage()
            {
                document.getElementById('message').style.display = 'block';
            }
            function submitForm()
            {
                str = document.getElementById('code').value;/*check for allowed characters*/
                if (str.indexOf(' ') >= 0) 
                {                
                    //Check For Spaces
                    showMessage();
                    document.getElementById("message").innerHTML="Check your data";
                    return;
                }
                else
                {
                    if (str.length==0)
                    { 
                        showMessage();
                        document.getElementById("message").innerHTML="Please fill all fields";
                        return;
                    }
                    else
                        document.forms['createCourse'].submit();
                }
                
            }
        </script>
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
            <!--form-->
            <div class="alert alert-error" id="message" style="display:none;">
            <?php 
                if (isset($message))
                    echo "<h3>".$message."</h3>";
                echo "</div>";
                
                $attributes = array('id' => 'createCourse');
                echo form_open('',$attributes);
            ?>
            Course Name: <input type='text' name='courseName' id='courseName' value="<?php echo set_value('courseName'); ?>"><br>
            Course Code: <input type='text' name='code' id='code' onchange="checkCode(this.value)" value="<?php echo set_value('code'); ?>"><span id="txtHint"></span><img id="loader" style="visibility:hidden; height: 20px; width: 20px;" src="<?php echo site_url();?>images/loading.gif"><br/><br>
            Description: <textarea name='description' id='desc'><?php echo set_value('description'); ?></textarea><br>
            Tags: <textarea name='tags' id='tags'><?php echo set_value('tags'); ?></textarea><br>
            
            Stream: <select name="stream" id="stream">
                    <?php
                        for($i = 0; $i < count($streams);$i++)
                            echo "<option>".$streams[$i]."</option>";
                    ?>
                    </select><br>
            Subject: <select name="subject" id="subject">
                    <?php
                         for($i = 0; $i < count($subjects);$i++)
                            echo "<option value='".$subjects[$i]['subjectID']."'>".$subjects[$i]['name']."</option>";
                    ?>
                    </select><br>
            <input type='button' value='Create Course1' id="JSsubmitButton" onClick="submitForm()" style="display:none" class='btn'>
            <input type="submit" value="Create Course" id="submitButton" class="btn">
            </form>
        </div>
     <script src="<?php echo site_url();?>assets/js/jquery.js"></script>
    <script src="<?php echo site_url();?>assets/js/scripts.js"></script>
    </body>
</html>