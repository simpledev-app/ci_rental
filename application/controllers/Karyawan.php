<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('KaryawanModel', 'karyawan');
    }

    public function index()
    {
        $data['title'] = "Karyawan";
        $data['inputs'] = array(
            [
                "name" => "nama",
                "type" => "text",
                "class" => "form-control"
            ],
            [
                "name" => "alamat",
                "type" => "text",
                "class" => "form-control"
            ],
            [
                "name" => "username",
                "type" => "text",
                "class" => "form-control"
            ],
            [
                "name" => "password",
                "type" => "password",
                "class" => "form-control"
            ]);
        
        $data['options'] = array(
            [
                "name" => "jabatan",
                "option" => ["pegawai" => "Pegawai Toko", "admin" => "Petugas Admin"],
                "js" => ["id" => "jabatan", "class" => "form-control"]
            ],
            [
                "name" => "status",
                "option" => ["aktif" => "Aktif", "resign" => "Resign", "tidak aktif" => "Tidak Aktif"],
                "js" => ["id" => "status", "class" => "form-control"]
            ]);

            $this->load->view('layouts/header');
            $this->load->view('layouts/sidebar');
            $this->load->view('karyawan/index', $data);
            $this->load->view('layouts/footer');
    }

    public function request()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama','Nama', 'required');
        $this->form_validation->set_rules('alamat','Alamat', 'required');
        $this->form_validation->set_rules('tgl_lahir','Tanggal Lahir', 'required');
        $this->form_validation->set_rules('username','User Name', 'required');
        $this->form_validation->set_rules('password','Password', 'required');
        $this->form_validation->set_rules('jabatan','Jabatan', 'required');
        $this->form_validation->set_rules('status','Status', 'required');

        if ($this->form_validation->run() === FALSE ) {
            echo json_encode(validation_errors());
        } else {

            $config['upload_path'] = './assets/images/karyawan/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = TRUE; 

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto')) {
                $error = array('error' => $this->upload->display_errors());
                $foto= 'nophoto.jpg';
                //return print_r($error);
            } else {
                $image = $this->upload->data();
                $foto = $image['file_name'];
            }
            
            $data = array(
                "nama" => $this->input->post('nama'),
                "alamat" => $this->input->post('alamat'),
                "tgl_lahir" => $this->input->post('tgl_lahir'),
                "username" => $this->input->post('username'),
                "password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                "jabatan" => $this->input->post('jabatan'),
                "status" => $this->input->post('status'),
                "foto" => $foto
            );

            if ($this->input->post('aksi') === "baru") {
                $pegawai = $this->karyawan->create($data);
                echo json_encode($pegawai);
            } else if($this->input->post('aksi') === "edit") {
                $pegawai = $this->karyawan->update($data);
            } else {
                return show_404();
            }
            
        }
        
    }
}
