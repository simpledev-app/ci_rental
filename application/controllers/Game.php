<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('GameModel','game');
    }

    public function index()
    {
        $data['title'] = 'Game';

        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('game/index');
        $this->load->view('layouts/footer');
    }

    public function create()
    {
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('judul','Judul','required');
        $this->form_validation->set_rules('genre','Genre','required');
        $this->form_validation->set_rules('harga','Harga','required');
        $this->form_validation->set_rules('jumlah','Judul','required');
        $this->form_validation->set_rules('kode','Judul','required');

    
        if ($this->form_validation->run() === FALSE) {
           
            echo json_encode(validation_errors());
            
        } else {
            $config['upload_path'] = './assets/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = TRUE; 

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $error = array('error' => $this->upload->display_errors());
                $cover= 'noimage.jpg';
                //return print_r($error);
            } else {
                $image = $this->upload->data();
                $cover = $image['file_name'];
            }

            $data = array(
                'kode' => $this->input->post('kode'),
                'judul' => $this->input->post('judul'),
                'hargasewa' => $this->input->post('harga'),
                'jumlah' => $this->input->post('jumlah'),
                'diskripsi' => $this->input->post('diskripsi'),
                'gambar' => $cover
            );

            $this->game->create($data);
            echo $cover;
        }
        
    }
    
}
