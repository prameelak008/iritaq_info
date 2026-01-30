            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            class Period_wise extends Admin_Controller {
            
            function __construct() 
            {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            
            
            function index() 
            {
            if (!$this->rbac->hasPrivilege('period_wise', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'Academics');
            $this->session->set_userdata('sub_menu', 'period_wise/index');
            $data['title'] = 'period_wise';
            $data['title_list'] = 'period_wise';
            $this->form_validation->set_rules('name', $this->lang->line('name'), 'required');
            $this->form_validation->set_rules('fromtime', $this->lang->line('fromtime'), 'required');
            $this->form_validation->set_rules('totime', $this->lang->line('totime'), 'required');
            $this->form_validation->set_rules('description', $this->lang->line('description'), 'required');
            
            if ($this->form_validation->run() == FALSE)
            {
            
            }
            else 
            {
            $data = array(
            'periodic_table_name' => $this->input->post('name'),
            'periodic_table_timefrom' => date("g:i a", strtotime($this->input->post('fromtime'))),
            'periodic_table_timeto' => date("g:i a", strtotime($this->input->post('totime'))),
            'periodic_table_description' => $this->input->post('description'),
            'periodic_table_session' => $this->current_session,
            );
            
            $this->db->insert('periodic_table',$data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('success_message').'</div>');
            redirect('admin/period_wise/index');
            }
            $periodwise = $this->Periodwise_model->get();
            $data['periodwise'] = $periodwise;
            
            $this->load->view('layout/header', $data);
            $this->load->view('admin/periodwise/periodwiseList', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
            function delete($id) 
            {
            if (!$this->rbac->hasPrivilege('period_wise', 'can_delete')) {
            access_denied();
            }
            $data['title'] = 'Period Wise';
            
            $this->db->where('periodic_table_id',$id);  
            $this->db->delete('periodic_table');
            redirect('admin/period_wise/index');
            }
            
            
            
            
            function edit($id) 
            {
            if (!$this->rbac->hasPrivilege('period_wise', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'Academics');
            $this->session->set_userdata('sub_menu', 'period_wise/index');
            
            $data['id'] = $id;
            $period = $this->Periodwise_model->getbyid($id);
            
            $data['period'] = $period;
            
            
            $periodwise = $this->Periodwise_model->get();
            $data['periodwise'] = $periodwise;
            
            
            $this->form_validation->set_rules('name', $this->lang->line('name'), 'required');
            $this->form_validation->set_rules('fromtime', $this->lang->line('fromtime'), 'required');
            $this->form_validation->set_rules('totime', $this->lang->line('totime'), 'required');
            $this->form_validation->set_rules('description', $this->lang->line('description'), 'required');
            $this->form_validation->set_rules('status', $this->lang->line('status'), 'required');
            $this->form_validation->set_rules('periodcount', $this->lang->line('periodcount'), 'required'); 
            
            
            if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/periodwise/periodwiseEdit', $data);
            $this->load->view('layout/footer', $data);
            } 
            else 
            {
            $data = array(
            'periodic_table_name' => $this->input->post('name'),
            'periodic_table_timefrom' => date("g:i a", strtotime($this->input->post('fromtime'))),
            'periodic_table_timeto' => date("g:i a", strtotime($this->input->post('totime'))),
            'periodic_table_description' => $this->input->post('description'),
            'periodic_table_count'    => $this->input->post('periodcount'),
            'periodic_table_status'   => $this->input->post('status'),
            'periodic_table_session'  => $this->current_session,
            );
            
            $this->db->where('periodic_table_id',$id);  
            $this->db->update('periodic_table',$data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('update_message').'</div>');
            redirect('admin/period_wise/index');
            }
            }
            
            }
            
            ?>