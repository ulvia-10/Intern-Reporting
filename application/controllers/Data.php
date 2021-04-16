<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_data');
        $this->load->model('Cetak_model_data');
        $this->load->model('M_lapor_user');

        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'Data Laporan';
        $data['adm'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['lapor'] = $this->M_data->getlaporkategori();

        if ($this->input->post('keyword')) {
            #code...
            $data['lapor'] = $this->M_data->cariData();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/tables', $data);
        $this->load->view('templates/footer');
    }
    public function indexuser()
    {
        $data['title'] = 'Info User';
        $data['adm'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['user'] = $this->M_data->getalluser();
        if ($this->input->post('keyword')) {
            #code...
            $data['user'] = $this->M_data->cariData();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/tables_user', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'Data Laporan';
        $data['adm'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['lapor'] = $this->M_data->getlaporByID($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/detailkondisi', $data);
        $this->load->view('templates/footer');
    }
}