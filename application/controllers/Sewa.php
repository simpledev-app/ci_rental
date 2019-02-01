<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Sewa extends CI_Controller 
{
    public function __construct()
    {
        parent:: __construct();
        $this->model->load('SewaController', 'sewa');
    }

    public function index()
    {
        $data['title'] = 'Sewa';
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('sewa/index', $data);
        $this->load->view('layouts/footer');
    }

    public function request()
    {
        
    }
}
