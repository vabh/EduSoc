<!doctype HTML>
<html lang="en">
	<head>
		<title>Posts</title>
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
				<div class="span12 page-header">
				<a class='btn' href='<?= site_url()."forum/".substr($threads['threadID'], 0, strpos($threads['threadID'], '-'));?>'><i class='icon-backward'></i>Forum</a>
				<?php

					if(isset($threads) && !empty($threads))
					{
						echo "<h2>".$threads['subject']."<br><small><span class='pull-left'>".$threads['firstName']." ".$threads['lastName']."</span><span class='pull-right'>".$threads['date']."</span></small></h2><br>";
						echo "<div class='alert alert-info' style='font-size: 1.5em'>".$threads['content']."</div>";
					}

				echo "</div>";
				echo "<div class='row'>";
					if(isset($posts) && !empty($posts))
					{
				?>	
					
					<?php
					foreach ($posts as $value) {

						echo '<div class="span7 alert">';
						echo $value['content']."<br>";
						echo "<a href='".site_url()."profile/".$value['userID']."'>".$value['firstName']." ".$value['lastName']."</a><br>";
						echo $value['date']."<br>";
						echo '</div>';
					}
					?>
					
				
				<?php		
					}
					else echo "No Posts Yet!";

				?>
				<div class='span4'>
					<a href="#post-modal" role="button" class="btn btn-large" data-toggle="modal">Post to this thread</a>
				</div>
				</div>
			</div>
		</div>

		<!--post modal-->
		<div id="post-modal" class="modal hide fade" tabindex="-1" role="dialog">     
	        <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	            <h3>New Post</h3>
	        </div>
	        <div class="modal-body">
	            <form action='<?php echo site_url()."forum/thread/".$threads['threadID']; ?>' method='post'>
        			
        			<textarea name='content' placeholder='What you want to say' required></textarea>
	        </div>
	        <div class="modal-footer">
	            <input type="submit" value="Post" class="btn btn-primary"/>
	            </form>
	            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	        </div>
		</div>

		<script src="<?php echo site_url();?>assets/js/jquery.js"></script>
        <script src="<?php echo site_url();?>assets/js/scripts.js"></script>
	</body>
</html>