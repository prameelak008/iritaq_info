                <?php

                if (!defined('BASEPATH')) {
                exit('No direct script access allowed');
                }                    

                class Batchtype extends Admin_Controller
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
                if (!$this->rbac->hasPrivilege('batchtype', 'can_view')) {
                access_denied();
                }

                $this->session->set_userdata('top_menu', 'semester');
                $this->session->set_userdata('sub_menu', 'batchtype/index');

                $data['title']      = 'Add batch';
                $data['title_list'] = 'batch';

                
                $this->form_validation->set_rules('batch_mode', $this->lang->line('mode'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('batch_id', $this->lang->line('batch_id'), 'trim|required|xss_clean');

                $this->form_validation->set_rules('program_type', $this->lang->line('program_type'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('programe', $this->lang->line('programe'), 'trim|required|xss_clean');

                // $this->form_validation->set_rules('batch_code', $this->lang->line('batch_code'), 'trim|required|xss_clean|callback_check_batch_code_exists');
                $this->form_validation->set_rules('batch_group', $this->lang->line('batch_group'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('programe', $this->lang->line('programe'), 'trim|required|xss_clean');

                $this->form_validation->set_rules('batch_code', $this->lang->line('batch_code'),'trim|required|xss_clean|callback_check_batch_code_exists'
                );

                if ($this->form_validation->run() == false)
                {
                } 
                else 
                {
                 

                $data                   = array(
                'b_bid'                 => $this->input->post('batch_id'),
                'b_code'                => $this->input->post('batch_code'),
                'b_createddate'         => date('Y-m-d H:i:s'),
                'b_name'                => $this->input->post('batch_group'),
                // 'b_year'                => $this->input->post('batch_year'),
                'b_mode'                => $this->input->post('batch_mode'),
                'b_program'             => $this->input->post('programe'), 
                'b_session'             => $this->current_session);
                $this->Batchtype_model->add($data);

                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                redirect('semester/batchtype/index');
                }
                $data['batch_list']         =   $this->Batchtype_model->get();
                $data['max_code']           =   $this->Batchtype_model->get_maxcode();
                $data['Programmetype_list'] =   $this->Programmetype_model->getprg_type();
                $data['batch_mode']         =   $this->Batchtype_model->get_batchmode($data);
                $batch_list                 =   $data['batch_list'];           

                $data['batch_group']        =   $this->Batchtype_model->get_batchlist();

                $data['batch_grouplist']    =   $this->Batchtype_model->get_batchgroup();

                $this->load->view('layout/header', $data);
                $this->load->view('semester/batchtype/add_data', $data);
                $this->load->view('layout/footer', $data);
                // }
               }




                public function edit($id)
                {
                // if (!$this->rbac->hasPrivilege('semester', 'can_edit')) {
                // access_denied();
                // }
                $data['title']         = 'Edit Batch';
                $data['id']            =   $id;
                $data['batch']         =   $this->Batchtype_model->get($id);
                // $sem                   =   $data['sem'];
                $data['title_list']    =  'batch List';
                $data['batch_list']    =   $this->Batchtype_model->get();
                $data['batch_mode']     = $this->Batchtype_model->get_batchmode($data);
                $batch_list            =   $data['batch_list'];
                $data['Programmetype_list'] = $this->Programmetype_model->get();
                $data['batch_group']         =   $this->Batchtype_model->get_batchgroup();
                $this->form_validation->set_rules('batch_mode', $this->lang->line('mode'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('batch_id', $this->lang->line('batch_id'), 'trim|required|xss_clean');

                $this->form_validation->set_rules('program_type', $this->lang->line('program_type'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('programe', $this->lang->line('programe'), 'trim|required|xss_clean');
                // $this->form_validation->set_rules('batch_code', $this->lang->line('batch_code'), 'trim|required|xss_clean');               
                $this->form_validation->set_rules('batch_group', $this->lang->line('batch_group'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('programe', $this->lang->line('programe'), 'trim|required|xss_clean');

              
                if ($this->form_validation->run() == false) {
                $this->load->view('layout/header', $data);
                $this->load->view('semester/batchtype/edit_data', $data);
                $this->load->view('layout/footer', $data);
                }
                else
                {

                $batch_code  = $this->input->post('batch_code');
                $exists      = $this->Batchtype_model->check_exists_for_edit($batch_code, $id);

                if ($exists) {
                $this->session->set_flashdata(
                'msg',
                '<div class="alert alert-danger text-left">Faculty code or name already exists for another record.</div>'
                );
                redirect($_SERVER['HTTP_REFERER']);
                } 
                else {

                $data           =  array(
                'b_id'          => $id,
                // 'b_bid'          => $this->input->post('batch_id'),
                'b_code'        => $batch_code,
                'b_updateddate' => date('Y-m-d H:i:s'),
                'b_name'        => $this->input->post('batch_group'),
                // 'b_year'        => $this->input->post('batch_year'),
                'b_mode'        => $this->input->post('batch_mode'),
                'b_program'     => $this->input->post('programe'), 
                'b_session'     => $this->current_session);
                $this->Batchtype_model->add($data);

                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
                redirect($_SERVER['HTTP_REFERER']);                    
                }
                }  
                }                  

                public function delete($id)
                {
                if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
                access_denied();
                }
                $data['title']       = 'batch Details';
                $this->Batchtype_model->remove($id);
                // redirect($_SERVER['HTTP_REFERER']);
                redirect('semester/batchtype');
                }



                public function update_status()
                {
                $batch_id        = $this->input->post('batch_id');
                $status          = $this->input->post('status');
                $data            = array('b_status' => $status);
                $this->db->where('b_id', $batch_id);
                if ($this->db->update('batchtype', $data))
                {
                echo json_encode(array('status' => 'success'));
                } 
                else
                {
                echo json_encode(array('status' => 'error'));
                }
                }

                public function check_batch_code_exists($batch_code)
                {
                if ($this->Batchtype_model->batch_code_exists($batch_code))
                {
                $this->form_validation->set_message('check_batch_code_exists', 'The {field} already exists.');
                return FALSE;
                } else {
                return TRUE;
                }
                }


                public function check_batch_name_exists($batch_name)
                {
                if ($this->Batchtype_model->batch_name_exists($batch_name))
                {
                $this->form_validation->set_message('check_batch_name_exists', 'The {field} already exists.');
                return FALSE;
                } else {
                return TRUE;
                }
                }


                public function bulkDelete()
                {
                $ids = $this->input->post('ids');
                if (!empty($ids)) {
                foreach ($ids as $id) {
                $this->Batchtype_model->remove($id);
                }
                echo "success";
                } else {
                echo "no_ids";
                }
                }  


                
                public function add_batch_group()
                {
                $name   = trim($this->input->post('batch_group_name'));
                $year   = trim($this->input->post('batch_group_year'));
                if ($name === '' || $year === '') {
                echo json_encode(['status' => 'error', 'message' => 'Required fields missing']);
                return;
                }
                $data = [
                'batch_group_name'   => $name,
                'batch_group_year'   => $year,
                'batch_group_status' => 1,
                ];
                $this->db->insert('batch_groups', $data);
                $id = $this->db->insert_id();
                echo json_encode(['status' => 'success', 'id' => $id]);
                }


                public function get_batch_groups()
                {
                $query = $this->db->select('batch_group_id, batch_group_name, batch_group_year, batch_group_status')
                ->from('batch_groups')
                ->get();
                echo json_encode($query->result_array());
                }



                public function update_batch_group()
                {
                $id     = (int)$this->input->post('batch_group_id');
                $name   = trim($this->input->post('batch_group_name'));
                $year   = trim($this->input->post('batch_group_year'));
                if (!$id || $name === '' || $year === '') {
                echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
                return;
                }
                $data = [
                'batch_group_name'   => $name,
                'batch_group_year'   => $year,
                ];
                $this->db->where('batch_group_id', $id)->update('batch_groups', $data);
                echo json_encode(['status' => 'success']);
                }

                public function delete_batch_group($id = null)
                {
                $id = (int)($id ?? $this->input->post('batch_group_id'));
                if (!$id) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid id']);
                return;
                }
                $this->db->where('batch_group_id', $id)->delete('batch_groups');
                echo json_encode(['status' => 'success']);
                }

                public function toggle_batch_group_status()
                {
                $id     = (int)$this->input->post('batch_group_id');
                $status = (int)$this->input->post('status');
                if (!$id) {
                    echo json_encode(['status' => 'error', 'message' => 'Invalid id']);
                    return;
                }
                $this->db->where('batch_group_id', $id)->update('batch_groups', ['batch_group_status' => ($status ? 1 : 0)]);
                echo json_encode(['status' => 'success']);
                }



              




            }
