<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('page/home');
        $this->load->view('layouts/footer');
    }

    public function post()
    {
        $this->load->library('form_validation');

        
        $test = $this->input->post('page');
        for ($i=0; $i < (count($test)); $i++) { 
            $this->form_validation->set_rules('page['.$i.']','Post '.$i,'required');
            if ($this->form_validation->run() === FALSE) {
                return print_r($this->validation_errors());
            } 
        }

        return print_r($test);
        
    }

    public function autocomple()
    {
        $data['title'] = "Auto Complete";
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('page/index');
        $this->load->view('layouts/autocomplete');
    }
}
