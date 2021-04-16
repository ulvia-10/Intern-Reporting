<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_data');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['adm'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['getUser'] = $this->M_data->get_chart_user();
        $data['getLapor'] = $this->M_data->get_chart_lapor();
        $data['getKategori'] = $this->M_data->get_chart_kategori();
        $data['getToken'] = $this->M_data->get_chart_token();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
}