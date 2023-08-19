<?php
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
        $code = $this->input->get('code');
        if ($code != null) {
            // $userId = $this->M_imt->userByCode($code);
            $userId = $this->db->get_where('user', array('code_alat' => $code))->row();
            if ($userId == null) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'data user belum terdafar'
                ]);
                return;
            }
            $userId = $userId->id;
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'proses gagal'
            ]);
            return;
        }

        $data = [
            'value' => $this->input->get('value'),
            'user_id' => $userId
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
