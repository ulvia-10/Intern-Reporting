<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_admin extends CI_Controller
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
        $data['title'] = 'DataKPRM';
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
        $this->load->view('admin/tables', $data);
        $this->load->view('templates/footer');
    }
    public function indexuser()
    {
        $data['title'] = 'DataAnggotaKprm';
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
        $this->load->view('admin/tables_user', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'DataKPRM';
        $data['adm'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['lapor'] = $this->M_data->getlaporByID($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detailkondisi', $data);
        $this->load->view('templates/footer');
    }


    public function edit($id)
    {
        $data['title'] = 'DataKPRM';
        $data['adm'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['title'] = 'Form Edit Data Siswa';
        $data['dataCategory'] = $this->M_lapor_user->getDataCategory();

        $this->form_validation->set_rules('id_lapor', 'id_lapor', 'required');
        $this->form_validation->set_rules('nama_lapor', 'nama', 'required');
        $this->form_validation->set_rules('judul', 'judul', 'required');
        $this->form_validation->set_rules('tgl_tragedi', 'tgl_tragedi', 'required');
        $this->form_validation->set_rules('kecamatan', 'kecamatan', 'required');
        $this->form_validation->set_rules('status_lapor', 'status_lapor', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required');

        if ($this->form_validation->run() == FALSE) {
            #code...    
            $data['lapor'] = $this->M_data->getlaporByID($id);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editkondisi', $data);
            $this->load->view('templates/footer');
        } else {
            // #code...
            $this->M_data->ubahdata();


            // redirect('C_data/index','refresh');
        }
    }




    //on remove photo
    function onRemovePhotoTragedi()
    {

        $id_lapor  = $this->input->get('id_lapor');
        $index_foto = $this->input->get('index');

        $this->M_data->processRemovePhoto($id_lapor, $index_foto);
    }

    public function hapus($id)
    {
        $this->M_data->hapusdatalpr($id);
        $this->session->set_flashdata('flash-data', 'dihapus');
        redirect('C_data/index', 'refresh');
    }
    public function hapususer($id)
    {
        $this->M_data->hapusdatausr($id);
        $this->session->set_flashdata('flash-data', 'dihapus');
        redirect('C_data/indexuser', 'refresh');
    }


    public function cetakData()
    {

        $this->load->library('pdf_laporan');
        // $data['lapor'] = $this->Cetak_model_data->view();
        // $this->pdf_siswa->setPaper('A4', 'portrait');
        // $this->pdf_siswa->filename = "laporankondisiwilayah.pdf";
        // $this->pdf_siswa->load_view('admin/laporankondisi',$data);

        $pdf = new Pdf_laporan('P', 'mm', 'A4', true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('BIDANG KEWASPADAAN DAERAH DAN PENANGANAN KONFLIK');
        $pdf->SetTitle('BAKESBANGPOL');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        // $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
        // header table

        $pdf = new \TCPDF();
        $pdf->AddPage('P', 'mm', 'A4');
        $pdf->SetFont('', 'B', 14);
        $pdf->Cell(150, 10, "DAFTAR PELAPORAN KONDISI WILAYAH", 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);



        // html 
        $src = base_url('assets/img/hero-img.png');
        $table = '<table width="100%" border="1">

                <tr>
                    <td width="25%" rowspan="2">
                        <img src="' . $src . '" alt="Image" style="width: 400px"/>
                    </td>
                    <td width="75%" colspan="2">
                        <label style="font-size: 14px"><b>Informasi Detail</b></label><br>
                        <label>Berikut adalah rincian detail dari informasi sebagai berikut</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <small>Judul</small><br>
                        <label>Lorep isum</label> 

                        <br><br>
                        
                        <small>Nama Lapor</small><br>
                        <label>Lorep isum</label> 
                        <br><br>
                        
                        <small>Kategori</small><br>
                        <label>Lorep isum</label> 
                        <br><br>
                        
                        <small>Kecamatan</small><br>
                        <label>Lorep isum</label> 
                        <br><br>
                    </td>
                    <td>
                        <small>Tanggal Kejadian</small><br>
                        <label>Lorep isum</label> 
                        <br><br>
                        
                        <small>Alamat Kejadian</small><br>
                        <label>Lorep isum</label> 
                        <br><br>
                        
                        <small>Uraian</small><br>
                        <label>Lorep isum</label> 
                    </td>
                </tr>
            </table>';


        $pdf->SetFont('', 'B', 10);
        $pdf->Cell(27, 10, "Laporan Kondisi Wilayah di Kota Malang 2021", 0, 1, 'L');

        $pdf->writeHTML($table, true, false, true, false, '');
        $pdf->Output('LaporanKondisiWilayah.pdf');


        //============================================================+
        // END OF FILE
        //============================================================+

    }


    function getCetakById($id)
    {

        $this->load->library('pdf_laporan');
        // $data['lapor'] = $this->Cetak_model_data->view();
        // $this->pdf_siswa->setPaper('A4', 'portrait');
        // $this->pdf_siswa->filename = "laporankondisiwilayah.pdf";
        // $this->pdf_siswa->load_view('admin/laporankondisi',$data);

        $pdf = new Pdf_laporan('P', 'mm', 'A4', true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('BIDANG KEWASPADAAN DAERAH DAN PENANGANAN KONFLIK');
        $pdf->SetTitle('BAKESBANGPOL');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        $pdf->AddPage();
        $pdf->SetFont('Times', '', 10);
        // header table


        $key = array(

            'id_lapor'  => $id
        );
        $dataLapor = $this->M_data->getDataLapor($key);
        $row = $dataLapor['data'][0];


        // html 
        $src = base_url('assets/img/hero-img.png');
        $img = "";

        if ($row['foto_tragedi']) {

            $checkDataPhoto = explode(',', $row['foto_tragedi']);

            // apakah gambar tsb lebih dari 1 ?
            if (count($checkDataPhoto) > 1) {

                foreach ($checkDataPhoto as $rowPhoto) {

                    $img .= '<img src="' . base_url('assets/images/' . $rowPhoto) . '" style="width: 400px"> <hr>';
                }
            } else { // gambar hanya 1

                $img = '<img src="' . base_url('assets/images/' . $row['foto_tragedi']) . '" style="width: 400px">';
            }
        }

        $table = '<hr> <br> <br> <table width="100%" border="0" >

            <tr>
               
                <td width="75%" colspan="2">
                    <label style="font-size: 14px"><b>Informasi Detail</b></label><br>
                    <label>Berikut adalah rincian detail dari informasi sebagai berikut</label>
                </td>
            </tr>
            <tr>
                <td>
                    <small>Judul</small><br>
                    <label>' . $row['judul'] . '</label> 

                    <br><br>
                    
                    <small>Nama Lapor</small><br>
                    <label>' . $row['nama_lapor'] . '</label> 
                    <br><br>
                    
                    <small>Kategori</small><br>
                    <label>' . $row['nama_kategori'] . '</label> 
                    <br><br>
                    
                    <small>Kecamatan</small><br>
                    <label>' . $row['kecamatan'] . '</label> 
                    <br><br>
                    </td>
                    <td>
                    <small>Tanggal Kejadian</small><br>
                    <label>' . $row['tgl_tragedi'] . '</label> 
                    <br><br>
                    
                    <small>Alamat Kejadian</small><br>
                    <label>' . $row['alamat'] . '</label> 
                    <br><br>
                    
                    <small>Uraian</small><br>
                    <label>' . $row['keterangan'] . '</label> 
                </td>
            </tr>
        </table>';



        $table2 = ' <br> <br> <hr> <br> <br> <br> <table width="100%" border="0" >

            <tr>
            <br>
            <br>
                <td width="25%" rowspan="2">
                    ' . $img . '
                </td>
               
            </tr>
        </table>';


        $pdf->SetFont('', 'B', 10);
        $pdf->Cell(200, 15, "Laporan Kondisi Wilayah di Kota Malang 2021", 0, 1, 'C');

        $pdf->writeHTML($table, true, false, true, false, '');

        $pdf->AddPage();

        $pdf->writeHTML($table2, true, false, true, false, '');
        $pdf->Output('LaporanKondisiWilayah.pdf');
    }


    // export by PDF
    function exportLaporanPDF()
    {

        $this->M_data->processExportPDF();
    }
}