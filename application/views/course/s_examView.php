<!doctype HTML>
<html lang="en">
<head>
    <title>Exam</title>
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
    	<div class='row'>
    		<div class='span8'>
			    <form name = 'exam' method="post" >
			    	<?php
                                if(isset($questionbank)){
			    	for($i = 0; $i < count($questionbank); $i++)
			    	{
			    		?>
			    		<div class='row span7 alert'>
					<?php
			    		echo "<div class='alert alert-success' style='margin-bottom:0px'>".$questionbank[$i]['question']."</div><br>";
			    		echo "<input type='hidden' name='question".$i."' value='".$questionbank[$i]['questionID']."'/>\n";
			    		//echo "<select name='answer".$i."'>\n";
			    		echo "<div class='alert alert-info' style='margin-top:0px;'>";
			    		echo "<input type='radio' name='answer".$i."' value='".$questionbank[$i]['options'][0]."'>".$questionbank[$i]['options'][0]."<br>\n";
			    		echo "<input type='radio' name='answer".$i."' value='".$questionbank[$i]['options'][1]."'>".$questionbank[$i]['options'][1]."<br>\n";
			    		echo "<input type='radio' name='answer".$i."' value='".$questionbank[$i]['options'][2]."'>".$questionbank[$i]['options'][2]."<br>\n";
			    		echo "<input type='radio' name='answer".$i."' value='".$questionbank[$i]['options'][3]."'>".$questionbank[$i]['options'][3]."\n\n";
			    		echo "</div>"
		    		?>
		    			</div>
		    		<?php
			    	}
                                
			    	?>
			    	<input type='submit' value='Done' class="btn btn"/>
                                <?php
                                }
                                else echo "No question posted yet";
                                ?>
			    </form>
	    	</div>
	    	<div class='span4'>
	    		<a href='#' class='btn btn-large' onclick='javascript:document.exam.submit();'>Submit</a>
	    	</div>
		</div>
 	</div>
 	<script src="<?php echo site_url();?>assets/js/jquery.js"></script>
	<script src="<?php echo site_url();?>assets/js/scripts.js"></script>
</body>
</html>