<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_lapor_user extends CI_Model
{


    // get data category
    function getDataCategory()
    {

        return $this->db->get('kategori');
        // SELECT * FROM kategori
    }



    // process insert data report (butuh penggabungan session dari lusi)
    function processInsertData()
    {

        $foto = "";

        $id_user = $this->session->userdata('sess_id');


        $dataUploaded = array();
        $dataError    = array();


        for ($i = 0; $i < count($_FILES['foto_tragedi']['name']); $i++) {

            $_FILES['foto_tragedi[]']['name']     = $_FILES['foto_tragedi']['name'][$i];
            $_FILES['foto_tragedi[]']['type']     = $_FILES['foto_tragedi']['type'][$i];
            $_FILES['foto_tragedi[]']['tmp_name']  = $_FILES['foto_tragedi']['tmp_name'][$i];
            $_FILES['foto_tragedi[]']['error']     = $_FILES['foto_tragedi']['error'][$i];
            $_FILES['foto_tragedi[]']['size']     = $_FILES['foto_tragedi']['size'][$i];


            // name = variable.jpg 
            // type = .jpg 
            // alamat memori
            // error file
            // 52 kb

            $config['upload_path']          = './assets/images/'; // direktori lokal
            $config['allowed_types']        = 'jpeg|jpg|png'; // ekstensi
            $config['max_size']             = 3000; // 3 mb

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // check data upload 
            if (!$this->upload->do_upload('foto_tragedi[]')) {

                array_push($dataError, array(

                    'name'  => $_FILES['foto_tragedi']['name'][$i],
                    'error' => $this->upload->display_errors()
                ));
            } else {

                array_push($dataUploaded, $this->upload->data('file_name'));
            }
        }

        // sesi insert
        if (count($dataError) > 0) { // upload error



            $file_gagalupload = "";
            foreach ($dataError as $row) {

                $file_gagalupload .= '<p>- ' . $row['name'] . ' <br> ' . $row['error'] . '</p>';
            }

            $pesan = '<div class="alert alert-danger">Pemberitahuan <br> ' . $file_gagalupload . '</div>';
            $this->session->set_flashdata('msg', $pesan);

            redirect('C_report');
        } else {

            $foto = implode(',', $dataUploaded);
        }


        $data = array(

            'id_kategori'   => $this->input->post('kategori'),
            'id_user'       => $id_user,
            'status_lapor'  => "diperiksa",
            'nama_lapor'    => $this->input->post('nama_lapor'),
            'kecamatan'     => $this->input->post('kecamatan'),
            'alamat'        => $this->input->post('alamat'),
            'tgl_tragedi'   => $this->input->post('tgl_tragedi'),
            'judul'         => $this->input->post('judul'),
            'keterangan'    => $this->input->post('keterangan'),
            'foto_tragedi'  => $foto
        );

        // execute
        $this->db->insert('lapor', $data);

        $pesan = '<div class="alert alert-info">Data Berhasil Disimpan! </div>';


        $this->session->set_flashdata('msg', $pesan);
        redirect('C_report/index');
    }
}