<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['adm'] = $this->db->get_where('user', ['email' =>  $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['adm'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('username', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'Telepon', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('profile/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $nama_lengkap = $this->input->post('nama_lengkap');
            $name = $this->input->post('username');
            $email = $this->input->post('email');
            $gender = $this->input->post('jenis_kelamin');
            $telp = $this->input->post('no_telp');

            // image upload
            $upload_image = $_FILES['image']['name'];
            //ada gambar yg di upload
            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile1/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['adm']['foto'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile1/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('foto', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            //set write profiile
            $this->db->set('nama_lengkap', $nama_lengkap);
            $this->db->set('username', $name);
            $this->db->set('no_telp', $telp);
            //readonly
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Your Profile Have Been Update !
          </div>');
            redirect('profile');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['adm'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('profile/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['adm']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('profile/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('profile/changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('profile/changepassword');
                }
            }
        }
    }
}