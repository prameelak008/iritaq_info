    <?php
    defined('BASEPATH')OR exit('No direct script access allowed');
    class Librarymainsub extends Admin_Controller 
    {
    
    public function librarymain()
    {
    
    $this->session->set_userdata('top_menu', 'Library');
    $this->session->set_userdata('sub_menu', 'Librarymainsub/librarymainsub'); 
    $mainsublist = $this->Librarymainsub_model->allmainsub();
    $data['mainsublist']       = $mainsublist;
    $this->load->view('layout/header', $data);
    $this->load->view('admin/book/addlibrarymainsub', $data);
    $this->load->view('layout/footer', $data);
    }
    
    public function addmainsub()
    {
    $name=$this->input->post('name');
    $status=$this->input->post('status');
    $data=array('lib_mainsub_name'=>$name,'lib_mainsub_status'=>$status);
    $query=$this->Librarymainsub_model->mainsubadd($data);
    redirect('Librarymainsub/librarymain');
    }
    
    public function editmainsub($id) {
    $mainsublist = $this->Librarymainsub_model->allmainsub();
    $data['mainsublist']       = $mainsublist;
    $mainsubedit = $this->Librarymainsub_model->getmainsub($id);
    $data['mainsubedit'] = $mainsubedit;
    $this->load->view('layout/header');
    $this->load->view('admin/book/editlibrarymainsub', $data);
    $this->load->view('layout/footer');
    }
    
    public function updatemainsub() {
    $id = $this->input->post('mainsubid');
    $name = $this->input->post('name');
    $status = $this->input->post('status');
    $query=$this->Librarymainsub_model->mainsubupdate($id,$name,$status);
    redirect('Librarymainsub/librarymain');
    }
    
    public function deletemainsub($id) {
    $query=$this->Librarymainsub_model->mainsubdelete($id);
    redirect('Librarymainsub/librarymain');
    } 
    
    }
    ?>