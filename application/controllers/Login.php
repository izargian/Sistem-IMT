<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
    }



    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required', [
            'required' => 'Harap isi bidang username anda!',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Harap isi bidang password!',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('sign-in');
        } else {
            //validasi sukses
            // $this->userlogin();

            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));

            $user = $this->db->get_where('user', ['email' => $email, 'password' => $password])->row_array();

            // echo json_encode($user);

            if ($user) {
                $data = [
                    'id' => $user['id'],
                    'nama' => $user['nama'],
                    'email' => $user['email'],
                    'jenis' => $user['jenis'],
                    'photo' => $user['photo'],
                ];


                $this->session->set_userdata($data);
                if ($user['jenis'] == 'Teknisi') {
                    // $kode_jurusan = $this->M_kaprodi->get_kaprodi($username);
                    // $this->session->set_userdata('kode_jurusan', $kode_jurusan);

                    redirect(base_url('teknisi/teknisi/dashboard'));
                } else if ($user['jenis'] == 'Petugas') {
                    redirect(base_url('petugas/petugas/dashboard'));
                } else if ($user['jenis'] == 'Admin') {
                    redirect(base_url('admin/admin/dashboard'));
                } else {
                    redirect(base_url('pemerintah/pemerintah/dashboard'));
                }
                //cek password
                // if (password_verify($password, $user['password'])) {

                // } else {
                //     $this->session->set_flashdata('fail-pass', 'Gagal!');
                //     redirect(base_url('welcome/user'));
                // }
            } else {
                $this->session->set_flashdata('login-gagal', 'Email atau password anda tidak sesuai!');
                redirect(base_url('login'));
            }
        }
    }

    private function userlogin()
    {
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->set_flashdata('success-logout', 'Berhasil!');
        redirect(base_url('welcome'));
    }
}
