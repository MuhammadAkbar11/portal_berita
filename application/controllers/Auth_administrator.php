<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_administrator extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('admin');
        }
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email', [
            'required' => 'Email Harus diisi!!',
            'valid_email' => 'Email Tidak Benar!!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password Harus diisi'
        ]);
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Login';
            $data['user'] = '';
            $this->load->view('templates/header', $data);
            $this->load->view('administrator/login');
            $this->load->view('templates/footer');
        } else {
            $this->login();
        }
    }

    public function login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);
        $user = $this->Modeluser->cekData(['user_email' => $email])->row_array();

        if ($user) {
            if ($user['user_status'] == 1) {
                if (password_verify($password, $user['user_password'])) {
                    $data = [
                        'user_email' => $user['user_email'],
                        'user_level' => $user['user_level']
                    ];
                    $this->session->set_userdata($data);
                    redirect('Dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>');
                    redirect('Auth_administrator');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message" role="alert">User belum diaktifasi!!</div>');
                redirect('Auth_administrator');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar!!</div>');
            redirect('Auth_administrator');
        }
    }
}
