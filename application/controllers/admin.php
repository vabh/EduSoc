<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
    public function index()
    {
        
    }
    public function createInstructor(){}
    public function deleteInstructor(){}
    public function verifyInstructor($userID='', $permission='')
    {
        if($this->session->userdata('userType') != 'admin')
            return;
        $this->load->model('accounts');
        if($userID == '')
        {            
            $inst = $this->accounts->FetchIntructorsForVerification();
            $data = array('inst' => $inst);
            $this->load->view('admin/verifyInstructor', $data);
        }
        else
        {
            if($permission == '')
                return;
            
            if ($permission == '1')
                $this->accounts->validateInstructor($userID,true);
            else
                $this->accounts->validateInstructor($userID,false);
            redirect(site_url().'admin/verifyInstructor', 'location');
        }
    }
    public function deleteUser(){}
    public function generateReport(){}
}
