<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
defined('BASEPATH') or exit('No direct script access allowed');

class Rfid extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->helper('url');
        $this->load->library('form_validation');
        // $this->session->set_flashdata('not-login', 'Gagal!');
        // if (!$this->session->userdata('email')) {
        //     redirect('welcome');
        // }
    }

    public function index()
    {
        $data = [
            'value' => $this->input->get('value'),
        ];
        $insert = $this->db->insert('rfid', $data);
        if ($insert) {
            echo json_encode([
                'status' => 'success',
                'massage' => 'Data berhasil di simpan.',
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'massage' => 'Data Gagal di simpan.',
            ]);
        }
    }

    public function cek_member()
    {
        $id_rfid = $this->input->get('rfid');
        $cek = $this->db->get_where('member', array('id_rfid' => $id_rfid));
        if ($cek) {
            echo json_encode([
                'status' => 'success',
                'data' => $cek->row()
            ]);
        }
    }
}
