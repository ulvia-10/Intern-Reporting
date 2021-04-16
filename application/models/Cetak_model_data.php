<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Cetak_model_data extends CI_Model {
        public function view()
        {
            $this->db->select('nama,id_siswa,umur,agama,tgl_lahir,alamat,gender,nama_ortu,jurusan');
            return $this->db->get('lapor')->result_array();
        }
    
        public function getdatabyID($id){
            return $this->db->get_where('lapor', array('id_lapor' => $id))->result();
            
        }

   }
?>