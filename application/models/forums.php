<?php
class Forums extends CI_Model{
	function fetchThreads($c, $t='')
	{
		$sql = "SELECT courseID, threadID, subject, content, date, firstName, lastName, userID FROM thread NATURAL JOIN users WHERE courseID=".$this->db->escape($c).($t == '' ? '' : " AND threadID=".$this->db->escape($t));
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	function createThread($data)
	{
		$sql = "SELECT count(*) as num FROM thread WHERE courseID=".$this->db->escape($data['courseID']);
		$result = $this->db->query($sql);
		$threadID = $data['courseID'].'-T'.(intval($result->row()->num) + 1);
		
		$sql = $this->db->escape($data['courseID']).", ".$this->db->escape($threadID).", ".$this->db->escape($data['userID']).", ".$this->db->escape($data['subject']).", ".$this->db->escape($data['content']).", ".$this->db->escape($data['date']);
		$sql = "INSERT INTO thread(courseID,threadID,userID,subject,content,date) VALUES (".$sql.")";
		$this->db->query($sql);
		return $threadID;

	}
	function fetchPosts($t)
	{
		$sql = "SELECT threadID, userID, firstName, lastName, photo, content, date FROM users NATURAL JOIN posts WHERE threadID=".$this->db->escape($t)."ORDER BY postID DESC";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	function newPost($data)
	{
		$sql = "SELECT count(*) as num FROM posts WHERE threadID=".$this->db->escape($data['threadID']);
		$result = $this->db->query($sql);
		$postID = $data['threadID'].'-P'.(intval($result->row()->num) + 1);
		
		$sql = $this->db->escape($postID).", ".$this->db->escape($data['threadID']).", ".$this->db->escape($data['userID']).", ".$this->db->escape($data['content']).", ".$this->db->escape($data['date']);
		$sql = "INSERT INTO posts(postID, threadID, userID, content, date) VALUES (".$sql.")";
		$this->db->query($sql);
	}

}