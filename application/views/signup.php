<!doctype html>
<html>
    <head>
        <title>OLE</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="<?php echo site_url();?>assets/css/basic.css" />
        <script>
            
            window.onload=function()
            {
                document.getElementById("submitButton").style.display='none';
                document.getElementById("JSsubmitButton").style.display='block';
            }
            function checkEmail(str)
            {
                
                document.getElementById('loader').style.display='block';
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if(!re.test(str))
                {
                    $('#loader').css('display', 'none');
                    $('#txtHint').html("Please enter a VALID email");
                    $('#email').parent().parent().addClass('error');
                    if (str.length==0)
                    { 
                        $('#txtHint').html(" ");      
                    }
                }
                else
                {
                    if (str.length == 0)
                    { 
                        $('#txtHint').html("");
                        $('#loader').css('display', 'none');
                        return;
                    }
                    $.post( "<?php echo site_url(); ?>users/checkEmail/"+str, function( data ) {
						/*if(data == 'OK!')
                            $('#email').parent().parent().attr('class', 'control-group success');
                        else
                            $('#email').parent().parent().attr('class', 'control-group error');
                        */
                        $("#txtHint").html( data );
						$('#loader').css('display', 'none');
					});
                }
            }
            function submitForm()
            {
                
                str = document.getElementById('email').value;
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if(!re.test(str)){                
                    //Check For Spaces
                    document.getElementById("message").style="display: block";
                    document.getElementById("message").innerHTML="Check your email id";
                    return;
                }
                else
                {
                    var str = document.getElementById('email').value.length;
                    var str1 = document.getElementById('firstName').value.length;
                    var str2 = document.getElementById('lastName').value.length;
                    var str3 = document.getElementById('password').value.length;
                    var str4 = document.getElementById('pwdCon').value.length;
                    var ch = str*str1*str2*str3*str4;
                           //alert(ch)
                    
                    if (ch==0)
                    { 
                        document.getElementById("message").style="display: block";
                        document.getElementById("message").innerHTML="Please fill all fields!";
                        return;
                    }
                    else if (document.getElementById('pwdCon').value != document.getElementById('password').value)
                    {
                        document.getElementById("message").style="display: block";
                        document.getElementById('message').innerHTML = "Passwords do not match";
                        return;
                    }
                    else if (document.getElementById('pwdCon').value.length < 6)
                    {
                        document.getElementById("message").style="display: block";
                        document.getElementById('message').innerHTML = "Password has to be of atleast 6 characters";
                        return;
                    }
                    else
                        document.forms['myform'].submit();
                }
                
            }
        </script>
    </head>
    <body>
        <div class="container">
        
            <div class="row well">
                <span id="message" class="alert" style="display: none;">
                <?php
                if(isset($message))
                    echo $message;
                echo "</span>";

                $attributes = array('id' => 'myform');
                echo form_open('',$attributes);
                ?>

                <h1>Enter Details To Create Account</h1>

                <ul class="nav nav-tabs" id="userTypeTab">
                  <li><a href="#" data-toggle="tab" id="student">Student</a></li>
                  <li><a href="#" data-toggle="tab" id="instructor">Instructor</a></li>
                </ul>

                 <!--<select name="userType">
                    <option value="student">Student</option>
                    <option value="instructor">Instructor</option>
                </select><br>-->

                <div class="control-group">
                  <div class="controls">
                        <input placeholder="First Name" type="text" name="firstName" id="firstName" value="<?php echo set_value('firstName'); ?>">
                    <span class="help-inline"></span>
                  </div>
                </div>

                <div class="control-group">
                  <div class="controls">
                    <input placeholder="Last Name" type="text" name="lastName" id="lastName" value="<?php echo set_value('lastName'); ?>">
                    <span class="help-inline"></span>
                  </div>
                </div>
                
                <div class="control-group">
                  <div class="controls">
                    <input placeholder="Email" type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" onchange="checkEmail(this.value)">
                    <span class="help-inline" id="txtHint"><img id="loader" style="display: none; height: 20px; width: 20px;" src="<?php echo site_url();?>images/loading.gif"></span>
                  </div>
                </div>

                <div class="control-group">
                  <div class="controls">
                    <input placeholder="Password" type="password" name="password" id="password">
                    <span class="help-inline"></span>
                  </div>
                </div>

                <div class="control-group">
                  <div class="controls">
                    <input placeholder="Confirm Password" type="password" name="pwdCon" id="pwdCon">
                    <span class="help-inline"></span>
                  </div>
                </div>
                
                <input type="hidden" name="userType" id="userType" value="" >
                <input type='button' value='Create Account' id="JSsubmitButton" onClick="submitForm();" style="display:none" class='btn btn-large btn-success'>
                <input type="submit" value="Create Account" id="submitButton" class="btn btn-large btn-success">
                </form>
            </div>
            <div class="row" align="left">
                <a href="<?php echo site_url();?>">Home</a>
            </div>
        </div>
        <script src="<?php echo site_url();?>assets/js/jquery.js"></script>
        <script src="<?php echo site_url();?>assets/js/scripts.js"></script>
        <script type="text/javascript">
            $('#userTypeTab a').click(function (e) {
                $('#userType').val($(this).attr('id'));
            });
        </script>>
    </body>
</html>