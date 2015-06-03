<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="<?php echo site_url();?>assets/css/basic.css" />
        <script>
            function check(str)
            {                
                document.getElementById('loader').style.visibility='visible';                
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
                xmlhttp.open("GET","<?php echo site_url(); ?>users/checkUsername/"+"<?php echo $basic['email'];?>/"+str,true);
                xmlhttp.send();
            }
        </script>

        <!--map scripts-->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
        
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
                <div class="span6">
                    <?php 
                        $this->load->helper('date');
                        echo form_open_multipart('users/edit');
                    ?> 
                    <table>

                        <tr><td><input type="text" name="firstName" placeholder="First Name" value="<?php set_value('firstName', $basic['firstName']);?>">
                             </td><td><input type="text" name="lastName" placeholder="Last Name"value="<?php set_value('lastName', $basic['lastName']);?>">
                            </td></tr>
                        <tr><td><input type="text" value="<?php echo $basic['email'];?>" readonly>
                            </td><td></td></tr>
                        <tr><td><input type ="text" placeholder="username" name="username" value="<?php set_value('username',$basic['username']);?>" onchange="check(this.value)" ></td><td><span id="txtHint"></span><img id="loader" style="visibility:hidden; height: 20px; width: 20px;" src="<?php echo site_url();?>images/loading.gif">
                            </td></tr>
                        <tr><td><select name="gender">
                                    <option value="m" <?php if (isset($basic['gender']) && $basic['gender']=='m') echo "selected='selected'"; ?>>Male</option>
                                    <option value="f" <?php if (isset($basic['gender']) && $basic['gender']=='f') echo "selected='selected'"; ?>>Female</option>
                                </select>
                            </td></tr>
                        <tr><td>Date of birth:</td><td><input type ="text" name="dob" value="<?php set_value('username',$basic['username']);?>">
                            </td></tr>

                        <!--Last seen: <?php if (isset($basic['lastLogin'])) echo $basic['lastLogin'];?><br>-->
                        <tr><td>Upload Photo</td><td><input type="file" name="photo"/>
                            </td></tr>

                        <?php if($this->session->userdata('userType') == 'instructor'){ ?>
                            <a href="<?php echo site_url();?>instructor/bio">Update bio</a><br>
                        <?php }?>

                        <tr><td>Photo</td><td><img width ="80px" src='<?php echo site_url();?>images/profile/<?php echo $basic['photo'];?>'> 
                            </td></tr>
                        <?php if(isset($error)) echo $error;?>
                        <br>

                        <tr><td><input type="submit" value="Update" class="btn btn-success"></td>
                            <td></td></tr>
                    </table>
                    <input type="hidden" name="lat" id="lat" value="">
                    <input type="hidden" name="lng" id="lng" value="">
                        </form>
                    
                </div>
                <div class="span5">
                    <strong>Your Location:</strong>
                    <div id="map_canvas" class="span4"></div>
                </div>
            </div>
        </div>
        <script>
            var map;
            var marker;
            function initialize() {
                var mapOptions = {
                    zoom: 13,
                    center: new google.maps.LatLng(22.60124000, 88.38451599999),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);

                google.maps.event.addListener(map, 'dblclick', function(event) {
                    
                    placeMarker(event.latLng);
                    document.getElementById("lat").value = event.latLng.lat();
                    document.getElementById("lng").value = event.latLng.lng();
                });
            }   
            function placeMarker(location) {

                marker = new google.maps.Marker({
                        position: location,
                        draggable:true,
                        animation: google.maps.Animation.DROP,
                        map: map
                });
                google.maps.event.clearListeners(map, 'dblclick');

                google.maps.event.addListener(marker, 'dragend', function(evt){
                    //alert(evt.latLng);
                    document.getElementById("lat").value = evt.latLng.lat();
                    document.getElementById("lng").value = evt.latLng.lng();
                });
                //map.setCenter(location);
            }


            google.maps.event.addDomListener(window, 'load', initialize);

            $(window).resize(function () {
                var h = $(window).height(),
                    offsetTop = 190; // Calculate the top offset

                $('#map_canvas').css('height', (h - offsetTop));
            }).resize();
        </script>
        <script src="<?php echo site_url();?>assets/js/jquery.js"></script> 
        <script src="<?php echo site_url();?>assets/js/scripts.js"></script> 
    </body>
</html>