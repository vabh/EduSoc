<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Instructor extends CI_Controller {
    public function index()
    {
        
    }
    public function bio()
    {
        if(!$this->session->userdata('userID') || $this->session->userdata('userType')!='instructor')
        {
            redirect(site_url(),'Location');
            return;
        }
        
        $this->load->helper(array('form'));
        $posted = $this->input->post(NULL,true);
        
        if(empty($posted) )
        {
            $this->load->view('instructor/bio');
            return; 
        }
        
        $length = 1;
        foreach($posted as $element)//check for empty fields
            $length *= strlen($element);
        
       $data['message'] = '';
            
        if($length != 0)
        {
            $config['upload_path'] = './data/instructor/cv';
            $config['allowed_types'] = 'pdf';
            $config['file_name'] = $this->session->userdata('userID');
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('cv'))
            {
                $data = array('message' => $this->upload->display_errors());
                $this->load->view('instructor/bio', $data);
            }
            else
            {
                $fileDet = $this->upload->data();
                $this->load->model('accounts');
                $posted['file_name'] = $fileDet['file_name'];
                
                $result = $this->accounts->storeBio($posted);
                $data['message'] = "Success";
                if($result == 0)
                    $data['message'] = "Not Allowed!";
                
                header("Refresh:2; URL=".site_url());
                $this->load->view('prompt', $data);
                return;
            }
        }
        else
            $this->load->view('instructor/bio',$data);
    }
    public function viewBio($userID='')
    {
        $this->load->model('accounts');
        $u = $this->accounts->checkUserID($userID);
        if($userID == '' || $u == '0')
        {
            show_404();
            return;
        }
        $data['filename'] = $u.".pdf";
        $this->load->view('instructor/displayBio', $data);
    }
    public function stats(){}
    public function createCourse()
    {   
        if(!$this->session->userdata('userID') || $this->session->userdata('userType') != 'instructor' || $this->session->userdata('instructorStatus') != 'approved')
        {   
            redirect(site_url(), 'location');
            return;
        }
        $this->load->helper('form');
        $this->load->model('courses');
        
        $data['subjects'] = $this->courses->fetchSubjects();
        $data['streams'] = $this->courses->fetchStreams();
        
        $posted = $this->input->post();
       
        if(!empty($posted) )
        {
            $length = 1;
            foreach($posted as $element)//check for empty fields
                $length *= strlen($element);

            $err = "";
            if($length != 0)
            {
                $this->load->model('courses');
                $posted['code'] = str_replace(' ', '', $posted['code']);//removing spaces
                $result = $this->courses->checkCourseCode($posted['code']);
                if($result == false)
                {
                    $err .= 'Code exists<br>';   
                }
                
                else
                {
                    $this->courses->create($posted);
                    redirect(site_url().'course/continue/'.$posted['code'], 'location');
                    return;   
                }
            }
            else
            {
                $err .= "Fill all fields";
            }
            if($err != "")
            {
                $data['message'] = $err;
                $this->load->view('instructor/createCourse', $data);
                return;
            }
        }
        $this->load->view('instructor/createCourse', $data); 
    }
    public function checkCodeExists($code) // AJAX
    {
        $this->load->model('courses');
        if($this->courses->checkCourseCode($code) == true)
            echo "Code Available!";
        else
            echo "Code Unavailable. Please try another code.";
    }
    public function viewCourseStats(){}
    public function createdCourses(){}
    /**     
     * Fetch units, chapters and pages of course.
     * Load view with options to create new units,
     * chapters, pages or edit them.
     */
    public function continueCourseCreation($code)
    {
        $this->load->model('courses');
        if(!$this->session->userdata('userID') || $this->session->userdata('userType')!='instructor' || $this->courses->checkCourseCode($code))
        {
            redirect(site_url(),'Location');
            return;
        }
        
        $result = $this->courses->checkOwner($code);
        if ($result == $this->session->userdata('userID'))
        {
            $units = $this->courses->fetchUnits($code);
            $chapters = array();
            $pages = array();
            for($i = 0; $i < count($units); $i++)
            {
                $chapters[$i] = $this->courses->fetchChapters($units[$i]['unitID']);

                for($j = 0; $j < count($chapters[$i]); $j++)
                    $pages[$i][$j] = $this->courses->fetchPages($chapters[$i][$j]['chapterID']);  
            }
            $courseInfo = $this->courses->getCourseInfo($code);
            $data = array('units' => $units,
                        'chapters' => $chapters,
                        'pages' => $pages,
                        'courseID' => $code,
                        'courseInfo' => $courseInfo[0]);
            $this->load->helper('form');
            $this->load->view('course/continue', $data);
        }
        else 
        {
            redirect(site_url(), 'location');
        }
    }
    /**
    * create unit based on course code $c
    */
    public function newUnit($c) //AJAX
    {
        if($this->input->post('unitName') && $this->input->post('description'))
        {
            $this->load->model('courses');
            $this->courses->createUnit($c,$this->input->post('unitName'), $this->input->post('description'));
            redirect(site_url().'course/continue/'.$c, 'location');
        }
        else 
        {
            $this->load->helper('form');
            $data = array('courseID' => $c, 'unitError' => 1);
            $this->load->view('course/newUnit', $data);
        }
    }
    /**
    *create chapter of unit $u
    */
    public function newChapter($u)
    {
        if($this->input->post('chapterName') && $this->input->post('description'))
        {
            $this->load->model('courses');//insert into db and load continue page
            $this->courses->createChapter($u,$this->input->post('chapterName'), $this->input->post('description'));
            redirect(site_url().'course/continue/'.substr($u,0,strpos($u,'-',0)), 'location');
        }
        else 
        {
            $this->load->helper('form');
            $data = array('u' => $u);
            $this->load->view('course/newChapter', $data);
        }
    }
    
    public function newPage($c)
    {
        $this->load->model('courses');
        if(!$this->session->userdata('userID') || $this->session->userdata('userType')!='instructor' || $this->courses->checkCourseCode(substr($c,0,strpos($c,'-',0))))
        {
            redirect(site_url(),'Location');
            return;
        }
        
        $result = $this->courses->checkOwner(substr($c,0,strpos($c,'-',0)));
        if ($result == $this->session->userdata('userID'))
        {
            $posted = $this->input->post();

            if(!empty($posted))
            {
                $data = array();

                $video = $_FILES['video']['tmp_name'] == NULL ? 0 : 1;
                $image = $_FILES['image']['tmp_name'] == NULL ? 0 : 1;

                $this->load->library('upload');
                $id = $this->courses->createPage($c, $posted['heading'], $posted['text'], $video, $image);
                if($video == 1)//upload start for video
                {
                    $config['upload_path'] = './coursedata/video';
                    $config['allowed_types'] = 'mp4';
                    $config['file_name'] = $id;
                    $config['max_size'] = 0;
                    $config['overwrite'] = TRUE;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload('video'))
                    {
                        $str = $this->upload->display_errors();
                        if (preg_match("/The filetype you are attempting to upload is not allowed./", $str))
                            echo "File format not supported";
                            //$data['error'] = "File format not supported";
                    }
                    else
                        $fileDet = $this->upload->data();
                    unset($config);
                }//upload end for video
                if($image == 1)//upload start for image
                {
                    $config['upload_path'] = './coursedata/image';
                    $config['allowed_types'] = 'jpg|png';
                    $config['file_name'] = $id;
                    $config['overwrite'] = TRUE;

                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload('image'))
                    {
                        $str = $this->upload->display_errors();
                        if (preg_match("/The filetype you are attempting to upload is not allowed./", $str))
                            $data['error'] = "File format not supported";
                    }
                    else
                        $fileDet = $this->upload->data();
                }//upload end for image


                redirect(site_url()."course/continue/".substr($c,0,strpos($c,'-',0)), 'location');
            }
            else
            {
                $data['chapterID'] = $c;
                $this->load->helper('form');
                $this->load->view('course/newPage', $data);    
            }
        }
        else
        {
            redirect(site_url(),'Location');
        }
    }
    public function displayPage($code)
    {
        if(!$this->session->userdata('userID') || $this->session->userdata('userType')!='instructor')
        {
            redirect(site_url(),'Location');
            return;
        }
        $this->load->model('courses');
        $data = $this->courses->fetchPageElements($code);
        $pageNav = $this->courses->pageNav($code);
        for($i = 0; $i< count($pageNav);$i++)
        {
            if($code == $pageNav[$i]['pageID'])
            {
                if($i == 0)
                    $prev = site_url ()."course/continue/".substr($code,0,strpos($code,'-',0));
                else
                    $prev = site_url ()."course/view/".$pageNav[$i-1]['pageID'];
                if($i == count($pageNav) - 1)
                    $next = site_url ()."course/continue/".substr($code,0,strpos($code,'-',0));
                else
                    $next = site_url ()."course/view/".$pageNav[$i+1]['pageID'];
            }
        }
        $data['prev'] = $prev;
        $data['next'] = $next;
        $data['coursecode'] = substr($code,0,strpos($code,'-',0));
        $this->load->view('course/page',$data);
    }
    public function createExam($code='')
    {
        $this->load->model('courses');
        if(!$this->session->userdata('userID') || $this->session->userdata('userType')!='instructor' || ($code != '' && ($this->courses->checkCourseCode($code) || $this->courses->checkOwner($code) != $this->session->userdata('userID'))))
        {
            redirect(site_url(),'Location');
            return;
        }
        $posted = $this->input->post();
        if(!empty($posted))
        {
            $this->courses->addQuestion($posted);
            redirect(site_url().'course/exam/'.$code,'Location');
            return;
        }
        else
        {
            $data['course'] = $code;
            $data['instructing'] = $this->courses->instructingCourses($this->session->userdata('userID'));
            $this->load->view('course/createExam', $data);
        }
    }
    public function editCourse(){}   
    public function openCourse($code)
    {
        $this->load->model('courses');
        $this->courses->open($code);
        redirect(site_url().'course/continue/'.$code,'Location');
    }
    
}