<!doctype HTML>
<html lang="en">
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
            <div class="span8">
                <h3><?= $courseInfo['courseName'];?></h3>
                <a href="#unit-modal" role="button" class="btn" data-toggle="modal">New Unit</a>
                <ul style="line-height: 5">
                <?php
                    for($i = 0; $i < count($units); $i++)
                    {
                        $u = $units[$i];
                        echo "<li>Unit ".($i + 1).": ".$u['unitName']." <button class='btn btn-mini btn-success' onclick='getForm(\"".$u['unitID']."\")'>New Chapter</button>"."</li>";
                        
                        if(count($chapters[$i]) > 0)
                        {
                        
                            echo "<div class='alert'>";
                            echo "<ul>";
                            for($j = 0; $j < count($chapters[$i]); $j++)
                            {
                                echo "<li>Chapter ".($j + 1).": ".$chapters[$i][$j]['chapterName']." <a href='".site_url()."course/new/page/".$chapters[$i][$j]['chapterID']."' class='btn btn-mini btn-warning'>New Page</a>"."</li>";

                                if (count($pages[$i][$j]) > 0){
                                echo "<div class='alert alert-info'><ul>";
                                for($k = 0; $k < count($pages[$i][$j]); $k++)
                                {
                                    echo "<li>Page ".($k + 1).": <a href='".site_url()."course/view/".$pages[$i][$j][$k]['pageID']."'>".$pages[$i][$j][$k]['heading']."</a></li>";
                                }
                                echo "</ul></div>";
                                }
                            }
                            echo "</ul></div>";
                        }
                        
                    }
                    
                ?>
                </ul>
            </div>
            <div class="span4">
                <?php 
                if($courseInfo['status'] != '1')
                    echo "<a href='".site_url()."instructor/openCourse/".$courseID."' class='btn btn-success btn-large'>Open Course</a>";
                ?>
            </div>
        </div>
    </div>
    <!--new unit form-->
    <div id="unit-modal" class="modal hide fade" tabindex="-1" role="dialog">     
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>New Unit</h3>
        </div>
        <div class="modal-body">
            <?php
            $path = site_url()."course/new/unit/".$courseID;
            echo form_open($path);
            ?>
            Name: <input type="text" name="unitName" id="unitName" required="required"/><br/>
            Description: <textarea name="description" id="description" required="required"></textarea>
        </div>
        <div class="modal-footer">
            <input type="submit" value="Create Unit" class="btn btn-primary"/>
            </form>
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>
    
    <!--new chapter form-->
    <div id="chapter-modal" class="modal hide fade" tabindex="-1" role="dialog">     
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>New Chapter</h3>
        </div>
        <div class="modal-body">
            
            <?php
            $path = site_url()."course/new/chapter/";
            $atr = array('id' => 'chapter-form');
            echo form_open($path, $atr);
            ?>
        
            Name: <input type="text" name="chapterName" id="chapterName" required="required"/><br/>
            Description: <textarea name="description" id="description" required="required"></textarea>    
        </div>
        <div class="modal-footer">
            <input type="submit" value="Create Chapter" class="btn btn-primary"/>
            </form>
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>
    
    <script src="<?php echo site_url();?>assets/js/jquery.js"></script>
    <script src="<?php echo site_url();?>assets/js/scripts.js"></script>
    <script>
        <?php
            $path = site_url()."course/new/chapter/";
            echo "var base=\"".$path."\";";
        ?>
            
        function getForm( id )
        {
            $('#chapter-form').attr('action', base + id);
            $('#chapter-modal').modal('show');
        }
    </script>
</body>
</html>