<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
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
            $this->_loadLoginPage();
        } else {
            $this->_login();
        }
    }

    private function _loadLoginPage()
    {
        $data['judul'] = 'Halaman Login Administrator';
        $data['user'] = '';
        $this->load->view('templates/templates-admin/autentfikasi-header', $data);
        $this->load->view('administrator/login');
        $this->load->view('templates/templates-admin/autentfikasi-footer');
    }

    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);
        // $user = $this->M_User->getUserData(['user_email' => $email])->row_array();


        $user = $this->db->get_where('tbl_user', ['user_email' => $email])->row_array();


        if ($user) {
            if ($user['user_status'] == 1) {
                if ($password === $user['user_password']) {
                    // if (password_verify($password, $user['user_password'])) {
                    $data = [
                        'user_email' => $user['user_email'],
                        'user_level' => $user['user_level']
                    ];
                    $this->session->set_userdata($data);
                    redirect('Administrator/dashboard');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>');
                    redirect('Administrator');
                }
                // redirect('Administrator/dashboard');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">User belum diaktifasi!!</div>');
                redirect('Administrator');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar!!</div>');
            redirect('Administrator');
        }
    }

    public function dashboard()
    {
        $data['judul'] = 'Dashboard | Portal Berita UBSI';
        $data['user'] = $this->M_User->getUserData(['user_email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/templates-admin/autentfikasi-header', $data);
        $this->load->view('administrator/login');
        $this->load->view('templates/templates-admin/autentfikasi-footer');
    }
}
