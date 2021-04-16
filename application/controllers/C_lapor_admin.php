<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class C_lapor_admin extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('M_data');
            $this->load->library('form_validation');
        } 
        public function index()
        {
            $data = array (
                'getUser' =>  $this->M_data->get_chart_user(),
                'getLapor' => $this->M_data->get_chart_lapor()
            );
            
            $this->load->view('template/V_template_admin_header',$data);
            $this->load->view('admin/index',$data);
            $this->load->view('template/V_template_admin_footer',$data);
            
        }
        public function tambah()
        {
            $data ['title']='Tambah Data Lapor';

            $this->load->helper(array('form','url'));
            $this->load->library('form_validation');
    
            $this->form_validation->set_rules('id_lapor','Id_lapor','required');
            $this->form_validation->set_rules('nama_lapor','Nama','required');
            $this->form_validation->set_rules('kecamatan','kecamatan','required');
			$this->form_validation->set_rules('alamat','alamat','required');
			$this->form_validation->set_rules('tgl_tragedi','tgl_tragedi','required');
			$this->form_validation->set_rules('judul','judul','required');
			$this->form_validation->set_rules('keterangan','keterangan','required');
            $this->form_validation->set_rules('jurusan','jurusan','required');
            $this->form_validation->set_rules('foto_tragedi','foto_tragedi','required');

            if ($this->form_validation->run()==FALSE){
                $this->load->view('/user/index.php');
            }
            else{
                $upload = $this->M_lapor->upload();
                if($upload ['result'] == 'success'){
                    $this->M_data->tambahdatalapor($upload);
                    $this->session->set_flashdata('flash-data','ditambahkan');
                    redirect('lapor','refresh');
                }else{
                    echo $upload['error'];
                }
            }
        }
    
        public function detail($id)
        {
            $data['title']='Detail Kondisi Wilayah ';
            $data['lapor']= $this->M_lapor_admin->getabsensiByID($id);
            $this->load->view("admin/lapor/detailabsensi",$data);
        }
        public function edit($id){
            $data ['title']='Form Edit Data Kondisi Wilayah ';
            $this->form_validation->set_rules('id_siswa','id_siswa','required');
            $this->form_validation->set_rules('tgl_absen','tgl_absen','required');
            $this->form_validation->set_rules('hadir','hadir','required');
            $this->form_validation->set_rules('sakit','sakit','required');
            $this->form_validation->set_rules('izin','izin','required');

            if ($this->form_validation->run() == FALSE){
            #code...    
            $data['lapor']= $this->M_lapor_admin->getabsensiByID($id);        
                $this->load->view("admin/absensi/editabsensi", $data);
            }
            else{
            #code...
                $this->M_lapor_admin->ubahdataabsensi();
                $this->session->set_flashdata('flash-data','diedit');
                redirect('lapor','refresh');
            }
        }   

        public function hapus($id){
            $this->M_lapor_admin->hapusdatakpw($id);
            $this->session->set_flashdata('flash-data','dihapus');
            redirect('lapor','refresh');
        }

    }
    ?>