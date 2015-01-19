<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forum extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('forums');
	}
    public function index()
    {
        
    }
    public function viewForum($courseID='')
    {
		if(!$this->session->userdata('userID') || $courseID == '')
		{
			redirect(site_url(), 'location');
			return;
		}
		$threads = $this->forums->fetchThreads($courseID);
		$data['threads'] = $threads;
		$data['courseID'] = $courseID;
		$this->load->view('forum/courseThread', $data);

    }
    public function createThread($courseID='')
    {
    	if(!$this->session->userdata('userID') || $courseID == '')
		{
			redirect(site_url(), 'location');
			return;
		}
		$posted = $this->input->post();
		$posted['userID'] = $this->session->userdata('userID');
		$posted['date'] = date('d M Y H:i:s');
		$posted['courseID'] = $courseID;

		$threadID = $this->forums->createThread($posted);
		unset($_POST);
		$this->post($threadID);

    }
    public function deleteThread($threadID){}
    public function post($threadID='')
    {
    	if(!$this->session->userdata('userID') || $threadID == '')
		{
			redirect(site_url(), 'location');
			return;
		}
		$posted = $this->input->post();
		if(!empty($posted))
		{
			$posted['threadID'] = $threadID;
			$posted['userID'] = $this->session->userdata('userID');
			$posted['date'] = date('d M Y H:i:s');
			$this->forums->newPost($posted);
		}
		$threads = $this->forums->fetchThreads(substr($threadID, 0, strpos($threadID, '-')), $threadID);
		if(!empty($threads))
			$data['threads'] = $threads[0];
		$data['posts'] = $this->forums->fetchPosts($threadID);

		$this->load->view('forum/posts', $data);
    } 
}