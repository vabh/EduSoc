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
        <form method="POST" id="create">
            Course:
            <select id="course" name="course">
                <?php
                    for($i = 0; $i < count($instructing);$i++)
                        echo "<option value='".$instructing[$i]['courseID']."'>".$instructing[$i]['courseName']."</option>"
                ?>
            </select><br>
            Question:<textarea name="question" required="required"></textarea><br>
            Correct Option<input type="text" name="cOption" required="required"><br>
            Wrong Option<input type="text" name="wOption1" required="required"><br>
            Wrong Option<input type="text" name="wOption2" required="required"><br>
            Wrong Option<input type="text" name="wOption3" required="required"><br>
            DIfficulty:<input type="text" name="difficulty" required="required"><br>
            <input type="submit" class="btn" value="Create Question">&nbsp;&nbsp;
            <a href="<?php echo site_url(); ?>" class="btn btn-info"><i class="icon-ok"></i>&nbsp;&nbsp; Done</a>
        </form>
    </div>
    <script src="<?php echo site_url();?>assets/js/jquery.js"></script>
    <script src="<?php echo site_url();?>assets/js/scripts.js"></script>
    <script>
        <?php
        echo "var p = \"".site_url()."\";";
        if(isset($course))
            echo "var c = \"".$course."\";";
        ?>
        if(c != "")
        {
            $('#course').val(c);  
        }
        $('#course').change(function(){
            $('#create').attr('action', p + 'course/exam/' + $('#course').val());
        });
    </script>
</body>
</html>