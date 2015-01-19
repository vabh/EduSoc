<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends CI_Controller {
    public function index()
    {
        

        if($this->session->userdata('userID'))
        {
            $userType = $this->session->userdata('userType');
            $this->load->model('courses');
            $this->load->model('accounts');
            switch ($userType){
                case "student":
                    $data['studying'] = $this->courses->studyingCourses($this->session->userdata('userID'));
                    $awaitingFriendReq = $this->accounts->awaitingFriendReq();
                    if(isset($awaitingFriendReq) && !empty($awaitingFriendReq))
                        $data['awaitingFriendReq'] = $awaitingFriendReq;
                    $data['notifications']['student'] = $this->accounts->getNotifications();
                    $data['notifications']['instructor'] = $this->accounts->getInstructorNotifications();
                    $this->load->view('student/home',$data);
                    
                    break;
                case "instructor":
                    $data['instructorStatus'] = $this->accounts->checkInstructorStatus($this->session->userdata('userID'));
                    $this->session->set_userdata($data);
                    $awaitingFriendReq = $this->accounts->awaitingFriendReq();
                    if(isset($awaitingFriendReq) && !empty($awaitingFriendReq))
                        $data['awaitingFriendReq'] = $awaitingFriendReq;
                    
                    $data['instructing'] = $this->courses->instructingCourses($this->session->userdata('userID'));
                    $data['notifications']['student'] = $this->accounts->getNotifications();
                    $data['notifications']['instructor'] = $this->accounts->getInstructorNotifications();
                    $this->load->view('instructor/home',$data);
                    break;
                case "admin":
                    $this->load->view('admin/home');
                    break;
            }
        }
        else
        {
            $this->load->helper('form');
            $this->load->view('main_view');
        }
    }

    /******ALT******/
    public function altEntry()
    {
        $email = $this->input->post('email');
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->load->model('accounts');
            $this->accounts->keepMail($email);
        }
        header( "refresh:5; url=".site_url()."" ); 
        $this->load->view('alt_main_f');

    }
    
    /*******ALT END******/
    public function courseProfile($code)
    {
        $this->load->model('courses');
        if($this->courses->checkCourseCode($code))
        {
            //echo $code;
            show_404 ();
            return;
        }
        $user = $this->session->userdata('userID');
        $courseName = $this->courses->fetchCourseName($code);
        $this->load->model('courses');
        $units = $this->courses->fetchUnits($code);
        $chapters = array();
        $pages = array();
        
        for($i = 0; $i < count($units); $i++)
        {
            $chapters[$i] = $this->courses->fetchChapters($units[$i]['unitID']);
            
            for($j = 0; $j < count($chapters[$i]); $j++)
            {
                $pages[$i][$j] = $this->courses->fetchPages($chapters[$i][$j]['chapterID']);  
        
            }
        }
        $coursetakers = $this->courses->courseTakers($code);
        $signed = 0;
        for($i=0; $i<count($coursetakers); $i++)
            if($coursetakers[$i]['userID'] == $user)
            {
                $signed = 1;
                $progress = $this->courses->getProgress($code,$user);
                break;
            }
        
        $data = array('courseName' => $courseName[0]['courseName'],
                        'description' => $courseName[0]['description'],
                        'units' => $units,
                        'chapters' => $chapters,
                        'pages' => $pages,
                        'courseID' => $code,
                        'coursetakers' => $coursetakers,
                        'signed' => $signed
                        
                        );
        if(isset($progress))
            $data['progress'] = $progress;
        $this->load->view('course/course_profile',$data);
    }
}
