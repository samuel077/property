<?php
class User_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    function add_user()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'school_id' => $this->input->post('school_id'),
            'account' => $this->input->post('account'),
            'password' => $this->input->post('passwd'),
            'email' => $this->input->post('email'),
            'enroll_year' => $this->input->post('enroll_year'),
            'identity_type' => $this->input->post('identity_type')
        );

        $this->db->insert('users',$data);
    } 
        
} 

?>
