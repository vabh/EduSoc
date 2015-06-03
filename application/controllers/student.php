<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Student extends CI_Controller {
    public function index()
    {
        
    }
    public function stats() //AJAX
    {
        echo strrev($this->input->post('test'));
    }
    public function signupCourse($code='')
    {
        if(!$this->session->userdata('userID'))
        {
            redirect(site_url(), 'location');
            return;
        }
        if ($code == '')
        {
            $this->load->model('courses');
            $data['course'] = $this->courses->fetchCourses();
            $this->load->view('student/home', $data);
        }
        else
        {
            $this->load->model('courses');
            $user = $this->session->userdata('userID');
            $this->courses->signupCourse($user, $code);
            $this->continueCourse($code);
        }
    }
    public function courseInfo()// ajax called
    {
        $this->load->model('courses');
        $info = $this->courses->getCourseInfo($this->input->post('code'));
        
        if(!is_null($info))
        {
            echo $info[0]['description'];
        }
    }
    public function continueCourse($code)
    {
        if(!$this->session->userdata('userID'))
        {
            redirect(site_url(), 'location');
            return;
        }
        $this->load->model('courses');
        if($this->courses->checkCourseCode($code))
        {
            echo $code;
            show_404 ();
            return;
        }
        $user = $this->session->userdata('userID');
        $progress = $this->courses->getProgress($code,$user);

        if(empty($progress))
        {
            redirect(site_url()."course/catalog", 'location');
            return;
        }

        $this->load->model('courses');
        $units = $this->courses->fetchUnits($code);
        $chapters = array();
        $pages = array();
        $p_c = 0;
        for($i = 0; $i < count($units); $i++)
        {
            $chapters[$i] = $this->courses->fetchChapters($units[$i]['unitID']);
            
            for($j = 0; $j < count($chapters[$i]); $j++)
            {
                $pages[$i][$j] = $this->courses->fetchPages($chapters[$i][$j]['chapterID']);  
                $p_c += count($pages[$i][$j]);
            }
        }
        $visitedPages = $this->courses->fetchVisitedPages($code);
        $v = array();
        if(isset($visitedPages))
        {
            for($i = 0; $i < count($visitedPages);$i++)
                $v[$i] = $visitedPages[$i]['pageID'];
        }
        
        if($p_c !=0 && $p_c == count($v))
            $this->courses->completed($code, $user);
        
        $cName =  $this->courses->fetchCourseName($code);
        $data = array('units' => $units,
                    'chapters' => $chapters,
                    'pages' => $pages,
                    'courseID' => $code,
                    'progress' => $progress,
                    'visitedPages' => $v,
                    'courseName' => $cName[0]['courseName']
                    );
        //print_r($data);
        $this->load->view('course/s_continue',$data);
    }
    public function viewPage($code)
    {
        $this->load->model('courses');
        if(!$this->session->userdata('userID') || $this->courses->checkCourseCode(substr($code,0,strpos($code,'-',0))))
        {
            redirect(site_url(), 'location');
            return;
        }
        
        $data = $this->courses->fetchPageElements($code);
        if(is_null($data))
        {
            show_404 ();
            return;
        }
        $this->courses->vistedPage($code);
        $this->courses->updateLastPage($this->session->userdata('userID'), $code);
        $pageNav = $this->courses->pageNav($code);
        for($i = 0; $i< count($pageNav);$i++)
        {
            if($code == $pageNav[$i]['pageID'])
            {
                if($i == 0)
                    $prev = site_url ()."study/".substr($code,0,strpos($code,'-',0));
                else
                    $prev = site_url ()."study/page/".$pageNav[$i-1]['pageID'];
                if($i == count($pageNav) - 1)
                    $next = site_url ()."study/".substr($code,0,strpos($code,'-',0));
                else
                    $next = site_url ()."study/page/".$pageNav[$i+1]['pageID'];
            }
        }
        if(isset($prev))
        $data['prev'] = $prev;
        if(isset($next))
        $data['next'] = $next;
        $data['coursecode'] = substr($code,0,strpos($code,'-',0));
        $this->load->view('course/page',$data);
    }
    public function takeTest($code)
    {
        $this->load->model('courses');
        $user = $this->session->userdata('userID');
        if(!$this->session->userdata('userID') || $this->session->userdata('userType')!='student' || $this->courses->checkCourseCode($code) || !$this->courses->checkCourseCompleteion($user, $code) || $this->courses->checkCourseCertification($user, $code))
        {
            redirect(site_url(),'Location');
            return;
        }
        $posted = $this->input->post();
        
        $score = 0;
        $total = 0;
        if(!empty($posted))
        {
            for($i = 0; $i < 10; $i++) //there can be a maximum of ten questions in a test
            {
                $q = "question".$i;
                $a = "answer".$i;
                if(isset($posted[$q]))
                {
                    $total += 1;
                    $qid = $posted[$q];
                    if(isset($posted[$a]))
                    {
                        $score = $score + $this->courses->checkAnswer($qid, $posted[$a]);
                    }
                }
            }

            $per = round(($score/$total)*100);
            if($per > 60)
            {
                $this->courses->certify($user, $code, $per);
                $data['message'] = "Congratulations! You have passed the exam!";
                header("Refresh:2; URL=".site_url());
                $this->load->view('prompt',$data);
                return;
            }
            else
            {
                $data['message'] = "Sorry! You didn't pass the test. Maybe you need to go through the chapters again.";
                header("Refresh:2; URL=".site_url());
                $this->load->view('prompt',$data);
                return;
            }
        }
        else
        {
            $questions = $this->courses->getQuestions($code);
            $data = array();

            for($i = 0; $i < count($questions); $i++)
            {
                $questions[$i]['options'] = explode(',', $questions[$i]['wrongOptions']);
                $questions[$i]['options'][3] = $questions[$i]['correctOption'];
                shuffle($questions[$i]['options']);
                $data['questionbank'][$i]['question'] = $questions[$i]['question'];
                $data['questionbank'][$i]['questionID'] = $questions[$i]['questionID'];
                $data['questionbank'][$i]['options'] = $questions[$i]['options'];
            }

            
            $this->load->view('course/s_examView',$data);
        }
    }
    public function studygroup($code='')
    {
        $this->load->model('accounts');
        $l = $this->accounts->getLocation($code);
        if(!empty($l))
        {
            $data['location'] = $l;
        }
        $data['courseID'] = $code;
        $this->load->view('course/studygroup', $data);
    }
    public function chapterTest(){}
    public function certify(){}
}
