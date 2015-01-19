<?php
class Accounts  extends CI_Model{

    
    function login($u, $p)
    {
        $p = $this->encrypt->sha1($p);
        if(filter_var( $u, FILTER_VALIDATE_EMAIL ))
            $q = "email=".$this->db->escape($u);
        else
            $q = "username=".$this->db->escape($u);
        
        $this->load->helper('date');
        $sql = "SELECT * FROM users WHERE ".$q;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        
        if(!empty($result))
        {
            if($p == $result[0]['password'] && $result[0]['status'] == 1)
            {
                //echo unix_to_human(time(), TRUE, 'us');
                //return;
                $sql = "UPDATE users SET lastLogin=".$this->db->escape(date('Y-m-d H:i:s', time()))." WHERE ".$q;//$this->db->escape(date('Y-m-d H:i:s', time()))
                //display the local time to user not GMT as in db ;)
                
                $query = $this->db->query($sql);
                return $result[0];
            }
            else
                return NULL;
        }
        else
            return NULL;
    }
    function signup($data)
    {
        $check = $this->checkEmailUname($data['email']);
        
        if($check != '0')
            return NULL;
        
        $p = $this->db->escape($data['userID']).','.$this->db->escape($data['userType']).','.$this->db->escape($data['email']).','.$this->db->escape($this->encrypt->sha1($data['password'])).','.$this->db->escape($data['firstName']).','.$this->db->escape($data['lastName']).', '.$this->db->escape(date('Y-m-d'));
        
        $sql = "INSERT INTO users (userID,userType,email,password,firstName,lastName,lastUpdate,photo,status) values (".$p.",'default.jpg',1)";
        //echo $sql;
        $this->db->query($sql);
        
        return $this->login($data['email'], $data['password']);
    }
    function checkUserID($u='')
    {
        $sql = "SELECT userID FROM users WHERE userID=".$this->db->escape($u)." OR username=".$this->db->escape($u);
        
        $query = $this->db->query($sql);
        
        if($query->num_rows() == 0)
            return '0';
        else 
            return $query->row()->userID;
    }
    function checkEmailUname($e, $u = '')
    {
        $u = $u != '' ? ' AND username='.$this->db->escape($u) : '';
        $sql = "SELECT userID FROM users WHERE email=".$this->db->escape($e).$u;
        
        $query = $this->db->query($sql);
        
        if($query->num_rows() == 0)
            return '0';
        else 
            return $query->row()->userID;
    }
    function getDetails($userID)
    {
        $sql = "SELECT username, userID, userType, email, firstName, lastName, gender, dob, status, photo, lastLogin from users WHERE UserID=".$this->db->escape($userID). " OR username=".$this->db->escape($userID);
        $query = $this->db->query($sql);
        if($query->num_rows() == 0 || $query->row()->status == 0)
            return NULL;
        else
        {
            $result = $query->result_array(); 
            return $result[0];
        }
        
    }
    function updateUsers($data, $uid)
    {
        $str = "";
        
        foreach ($data as $id => $elem)
        {
            if($id == "lat" )
                $latitude = $elem;
                
            elseif($id == "lng")
                $longitude = $elem;
            else
                $str .= $id." = ".$this->db->escape($elem).",";
        }
        $str = rtrim($str,",");

        $sql = "UPDATE users SET ".$str." WHERE userID=".$this->db->escape($uid);
        $this->db->query($sql);
        
        if(isset($latitude) && isset($longitude))
        {
            $sql = "SELECT * FROM location WHERE userID=".$this->db->escape($uid);
            $result = $this->db->query($sql);
            if($result->num_rows() > 0)
            {
                $sql = "DELETE FROM location WHERE userID=".$this->db->escape($uid);
                $result = $this->db->query($sql);
            }

            $val = $this->db->escape($uid).", ".$this->db->escape($latitude).", ".$this->db->escape($longitude);  
            $sql = "INSERT INTO location(`userID` ,`latitude` ,`longitude`)VALUES (".$val.")";
            $this->db->query($sql);
        }
    }
    function getInstructorBio($userID)
    {
        $sql = "SELECT organization, position, des, cv, demand, status FROM instructorbio WHERE userID=".$this->db->escape($userID);
        $query = $this->db->query($sql);
        if($query->num_rows() == 0 || $query->row()->status != 'approved')
            return NULL;
        else
        {
            $result = $query->result_array(); 
            return $result[0];
        }
    }
    function storeBio($data)
    {
        $u = $this->db->escape($this->session->userdata('userID'));
        $sql = "SELECT status FROM instructorbio WHERE userID = ".$u;
        
        $query = $this->db->query($sql);
        if($query->num_rows() == 0)
        {
            $p = $this->db->escape($data['organization']).','.$this->db->escape($data['position']).','.$this->db->escape($data['desc']).','.$this->db->escape('submitted').','.$this->db->escape($data['file_name']);
            $sql = "INSERT INTO instructorbio(userID, organization, position, des, status, cv) VALUES (".$u.",".$p.")";
            
            $this->db->query($sql);
            return 1;
        }
        else
        {
            
            switch ($query->row()->status)
            {                
                case 'approved': $s = 'approved'; break;
                case 'submitted':
                case 'rejected': $s = 'submitted';break;
                default: return 0;
            }
            
            $sql = "UPDATE instructorbio SET organization = ".$this->db->escape($data['organization']).", 
                    position = ".$this->db->escape($data['position']).
                    ",des = ".$this->db->escape($data['desc']).
                    ",cv = ".$this->db->escape($data['file_name']).
                    ",status = ".$this->db->escape($s).
                    " WHERE userID=".$u;
            $this->db->query($sql);
            return 1;
        }
    }
    function checkInstructorStatus($u)
    {
        $sql = 'SELECT status FROM instructorbio WHERE userID='.$this->db->escape($u);
        
        $result = $this->db->query($sql);
        
        if($result->num_rows()>0)
        {
            $r = $result->row();
            return $r->status;    
        }
        else
            return NULL;
    }
    function FetchIntructorsForVerification()
    {
        $sql = "SELECT users.userID,firstName, lastName, organization, position, instructorbio.status FROM users, instructorbio WHERE users.userID=instructorbio.userID ORDER BY users.userID DESC";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }
    function validateInstructor($userID,$perm)
    {
        if ($perm == true)
            $sql = "UPDATE instructorbio SET status='approved' WHERE userID=".$this->db->escape($userID);
        else
             $sql = "UPDATE instructorbio SET status='rejected' WHERE userID=".$this->db->escape($userID);
        $this->db->query($sql);
            
    }
    function getFriends($userID)
    {
        $sql = "SELECT firstName, lastName, photo, userID from users WHERE userID in (SELECT friendID FROM friends WHERE status='1' AND userID=".$this->db->escape($userID).")";
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }
    function checkFriendStatus($userID,$friendID)
    {
        $sql = "SELECT status FROM friends WHERE userID=".$this->db->escape($userID)." AND friendID=".$this->db->escape($friendID);
        $result = $this->db->query($sql);
        if($result->num_rows() > 0)
            return $result->row()->status;
        else
            return 0;
    }
    function addFriend($userID,$friendID)
    {
        $sql = "INSERT INTO friends values(".$this->db->escape($userID).", ".$this->db->escape($friendID).", '2')";
        $this->db->query($sql);
    }
    function awaitingFriendReq()
    {
        $userID = $this->session->userdata('userID');
        $sql = "SELECT firstName, lastName, photo, userID from users WHERE userID in (SELECT userID from friends WHERE status='2' AND friendID=".$this->db->escape($userID).")";
        
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }
    function respondFriendReq($requesterID,$p)
    {
        if($p!='1')
            $p = '-1'; // deny
        
        $sql = "UPDATE friends SET status = ".$this->db->escape($p)." WHERE friendID= ".$this->db->escape($this->session->userdata('userID'))." AND userID=".$this->db->escape($requesterID);
        $this->db->query($sql);
        
        if ( $p != '-1' )
        {
            $sql = "INSERT INTO friends values(".$this->db->escape($this->session->userdata('userID')).", ".$this->db->escape($requesterID).", '1')";
            $this->db->query($sql);
        }
    }
    function getUserID($userID)
    {
        $sql = "SELECT userID from users WHERE username=".$this->db->escape($userID)." OR userID=".$this->db->escape($userID);
        
        $u = $this->db->query($sql);
        $u = $u->result_array();
        return $u[0]['userID'];
        
    }
    function getNotifications()
    {
        $u = $this->session->userdata('userID');
        $dt = $this->db->escape(date('Y-m-d'));
        $sql = "SELECT firstName, lastName, courseName, userID, courseID, startDate, endDate, percentage FROM courses natural join studentcoursestats natural join users WHERE userID in (SELECT friendID from friends WHERE userID=".$this->db->escape($u)." AND friendID LIKE 'S%') AND ((startDate>=".$dt." AND endDate IS NULL) OR (startDate>=".$dt." OR endDate>=".$dt."))";
        
        $result = $this->db->query($sql);
        $result = $result->result_array();
        //print_r($result);
        return $result;
        
    }
    function getInstructorNotifications()
    {
        $u = $this->session->userdata('userID');
        $dt = $this->db->escape(date('Y-m-d'));
        $sql = "SELECT firstName, lastName, courseName, userID, courseID, dateOfCreation FROM courses inner join users ON courses.instructorID = users.userID WHERE courses.status='1' AND userID IN (SELECT friendID from friends WHERE userID=".$this->db->escape($u)." AND friendID LIKE 'I%') AND (dateofCreation>=".$dt.")";
        
        //select count(*) from courses inner join users on courses.instructorID = users.userID
        
        $result = $this->db->query($sql);
        $result = $result->result_array();
        //print_r($result);
        return $result;
        
    }
    function updateNotifications()
    {
        $u = $this->session->userdata('userID');
        $dt = $this->db->escape(date('Y-m-d'));
        $sql = "UPDATE users SET lastUpdate=".$dt." WHERE userID=".$this->db->escape($this->session->userdata('userID'));
        $this->db->query($sql);
        
    }
    function recentActivity($uid)
    {
        $sql = "(SELECT * , (
                    CURDATE( ) - startdate
                    ) AS diff
                    FROM  `studentcoursestats` NATURAL JOIN `users` NATURAL JOIN `courses`
                    WHERE CURDATE( ) - startdate <=7
                    AND CURDATE( ) - startdate >0
                    AND userID=".$this->db->escape($uid)."
                    )
                    UNION
                    (
                    SELECT * , (
                    CURDATE( ) - enddate
                    ) AS diff
                    FROM  `studentcoursestats` NATURAL JOIN `users` NATURAL JOIN `courses`
                    WHERE CURDATE( ) - enddate <=7
                    AND CURDATE( ) - enddate >0
                    AND userID=".$this->db->escape($uid)."
                    )
                    ORDER BY diff";
        
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result;
    }
    function getLocation($code)
    {
        $sql = "SELECT location.userID, latitude, longitude FROM studentcoursestats NATURAL JOIN location WHERE courseID=".$this->db->escape($code);
        $result = $this->db->query($sql);
        
        return $result->result_array();
    }
}