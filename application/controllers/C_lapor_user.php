<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_lapor_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_data');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'Data User';

        $data['adm'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $this->load->view('user/index');
    }
}