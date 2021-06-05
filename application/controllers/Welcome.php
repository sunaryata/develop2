<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index()
    {
        $this->data['hasil'] = $this->Mahasiswa_model->getMahasiswa('mahasiswa');
        $this->load->view('welcome_message',$this->data);
    }
}
