<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller 
{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('PelangganModel', 'pelanggan');
    }

    public function index()
    {
        $data['title'] = 'Pelanggan';
        $data['inputs'] = array(
            [
                "name" => 'nama',
                "type" => 'text',
                "class" => 'form-control'
            ],
            [
                "name" => 'alamat',
                "type" => 'text',
                "class" => 'form-control'
            ],
            [
                "name" => 'no_telphone',
                "type" => 'number',
                "class" => 'form-control'
            ],
            [
                "name" => 'no_ktp',
                "type" => 'text',
                "class" => 'form-control'
            ]
        );

        $data['select'] = array(
            "name" => "gender",
            "option" => ['laki-laki' => 'Laki-laki', 'perempuan' => 'Perempuan', 'unknown' => 'Tidak diketahui'],
            "js" => ["id" => "gender", "class" => "form-control"]
        );

       // print_r($data['form']);

       $this->load->view('layouts/header');
       $this->load->view('layouts/sidebar');
       $this->load->view('pelanggan/index', $data);
       $this->load->view('layouts/footer');
    }

    public function request()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama','Nama', 'required');
        $this->form_validation->set_rules('alamat','Alamat', 'required');
        $this->form_validation->set_rules('no_telphone','No Telphone', 'required');
        $this->form_validation->set_rules('no_ktp','No KTP', 'required');
        $this->form_validation->set_rules('gender','Gender', 'required');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(validation_errors());
        } else {
            $data = array(
                "nama" => $this->input->post('nama'),
                "alamat" => $this->input->post('alamat'),
                "no_telphone" => $this->input->post('no_telphone'),
                "no_ktp" => $this->input->post('no_ktp'),
                "gender" => $this->input->post('gender')
            );
    
            if ($this->input->post('aksi') === "baru") {
               $pelanggan = $this->pelanggan->create($data);
               echo json_encode($pelanggan);
            } else if ($this->input->post('aksi') === "ubah") {
                $this->pelanggan->edit($data);
            } else {
                return show_404();
            }    
        }
        
    }
}
