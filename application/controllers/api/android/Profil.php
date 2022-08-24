<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {        
        $this->db->select('user.id as id_user, user.nama, user.jenis, user.email, user.alamat, instansi.instansi, user.photo');
        $this->db->from('user');
        $this->db->join('instansi', 'user.code_instansi=instansi.id');
        $this->db->where('user.id', $this->input->get('id'));
        $user = $this->db->get();

        if ($user) {
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
