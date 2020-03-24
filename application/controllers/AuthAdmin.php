<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthAdmin extends CI_Controller
{
    public function index()
    {
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email', [
            'required' => 'Email Harus diisi!!',
            'valid_email' => 'Email Tidak Benar!!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password Harus diisi'
        ]);
        if ($this->form_validation->run() == false) {
            $data['judul-halaman'] = 'Login Administrator';
            $data['user'] = '';
            $this->load->view('templates/admin/auth-header', $data);
            $this->load->view('administrator/login');
            $this->load->view('templates/admin/auth-footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $user_email = htmlspecialchars($this->input->post('email', true));
        $user_password = $this->input->post('password', true);
        $user = $this->User_Model->cekData(['user_email' => $user_email])->row_array();
        if ($user) {
            if ($user['user_status'] == 1) {
                if (password_verify($user_password, $user['user_password'])) {
                    $data = [
                        'email' => $user['user_email'],
                        'role_id' => $user['user_level']
                    ];

                    $this->session->set_userdata($data);
                    redirect('Admin');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>');
                    redirect('AuthAdmin');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">User belum diaktifasi!!</div>');
                redirect('AuthAdmin');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar!!</div>');
            redirect('AuthAdmin');
        }
    }
}


// ubah di line 61 jadi gini
$autoload['libraries'] = array('form_validation', 'session', 'database');


// ubah di line 91 jadi gini
$autoload['helper'] = array('url');


// ubah di line 135 jadi gini
$autoload['model'] = array('Model_User');
