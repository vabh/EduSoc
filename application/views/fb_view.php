
<!doctype HTML>
<html lang="en">
    <head>
        <title>EduSoc - FB</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="This webapp is a social networking site built for education. Right now we are looking for people to sign up to show interest, and we will soon make all its functions public.">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Welcome to EduSoc!">
    	<meta property="og:image" content="http://www.edusoc.in/images/edusocFB.jpg">
    	<meta property="og:description" content="Sign up for Edusoc now! We will soon release EduSoc with all functionalities. Support us by signing up with your email. Your email is safe with us. Join us today and we will inform you when the stage is set!">
    	<meta property="og:url" content="http://edusoc.in">
        
        <link rel="stylesheet" href="http://www.edusoc.in/assets/css/basic.css" />
        <link rel="stylesheet" href="http://www.edusoc.in/assets/css/bootstrap-responsive.css" />
        
       <style>
          body{

            padding-top: 0px; 
            background: #564689; 
            background-attachment: fixed;
            background-size: 100% 100%;
          }
          #main-box{
            margin-top:10%; 
            padding: 5px;
            text-align: center;
            background: #4b4b4d;//#5364A9;
            color: #FFF;
            border-radius: 3px;
            opacity: .8;
          }
            
        </style>
    </head>
    <body>

      <div class="container">
        
        <div class="row">		
        
          <div class="span6 offset3" id="main-box">
            
              <?php if (@$user_profile): ?>
              <pre>   
                <?php echo print_r($user_profile, TRUE) ?>
              </pre>    
              <a href="<?= $logout_url ?>">Logout</a>

              <?php else: ?>    
                <a class="span3" style="heigt:40px;width:180px;padding:6px;background:url('<?= site_url();?>images/fb.png')" href="<?= $login_url ?>"><span style="opacity:0;">Login</span></a>
              <?php endif; ?>

           
          </div>
        </div>
        <div class="row">
          <div style="text-align:center;">
            <img src="http://www.edusoc.in/images/edusoc.png" style="width:20%"/>
          </div>
        </div>
        <div class="row">
          <div style="text-align:center; padding: 5px;">
            <h6 style="color:white">&copy;All rights reserved</h6>
          </div>
        </div>
      </div>

    </div>
        <script src="http://www.edusoc.in/assets/js/jquery.js"></script>
        <script src="http://www.edusoc.in/assets/js/scripts.js"></script>
    </body>
</html>