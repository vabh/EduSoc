<!doctype HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= site_url();?>assets/css/basic.css" />   
    <style>
    #map_canvas{
        width: 100%;
        height: 500px;
    }
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
            <div class="span12">
                <a href="<?= site_url().'study/'.$courseID;?>">Back to Course</a>
                &nbsp;&nbsp;<a href="#" onclick="place()">Show Course Takers</a>
            </div>
            <div class="span12" id="map_canvas">

            </div>
        </div>
       
    </div>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false">
    </script>

    <script>
        var map;
        var marker;
        
        function initialize() {
            var mapOptions = {
                zoom: 14,
                center: new google.maps.LatLng(22.60124000, 88.38451599999),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
            
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
                
            });
            map.setCenter(location);
        }


        google.maps.event.addDomListener(window, 'load', initialize);

       // placeMarker(new google.maps.LatLng(22.60124000, 88.38451599999));
       </script>
       <script>
       function place(){
     <?php

            if(isset($location))
            {
                foreach ($location as $item) {
                    echo "placeMarker(new google.maps.LatLng('".$item['latitude']."', '".$item['longitude']."'));\n";
                }
            }
        ?>
    }
    </script>
    <script src="<?= site_url();?>assets/js/jquery.js"></script>
    <script src="<?= site_url();?>assets/js/scripts.js"></script>
   
</body>
</html>