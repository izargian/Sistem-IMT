<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        
        $this->db->select('user.id as id_user, user.nama, user.jenis, user.email, user.alamat, instansi.instansi, user.photo');
        $this->db->from('user');
        $this->db->join('instansi', 'user.code_instansi=instansi.id', 'right');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $user = $this->db->get();

        if ($user->num_rows() > 0) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $user->row()
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Email atau Password salah'
            ]);
        }
    }
}
