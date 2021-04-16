<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {

        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Badan Kesatuan Bangsa Dan Politik';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('Auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validation succes
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $adm = $this->db->get_where('user', ['email' => $email])->row_array();

        // user Ready 
        if ($adm) {
            // User Active
            if ($adm['is_active'] == 1) {
                //check password
                if (password_verify($password, $adm['password'])) {
                    $data = [
                        'sess_id' => $adm['id_user'],
                        'email' => $adm['email'],
                        'role_id' => $adm['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($adm['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('Profile');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Wrong Password !
				  </div>');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				This Email Has Not Been Activated !
			  </div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Email Not Registerd !
		  </div>');
            redirect('Auth');
        }
    }

    public function registration()
    {

        if ($this->session->userdata('email')) {
            redirect('profile');
        }
        $this->form_validation->set_rules('nama_lengkap', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Name', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Gender', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'Telp', 'required|trim|is_unique[user.no_telp]', ['is_unique' => 'This phone Already Registered!']);
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[user.email]',
            ['is_unique' => 'This Email Already Registered!']
        );
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[8]|matches[password2]',
            [
                'matches' => 'Password Dont Match!',
                'min_length' => 'Password Dont Short!'
            ]
        );
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Badan Kesatuan Bangsa Dan Politik';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('Auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'username' => htmlspecialchars($this->input->post('username')),
                'email' => htmlspecialchars($email),
                'no_telp' => htmlspecialchars($this->input->post('no_telp')),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap')),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin')),
                'is_active' => 0,
                'foto' => 'default.jpg',
                'role_id' => 2,
                'date_created' => time()
            ];

            //Token 

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Congratulation! Your account has been created.please Login Activated Your Account At Gmail.
			</div>');
            redirect('Auth');
        }
    }


    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'bakesbangmalang@gmail.com',
            'smtp_pass' => 'luvia1505',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);  //tambahkan baris ini

        $this->email->from('bakesbangmalang@gmail.com', 'Bakesbang Kota Malang');
        $this->email->to($this->input->post('email'));


        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click verification 
			<a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        } else if ($type == 'forget') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
                    redirect('Auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);


                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
						Activation Failed , Token Expired! 
					</div>');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Activation Failed , Wrong Token! 
		  </div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Activation Failed, WRONG Email :) ! 
		  </div>');
            redirect('Auth');
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			You have been logged out!
		  </div>');
        redirect('Auth');
    }

    public function blocked()
    {
        $this->load->view('Auth/blocked');
    }

    public function forgetpassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forget Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('Auth/forget', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('
			
			user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forget');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
                redirect('Auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Email Not Registered or Activated !
		  </div>');
                redirect('Auth');
            }
        }
    }


    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
            redirect('Auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('Auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[8]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('Auth/change');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->db->delete('user_token', ['email' => $email]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
            redirect('Auth');
        }
    }
}