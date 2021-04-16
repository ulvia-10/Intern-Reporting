<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{
    public function count_all()
    {
        return $this->db->count_all('lapor'); // Untuk menghitung semua data lapor
    }


    // get data lapor
    function getDataLapor($key = null)
    {

        $data = array();


        $this->db->select('lapor.*, user.*, kategori.*')->from('lapor');
        $this->db->join('user', 'user.id_user = lapor.id_user');
        $this->db->join('kategori', 'kategori.id_kategori = lapor.id_kategori');

        if ($key) {

            $this->db->where($key);
        }

        $dataLapor = $this->db->get();

        // cek isi
        if ($dataLapor->num_rows() > 0) {

            foreach ($dataLapor->result_array() as $row) {

                array_push($data, array(

                    // tabel lapor
                    'id_lapor'      => $row['id_lapor'],
                    'id_kategori'   => $row['id_kategori'],
                    'id_user'       => $row['id_user'],
                    'nama_lapor'    => $row['nama_lapor'],
                    'kecamatan' => $row['kecamatan'],
                    'status_lapor' => $row['status_lapor'],
                    'alamat'    => $row['alamat'],
                    'tgl_tragedi'   => $row['tgl_tragedi'],
                    'judul'         => $row['judul'],
                    'keterangan'    => $row['keterangan'],
                    'foto_tragedi'  => $row['foto_tragedi'],
                    'created_at'    => $row['created_at'],

                    // tabel kategori
                    'nama_kategori' => $row['nama_kategori'],

                    // user
                    'nama_lengkap'  => $row['nama_lengkap'],
                ));
            }
        }

        return array(

            'status'    => count($data) > 0 ? true : false,
            'data'      => $data
        );
    }




    public function getlaporByID($id)
    {
        // return $this->db->get_where('lapor',array('id_lapor'=>$id))->row_array();

        $sql = "SELECT a.id_lapor,b.id_kategori,b.nama_kategori,a.nama_lapor,a.status_lapor,a.kecamatan,a.alamat, a.foto_tragedi, a.tgl_tragedi, a.keterangan, a.judul, a.created_at
            FROM lapor a, kategori b 
            where a.id_kategori = b.id_kategori AND a.id_lapor = '$id'";

        return $this->db->query($sql)->row_array();
    }
    public function get_chart_user()
    {
        $query = $this->db->get('user');
        return $query->num_rows();
    }
    public function get_chart_lapor()
    {
        $query = $this->db->get('lapor');
        return $query->num_rows();
    }
    public function get_chart_kategori()
    {
        $query = $this->db->get('kategori');
        return $query->num_rows();
    }
    public function get_chart_token()
    {
        $query = $this->db->get('user_token');
        return $query->num_rows();
    }


    public function getlaporkategori()
    {
        $sql = "SELECT a.id_lapor,b.id_kategori,b.nama_kategori, a.nama_lapor,a.kecamatan,a.status_lapor,a.alamat,a.tgl_tragedi
            FROM lapor a, kategori b 
            where a.id_kategori = b.id_kategori";
        return $this->db->query($sql);
    }
    public function getalluser()
    {
        return $this->db->get('user');
    }

    public function tambahdatalpr($upload)
    {
        $data = array(
            "nama_lapor" => $this->input->post('nama_lapor', true),
            "judul" => $this->input->post('judul', true),
            "nama_kategori" => $this->input->post('nama_kategori', true),
            "tgl_tragedi" => $this->input->post('tgl_tragedi', true),
            "status_lapor" => $this->input->post('status_lapor', true),
            "kecamatan" => $this->input->post('kecamatan', true),
            "judul" => $this->input->post('judul', true),
            "keterangan" => $this->input->post('keterangan', true),
            // "foto_tragedi"=>$this->input->post('foto_tragedi',true)
        );
        $this->db->insert('lapor', $data);
    }
    public function upload()
    {
        $config['upload_path'] = '. /images/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('foto_tragedi')) {
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }

    public function cariData()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('nama_lapor', $keyword);
        $this->db->or_like('id_lapor', $keyword);
        return $this->db->get('lapor')->result_array();
    }

    public function ubahdata()
    {


        $id_lapor = $this->input->post('id_lapor');

        $config['upload_path']          = './assets/images/'; // direktori lokal
        $config['allowed_types']        = 'jpeg|jpg|png'; // ekstensi
        $config['max_size']             = 3000; // 3 mb

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $photo = "";

        if (!empty($_FILES['foto_tragedi']['name'])) {

            // check data upload 
            if (!$this->upload->do_upload('foto_tragedi')) {

                $upload_error = $this->upload->display_errors();

                $msg = '<div class="alert alert-danger">Informasi pelaporan gagal diperbarui <br> <p>' . $upload_error . '</p> <small>Pada tanggal ' . date('d F Y H.i A') . '</small></div>';
                $this->session->set_flashdata('flash-data', $msg);
                redirect('C_data/edit/' . $id_lapor);
            } else {

                $new_photo = $this->upload->data('file_name');  // new file
                $dataLaporById = $this->db->get_where('lapor', ['id_lapor' => $id_lapor])->row();

                if ($dataLaporById->foto_tragedi) {

                    $data_foto = explode(',', $dataLaporById->foto_tragedi);

                    array_push($data_foto, $new_photo);

                    // implode  
                    if (count($data_foto) > 1) {

                        $photo = implode(',', $data_foto);
                    } else { // jika data foto hnaya 1

                        $photo = $new_photo;
                    }
                }
            }
        } else {

            $dataLaporById = $this->db->get_where('lapor', ['id_lapor' => $id_lapor])->row();
            $photo = $dataLaporById->foto_tragedi;
        }

        $data = [
            "id_kategori"   => $this->input->post('nama_kategori', true),
            "nama_lapor"    => $this->input->post('nama_lapor', true),
            "status_lapor"     => $this->input->post('status_lapor', true),
            "kecamatan"     => $this->input->post('kecamatan', true),
            "alamat"        => $this->input->post('alamat', true),
            "tgl_tragedi"   => $this->input->post('tgl_tragedi', true),
            "judul"     => $this->input->post('judul', true),
            "keterangan" => $this->input->post('keterangan', true),
            'foto_tragedi' => $photo
        ];

        $this->db->where('id_lapor', $id_lapor);
        $this->db->update('lapor', $data);

        $msg = '<div class="alert alert-info">Informasi pelaporan berhasil diperbarui <br><small>Pada tanggal ' . date('d F Y H.i A') . '</small></div>';
        $this->session->set_flashdata('flash-data', $msg);
        redirect('C_data/edit/' . $id_lapor);
    }

    public function hapusdatalpr($id)
    {
        $this->db->where('id_lapor', $id);
        $this->db->delete('lapor');
        redirect('C_data/index', 'refresh');
    }

    public function hapusdatausr($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
        redirect('C_data/indexuser', 'refresh');
    }
    public function datatabels()
    {
        $query = $this->db->order_by('id_lapor', 'ASC')->get('lapor');
        return $query->result();
    }

    function processExportPDF()
    {

        $this->load->library('pdf_laporan');


        // data lapor 
        $dataLapor = $this->getDataLapor();
        $sortDataLapor = array();


        // start + end
        $start = $this->input->get('start');
        $end = $this->input->get('end');

        $caption = "";
        if ($dataLapor['status'] == true) {

            foreach ($dataLapor['data'] as $row) {

                if ($start) { // apakah ada isinya ?

                    $tanggal_kejadian = date('Y-m-d', strtotime($row['tgl_tragedi']));

                    if ((strlen($end) == 0) && ($start == $tanggal_kejadian)) {

                        array_push($sortDataLapor, $row);
                        $caption = "Menampilkan laporan kejadian berdasarkan tanggal " . date('d F Y', strtotime($start));
                    } else if (($start == $end) && ($start == $tanggal_kejadian)) { // filter by start date

                        array_push($sortDataLapor, $row);
                        $caption = "Menampilkan laporan kejadian berdasarkan tanggal " . date('d F Y', strtotime($start));
                    } else if (($start <= $tanggal_kejadian) && ($end >= $tanggal_kejadian)) { // filter by range start date ... end date

                        array_push($sortDataLapor, $row);
                        $caption = "Menampilkan laporan kejadian berdasarkan tanggal " . date('d F Y', strtotime($start)) . ' sampai ' . date('d F Y', strtotime($end));
                    }
                } else {
                    // show all data without filter start date + end
                    array_push($sortDataLapor, $row);
                    $caption = "Menampilkan keseluruhan laporan kejadian";
                }
            }
        }




        $pdf = new Pdf_laporan('P', 'mm', 'A4', true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('BIDANG KEWASPADAAN DAERAH DAN PENANGANAN KONFLIK');
        $pdf->SetTitle('BAKESBANGPOL');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // // set default header data
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        // $pdf->setFooterData(array(0,64,0), array(0,64,128));

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
        $pdf->Cell(200, 10, "DAFTAR PELAPORAN KONDISI WILAYAH", 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);


        $table_body = "";
        if (count($sortDataLapor) > 0) {

            $nomor = 1;
            foreach ($sortDataLapor as $rowSort) {

                $table_body .= '<tr>
                        <td>' . $nomor . '</td>
                        <td>' . $rowSort['nama_lapor'] . '</td>
                        <td>' . $rowSort['judul'] . '</td>
                        <td>' . $rowSort['nama_kategori'] . '</td>
                        <td>' . $rowSort['kecamatan'] . '</td>
                        <td>' . $rowSort['keterangan'] . '</td>
                        <td>' . date('d/m/Y', strtotime($rowSort['tgl_tragedi'])) . '</td>
                    </tr>';

                $nomor++;
            }
        }


        $table = '<table width="100%" border="1" cellpadding="6">

                <tr>
                    <td width="5%">No</td>
                    <td width="15%">Nama Lapor</td>
                    <td width="15%">Judul</td>
                    <td width="15%">Kategori</td>
                    <td width="15%">Kecamatan</td>
                    <td width="20%">Keterangan</td>
                    <td width="15%">Tanggal</td>
                </tr>

                ' . $table_body . '
            </table>';


        $pdf->SetFont('', 'B', 10);
        $pdf->Cell(27, 10, "Laporan Kondisi Wilayah di Kota Malang 2021", 0, 1, 'L');

        $pdf->setFont('', 'B', 8);
        $pdf->Cell(27, 10, ucwords($caption), 0, 1, 'L');

        $pdf->writeHTML($table, true, false, true, false, '');
        $pdf->Output('LaporanKondisiWilayah.pdf');


        //============================================================+
        // END OF FILE
        //============================================================+
    }






    // remove photo
    function processRemovePhoto($id_lapor, $index)
    {


        $getDataLaporById = $this->db->get_where('lapor', ['id_lapor' => $id_lapor])->row();

        $data_photo = explode(',', $getDataLaporById->foto_tragedi);

        $new_photoupdate = array();
        for ($i = 0; $i < count($data_photo); $i++) {

            if ($i != $index) {

                array_push($new_photoupdate, $data_photo[$i]);
            }
        }

        $konversiComma = implode(',', $new_photoupdate);

        $dataUpdate = array(

            'foto_tragedi'  => $konversiComma
        );

        $this->db->where('id_lapor', $id_lapor);
        $this->db->update('lapor', $dataUpdate);

        redirect('C_data/edit/' . $id_lapor);


        /**
         * 
         *  kolom tb = img1, img 2, img 3 
         *  $data_photo = [img1, img2, img3]; 
         *  
         *  // Perulangan 1  | $i = 0; $index = 1;
         *  - apakah 0 < 3 ? 
         *     a. iya | apakah $i tidak sama dengan $index ? 
         *          -- iya maka foto index ke - i  (img1 masuk)
         *  
         *  // perulangan 2 | $i = 1; $index = 1; 
         *  - apakah 1 < 3 ? 
         *      a. iya | apakah $i tidak sama dengan $index ? 
         *          -- tidak maka foto index ke - i (img2 tidak masuk)
         * 
         *  // Perulangan 3 | $i = 2; $index = 1; 
         *  - apakah 2 < 3 ? 
         *      a. iya | apakah $i tidak sama dengan $index ? 
         *          -- iya maka foto index ke - i  (img3 masuk)
         * 
         *  // Perulangan 4 | $i = 3; $index = 1; 
         *  - apakah 3 < 3 ? 
         *      b. enggak | stop perulangan ... 
         * 
         * 
         *  // summary 
         *  nilai yang masuk = img1, img3
         * 
         * 
         *  update kolom foto yang di tabel ... 
         */
    }
}