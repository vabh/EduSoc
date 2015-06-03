<!doctype HTML>
<html lang="en">
	<head>
		<title>Forum</title>
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
				<div class='span7'>
					<a href="#thread" role="button" class="btn" data-toggle="modal">Start a New Discussion</a><br><br>
					<?php
					
					if(isset($threads))
					{
						foreach ($threads as $value) {
							echo "<div class='alert alert-info'><a class='text-error' href='".site_url()."forum/thread/".$value['threadID']."'>".$value['subject']."</a></div>";
						}
					}
					?>
				</div>
				<div class='span4 offset1'>
					<a href='<?= site_url()."study/".$courseID; ?>'>Back to studies!</a>
				</div>
			</div>
		</div>

		<!--thread modal-->
		<div id="thread" class="modal hide fade" tabindex="-1" role="dialog">     
	        <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	            <h3>New Discussion</h3>
	        </div>
	        <div class="modal-body">
	            <form action='<?php echo site_url()."forum/new/thread/".$courseID; ?>' method='post'>
        			<input type='text' name='subject' id='subject' placeholder='Topic' required><br>
        			<textarea name='content' placeholder='What you want to discuss' required></textarea>
	        </div>
	        <div class="modal-footer">
	            <input type="submit" value="Start Discussion" class="btn btn-primary"/>
	            </form>
	            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	        </div>
		</div>
		<script src="<?php echo site_url();?>assets/js/jquery.js"></script>
        <script src="<?php echo site_url();?>assets/js/scripts.js"></script>
	</body>
</html>