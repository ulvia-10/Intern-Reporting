<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates/header_page');
        $this->load->view('page/index');
        $this->load->view('templates/footer_page');
    }
}