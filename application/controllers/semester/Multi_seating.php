            <?php

            if (!defined('BASEPATH')) 
            {
            exit('No direct script access allowed');
            }                   


            class Multi_seating extends Admin_Controller
            {

            public function __construct()
            {
            parent::__construct();
            $this->load->helper('form');
            $this->config->load('app-config');
            $this->load->library("datatables");
            $this->current_session = $this->setting_model->getCurrentSession(); 
            }
            

            public function index()
            {

            $data['title']      = 'Add Multi Seating';
            $data['title_list'] = 'Allocation';

            
            // $data['programs']             =  $this->Semester_enrollment_model->get_program_list();
            $data['batch_types']        =  $this->Semester_enrollment_model->get_batch_types();
            $data['semester_term']   = $this->Semester_enrollment_model->get_semester_term();


            $data['programee_list'] =   $this->Programee_model->get();

            $total_capacity             = $this->input->post('total_capacity'); 
            $data['total_capacity']     = $total_capacity;
            $data['get_seat_list']      = $this->Room_allocation_model->get_seat_list();
            $seat_select                = $this->input->post('seat_select');
            $data['seat_select']        = $seat_select; // expose for set_value restore in view
            $data['subject_id']         = $this->input->post('subjects'); // expose for set_value restore in view

            $data['get_seat_count']     = $this->Room_allocation_model->get_seat_capacity($seat_select);                


            $this->load->view('layout/header', $data);        
            $this->load->view('semester/seatarrangement/index', $data);
            $this->load->view('layout/footer', $data);
            }

            }  





























































            
