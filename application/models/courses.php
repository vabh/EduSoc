<?php
class Courses extends CI_Model{    
    function fetchSubjects()
    {
        $sql = "SELECT name, subjectID, stream FROM subjects";
        $sub = $this->db->query($sql);
        
        return $sub->result_array();
    }
    function fetchStreams()
    {
        $sql = "SELECT DISTINCT stream FROM subjects";
        $stream = $this->db->query($sql);
        $r = $stream->result_array();
        $i = 0;
        foreach ($r as $e)
        {
            $x[$i] = $e['stream'];
            $i = $i+1;
        }
        return $x;
    }
    function fetchCourses()
    {
        $sql = "SELECT courses.courseID, courseName, popularity, firstName, lastName, userID, username, subjects.name".
               " FROM courses INNER JOIN users INNER JOIN subjects". 
               " WHERE courses.status=1 AND courses.subject=subjects.subjectID AND instructorID=userID";
        $result = $this->db->query($sql);
        
        
        
        $courses = $result->result_array();
        
        $sql = "SELECT courseID FROM studentcoursestats WHERE userID=".$this->db->escape($this->session->userdata('userID'));
        $result = $this->db->query($sql);
        $result = $result->result_array();
        $r = array();
        for($i = 0; $i < count($result); $i++)
        {
            $r[$i] = $result[$i]['courseID'];
        }
        
        for ($i=0; $i < count($courses); $i++)
        {
            if (in_array($courses[$i]['courseID'], $r))
                    $courses[$i]['signup'] = 1;
            else
                $courses[$i]['signup'] = 0;
        }
        $this->updatePopularity();
        return $courses;
    }
    function updatePopularity()
    {
        //total no of students:
        $sql = "SELECT count(userID) as total FROM users WHERE userType='student'";
        $total = $this->db->query($sql);
        $total = $total->result_array();
        
        $sql = "select courseID, count(*) as num from studentcoursestats group by courseID";
        $num = $this->db->query($sql);
        $num = $num->result_array();
        
        $sql = "UPDATE courses "
                ."SET popularity = CASE";
       
        for($i = 0; $i < count($num); $i++)
            $sql .= " WHEN courseID = ".$this->db->escape($num[$i]['courseID'])." THEN ".$this->db->escape(10 *$num[$i]['num']/($total[0]['total']));
        
        
        $this->db->query($sql." END");
        
    }
    function getCourseInfo($c)
    {
        $sql = "SELECT description, courseName, status FROM courses WHERE courseID=".$this->db->escape($c);
        $result = $this->db->query($sql);
        //add fetch instrcutor info
        if($result->num_rows() > 0)
        {   
            return $result->result_array();}
        else return NULL;
    }
    function checkCourseCode($c)
    {
        $sql = "SELECT code FROM courses WHERE code=".$this->db->escape($c);
        $result = $this->db->query($sql);
        if($result->num_rows() == 0)
            return true;
        else 
            return false;
    }
    function create($data)
    {
        $id = $this->db->escape($data['code']);
        $x = $this->db->escape($this->session->userdata('userID')).', '.$this->db->escape($data['courseName']).', '.$this->db->escape($data['code']).', '.$this->db->escape($data['subject']).', '.$this->db->escape($data['tags']).', '.$this->db->escape($data['description']).', '.$this->db->escape('0');
        $sql = "INSERT into courses(courseID,instructorID,courseName,code,subject,tags,description,status,dateOfCreation) values(".$id.', '.$x.", ".$this->db->escape(date('Y-m-d')).")";
        $this->db->query($sql);
        
        /*
        $x = $id.', '.$this->db->escape($this->session->userdata('userID'));
        $sql = "INSERT into instructor(courseID, userID) values(".$x.")";
        $this->db->query($sql);
         */
    }
    function fetchUnits($code)
    {
        $sql = "SELECT unitID, unitName FROM units WHERE status='1' AND courseID=".$this->db->escape($code);
        $query = $this->db->query($sql);
        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return NULL;
    }
    function fetchChapters($unit)
    {
        $sql = "SELECT chapterID, chapterName FROM chapters WHERE status='1' AND unitID=".$this->db->escape($unit);
        $query = $this->db->query($sql);
        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return NULL;
    }
    function fetchPages($chapters)
    {
        $sql = "SELECT heading, pageID FROM pages WHERE chapterID=".$this->db->escape($chapters)." ORDER BY pageID";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return NULL;
    }
    function countUnits($c)
    {
        $sql = "SELECT count(unitID) as num FROM units WHERE courseID=".$this->db->escape($c);
        $query = $this->db->query($sql);
        $n = $query->result_array();
        return $n[0]['num'];
    }
    function createUnit($code,$name,$desc)
    {
        $numUnits = $this->countUnits($code);

        $id = $code."-U".($numUnits+1);
        $t = $this->db->escape($code).','.$this->db->escape($id).','.$this->db->escape($name).','.$this->db->escape($desc).','.$this->db->escape('1');
        $sql = "INSERT INTO units(courseID,unitID,unitName,description,status) VALUES (".$t.")";
        $this->db->query($sql);
    }
    function countChapters($u)
    {
        $sql = "SELECT count(chapterID) as num FROM chapters WHERE unitID=".$this->db->escape($u);
        $query = $this->db->query($sql);
        $n = $query->result_array();
        return $n[0]['num'];
    }
    function createChapter($unit,$name,$desc)
    {
        $numChap = $this->countChapters($unit);

        $id = $unit."-C".($numChap+1);
        $t = $this->db->escape($unit).','.$this->db->escape($id).','.$this->db->escape($name).','.$this->db->escape($desc).','.$this->db->escape('1');
        $sql = "INSERT INTO chapters (unitID,chapterID,chapterName,description,status) VALUES (".$t.")";
        
        
        $this->db->query($sql);
    }
    function countPages($u)
    {
        $sql = "SELECT count(pageID) as num FROM pages WHERE chapterID=".$this->db->escape($u);
        $query = $this->db->query($sql);
        $n = $query->result_array();
        return $n[0]['num'];
    }
    function createPage($chap,$head,$text, $v, $i)
    {
        $numChap = $this->countPages($chap);

        $id = $chap."-P".($numChap+1);
        $v = $v == 1 ? $this->db->escape($id.".mp4") : 'NULL';
        $i = $i == 1 ? $this->db->escape($id.".jpg") : 'NULL';
        $t = $this->db->escape($chap).','.$this->db->escape($id).','.$this->db->escape($head).','.$this->db->escape($text).','.$this->db->escape('1').','.$v.','.$i;
        $sql = "INSERT INTO pages (chapterID,pageID,heading,text,visibility, video, image) VALUES (".$t.")";
           
        $this->db->query($sql);
        return $id;
    }
    function fetchPageElements($p)
    {
        $sql = "SELECT * FROM pages WHERE pageID=".$this->db->escape($p);
        $result = $this->db->query($sql);
        $r = $result->result_array();
        if($result->num_rows() == 0)
            return NULL;
        else return $r[0];
    }
    function signupCourse($user, $code)
    {
        $sql = "INSERT INTO studentcoursestats (userID, courseID, startDate) values(".$this->db->escape($user).",".$this->db->escape($code).",".$this->db->escape(date('Y-m-d')).") ";
        $this->db->query($sql);
        $sql = "INSERT INTO studentprogress (userID, courseID, lastPage,certified) values(".$this->db->escape($user).",".$this->db->escape($code).",'0','0'".")";
        $this->db->query($sql);
    }
    function getProgress($code, $user)
    {
        $sql = "SELECT * FROM studentprogress NATURAL JOIN studentcoursestats WHERE userID=".$this->db->escape($user)." AND courseID=".$this->db->escape($code);
        $query = $this->db->query($sql);
        $result = $query->result_array();
        //print_r($result);
        return $result[0];
    }
    function updateLastPage($u, $p)
    {
        $c = substr($p,0,strpos($p,'-',0));
        $sql = "UPDATE studentprogress SET lastPage = ".$this->db->escape($p)." WHERE userID = ".$this->db->escape($u)." AND courseID=".$this->db->escape($c);
        $this->db->query($sql);
    }
    function pageNav($p)
    {
        $sql = "SELECT pageID " 
                ."FROM chapters "
                ."INNER JOIN pages INNER JOIN units "
                ."WHERE pages.chapterID = chapters.chapterID AND units.unitID = chapters.unitID AND courseID=".$this->db->escape(substr($p,0,strpos($p,'-',0)))." order by units.unitID, chapters.chapterID, pageID";
        $result = $this->db->query($sql);
        return $result->result_array();
    }
    function checkOwner($c)
    {
        $sql = "SELECT instructorID from courses WHERE courseID = ".$this->db->escape($c);
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result[0]['instructorID'];
    }
    function studyingCourses($userID)
    {
        $sql = "SELECT courseID, courseName FROM studentcoursestats natural join courses WHERE userID=".$this->db->escape($userID);
        $result = $this->db->query($sql);
        return $result->result_array();
    }
    function instructingCourses($userID)
    {
        $sql = "SELECT courseID, courseName FROM courses WHERE instructorID=".$this->db->escape($userID);
        $result = $this->db->query($sql);
        return $result->result_array();
    }
    function vistedPage($p)
    {
        $sql = "SELECT userID FROM visitedpages WHERE userID=".$this->db->escape($this->session->userdata('userID'))." AND pageID=".$this->db->escape($p);
        $result = $this->db->query($sql);
        
        if($result->num_rows == 0 )
        {
            $sql = "INSERT INTO visitedpages values(".$this->db->escape($this->session->userdata('userID')).", ".$this->db->escape($p).")";
            $this->db->query($sql);
			
        }
    }
    function fetchVisitedPages($c)
    {
        $sql = "SELECT pageID from visitedpages WHERE userID=".$this->db->escape($this->session->userdata('userID'))." AND pageID LIKE ".$this->db->escape($c."%");
        
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }
    function addQuestion($post)
    {
        $sql = "SELECT count(questionID) as num FROM questionbank WHERE courseID=".$this->db->escape($post['course']);
        $result = $this->db->query($sql);
        $result = $result->result_array();
        $qid = $post['course'].'-Q'.($result[0]['num']+1);
        $t = $this->db->escape($qid).", ".$this->db->escape($post['course']).", ".$this->db->escape($post['question']).", ".$this->db->escape($post['wOption1'].','.$post['wOption2'].','.$post['wOption3']).", ".$this->db->escape($post['cOption']).', '.$this->db->escape('1').', '.$this->db->escape($post['difficulty']).', '.$this->db->escape('0').', '.$this->db->escape('0');
        $sql = "INSERT INTO questionbank values(".$t.")";
        $this->db->query($sql);
    }
    function completed($c, $u)
    {
        $sql = "UPDATE studentprogress SET completed='1' WHERE userID=".$this->db->escape($u)."AND courseID=".$this->db->escape($c);
        $this->db->query($sql);
    }
    function getQuestions($c)
    {
        $sql = "SELECT questionID, question, correctOption, wrongOptions FROM questionbank WHERE status = '1' AND courseID = ".$this->db->escape($c)." ORDER BY RAND() LIMIT 0, 10";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }
    function checkAnswer($questionID, $ans)
    {
        $sql = "SELECT correctOption FROM questionbank WHERE correctOption = ".$this->db->escape($ans)." AND questionID=".$this->db->escape($questionID);
        $result = $this->db->query($sql);
        $r = $result->num_rows();
        $sql = "UPDATE questionbank SET attempts=attempts + 1, correctAttempts=correctAttempts + ".$r." WHERE questionID=".$this->db->escape($questionID);
        $this->db->query($sql);
        return $r;
    }
    function checkCourseCompleteion($u, $c)
    {
        $sql = "SELECT completed FROM studentprogress WHERE userID=".$this->db->escape($u)." AND courseID=".$this->db->escape($c);
        $result = $this->db->query($sql);
        $result = $result->result_array();
        if($result[0]['completed'] == 0)
            return false;
        else
            return true;
    }
    function checkCourseCertification($u, $c)
    {
        $sql = "SELECT certified FROM studentprogress WHERE userID=".$this->db->escape($u)." AND courseID=".$this->db->escape($c);
        $result = $this->db->query($sql);
        $result = $result->result_array();
        if($result[0]['certified'] == 0)
            return false;
        else
            return true;
    }
    function certify($user, $course, $percent)
    {
        $sql = "UPDATE studentprogress SET certified = 1 WHERE userID=".$this->db->escape($user)." AND courseID=".$this->db->escape($course);
        $this->db->query($sql);
        $sql = "UPDATE studentcoursestats SET endDate = ".$this->db->escape(date('Y-m-d H:i:s', time())).", percentage = ".$this->db->escape($percent)." WHERE userID=".$this->db->escape($user)." AND courseID=".$this->db->escape($course);
        $this->db->query($sql);
    }
    function courseTakers($code)
    {
        $sql = "SELECT firstName, lastName, userID, photo FROM users NATURAL JOIN studentcoursestats WHERE courseID=".$this->db->escape($code);
        $result = $this->db->query($sql);
        return $result->result_array();
    }
    function fetchCourseName($cid)
    {
        $sql = "SELECT courseName, description FROM courses WHERE courseID=".$this->db->escape($cid);
        $result = $this->db->query($sql);
        return $result->result_array();
        
    }
    function open($cid)
    {
        $sql = "UPDATE courses SET status='1' WHERE courseID=".$this->db->escape($cid);
        $this->db->query($sql);
    }
}