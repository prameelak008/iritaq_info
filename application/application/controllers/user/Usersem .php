<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usersem extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // Load session library if not autoloaded
        $this->load->library('session');

        // Check if semester student is logged in
        $sem_student = $this->session->userdata('sem_student');
        
        if (empty($sem_student) || !isset($sem_student['id'])) {
            // Not logged in - redirect to login
            redirect('semesterauth/login'); // Match your login controller route
            exit;
        }
        
        // Optional: Store in a property for easy access
        $this->sem_student = $sem_student;
    }

    public function dashboard()
    {
        // Debug - see what's in session
        echo '<h3>Session Data:</h3>';
        echo '<pre>';
        print_r($this->session->userdata());
        echo '</pre>';
        
        echo '<h3>Semester Student Data:</h3>';
        echo '<pre>';
        print_r($this->sem_student);
        echo '</pre>';
        
        // Uncomment below when ready to load actual view
        // $data['student'] = $this->sem_student;
        // $this->load->view('semester/dashboard', $data);
    }
}