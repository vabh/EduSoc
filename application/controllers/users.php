<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {	
    
    
    public function login()
    {
        if($this->session->userdata('userID'))
        {
            redirect(site_url(), 'location');
            return;
        }
        $this->load->helper('form');
        $posted = $this->input->post(NULL, TRUE);//XSS Filtering
        
        if(strlen($posted['username']) * strlen($posted['password']) == 0)
        {
            $data['message'] = "Fill all fields";
            $this->load->view('main_view', $data);
            return;
        }
        $this->load->model('accounts');
        $result = $this->accounts->login($posted['username'], $posted['password']);
        if(is_null($result))
        {
            $data['message'] = "Incorrect Username/Password";
            $this->load->view('main_view', $data);
            return;
        }
        else
        {
            $data = array(
                    'userID' => $result['userID'],
                    'userType' => $result['userType'],
                    'firstName' => $result['firstName'],
                    'lastName' => $result['lastName'],
                    'instructorStatus' => 'notInstructor'
                    );
            
            if($result['userType'] == 'instructor')
                $data['instructorStatus'] = $this->accounts->checkInstructorStatus($result['userID']);
            
            $this->session->set_userdata($data);
            redirect(site_url(), 'location');
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url(), 'location');
    }
    public function signup()
    {
        if($this->session->userdata('userID'))
        {
            redirect(site_url(), 'location');
            return;
        }
        $this->load->helper('form');
        $posted = $this->input->post(NULL, TRUE);//XSS Filtering
        
        if(empty($posted) )
        {
            $this->load->view('signup');
            return; 
        }
        
        $length = 1;
        foreach($posted as $element)//check for empty fields
            $length *= strlen($element);
        
        $err = "";
            
        if($length != 0)
        {
            if(!filter_var( $posted['email'], FILTER_VALIDATE_EMAIL ))
                $err = "Invalid Email<br>";
            if ($posted['password'] != $posted['pwdCon'])
                $err .= "Passwords have to match<br>";
            elseif (strlen($posted['password']) < 6)
                $err .= "Passwords have to be of at least 6 characters<br>";
            if(!empty($err))
            {
                $data['message'] = $err;
                $this->load->view('signup', $data);
                return;
            }
            
            $t = time().substr(microtime(),2,8);
            $posted['userID'] = $posted['userType'] == 'student' ? 'S'.$t : 'I'.$t;
            
            $this->load->model('accounts');
            $result = $this->accounts->signup($posted);
            
            if(is_null($result))
            {
                $data['message']="Email already exists!";
                $this->load->view('signup', $data);
                return;
            }
            else
            {
                $data = array(
                        'userID' => $result['userID'],
                        'userType' => $result['userType'],
                        'firstName' => $result['firstName'],
                        'lastName' => $result['lastName'],
                        'photo' => $result['photo']
                        );
                $this->session->set_userdata($data);
                redirect(site_url(), 'location');
                return;
            }    
        }
        else
        {
            $data['message'] = "Fill all fields<br>";
            $this->load->view('signup', $data);
            return;
        }
    }
    public function checkUsername($email, $username) //using disallowed character @ through GET
    {
        
        /*if($this->input->is_ajax_request())
        {*/
        $this->load->model('accounts');
        $result = $this->accounts->checkEmailUname($email,$username);

        if ($result != '0')
            echo 'Username Exists';  
        else
            echo 'OK!';
       /* }
        else
            show_404();*/
    }
    public function checkEmail($email='') //AJAX - using disallowed character @ through GET
    {   
        
        /*if($this->input->is_ajax_request())
        {*/
        $this->load->model('accounts');
        $result = $this->accounts->checkEmailUname($email);

        if ($result != '0')
            echo 'Email Exists';  
        else
            echo 'OK!';
       /* }
        else
            show_404();*/
    }
    public function passswordRecover()
    {
        
    }
    public function profile($userID='')
    {
        if(!$this->session->userdata('userID') )
        {
            redirect(site_url(), 'location');
            return;
        }
        
        $this->load->model('accounts');
        
        $urlUserID = $userID;
        
        if($userID != '')
        $userID = $this->accounts->getUserID($userID);
        
        $userID = $userID == '' ? $this->session->userdata('userID') : $userID;
        
        $friends = $this->accounts->getFriends($userID);
        $recentActivity = $this->accounts->recentActivity($userID);
        
        $friendStatus = '0';
        
        if($userID != $this->session->userdata('userID'))
        {
            $friendStatus = $this->accounts->checkFriendStatus($this->session->userdata('userID'),$userID);
            
        }
        else
        {
            unset($friendStatus);
            $awaitingFriendReq = $this->accounts->awaitingFriendReq();
            //print_r($awaitingFriendReq);
        }
        
        $result = $this->accounts->getDetails($userID);
        
        if(is_null($result))
        {
            show_404();
            return;
        }
        if($result['userType'] == 'instructor')
        {
            $bio = $this->accounts->getInstructorBio($result['userID']);
            if(is_null($bio))
            {
                if ($this->session->userdata('userType') != "admin")
                    show_404();
                else
                {
                    $data['basic'] = $result;
                    $this->load->view('profile', $data);
                    return;
                }
                return;
            }
            $bio['filename'] = $userID;
            $data['instructor'] = $bio;
        }
        $data['basic'] = $result;
        if(isset($recentActivity) && !empty($recentActivity))
            $data['recentActivity'] = $recentActivity;
        if(isset($awaitingFriendReq) && !empty($awaitingFriendReq))
            $data['awaitingFriendReq'] = $awaitingFriendReq;
        if(isset($friends) && !empty($friends))
            $data['friends'] = $friends;
        if(isset($friendStatus))
            $data['friendStatus'] = $friendStatus;
        $this->load->view('profile', $data);
    }
    public function delete(){}
    public function edit()
    {
        if(!$this->session->userdata('userID') || $this->session->userdata('userType') == 'admin')
        {
            redirect(site_url(), 'location');
            return;
        }
        $userID = $this->session->userdata('userID');
        
        //process POST data
        $posted = $this->input->post();
        $length = 1;
        $validPost = array();
        if(!empty($posted))
        {
            foreach($posted as $id => $element)//check for empty fields
            {
                $length += strlen($element);
                if(!empty($element))
                {
                    $validPost[$id] = $element;
                }
            }

            $config['upload_path'] = './images/profile';
            $config['allowed_types'] = 'jpg|png';
            $config['file_name'] = $this->session->userdata('userID');
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('photo'))
            {
                //$data = array('message' => $this->upload->display_errors());
                $str = $this->upload->display_errors();
                if (preg_match("/The filetype you are attempting to upload is not allowed./", $str))
                {//file uploaded but filetype not allowed
                    $data['error'] = "File format not supported";
                    $data['basic'] = $result;
                    $this->load->helper('form');
                    $this->load->view('editProfile', $data);
                    return;
                }
            }
            else
            {
                $fileDet = $this->upload->data();
                $validPost['photo'] = $fileDet['file_name'];
            }
            if($length != 0 || isset($validPost['photo']))
            {
                $this->load->model('accounts');
                $this->accounts->updateUsers($validPost, $userID);
                $data['message'] = "Success";
                header("Refresh:2; URL=".site_url()."profile");
                $this->load->view('prompt', $data);
                return;
            }
        }
        
        
        $this->load->model('accounts');
        $result = $this->accounts->getDetails($userID);
        if(is_null($result))
        {
            show_404();//invalid user
            return;
        }
        if($result['userType'] == 'instructor')
        {
            $bio = $this->accounts->getInstructorBio($userID);
            if(is_null($bio))//instructor not approved
            {
                show_404();
                return;
            }
            $bio['filename'] = $userID;
            $data['instructor'] = $bio;
        }
        
        $data['basic'] = $result;
        $this->load->helper('form');
        $this->load->view('editProfile',$data);
    }
    function addFriend($friendID)
    {
        if(!$this->session->userdata('userID'))
        {
            redirect(site_url(), 'location');
            return;
        }
        $this->load->model('accounts');
        $this->accounts->addFriend($this->session->userdata('userID'),$friendID);
        redirect(site_url()."profile/".$friendID, 'location');
    }
    function respondFriendReq($userID,$p)
    {
        
        if(!$this->session->userdata('userID'))
        {
            redirect(site_url(), 'location');
            return;
        }
        $this->load->model('accounts');
        $this->accounts->respondFriendReq($userID,$p);
        
        redirect(site_url(), 'location');
    }
    function updateNotifications() //ajax
    {
        $this->load->model('accounts');
        $this->accounts->updateNotifications();
    }
}