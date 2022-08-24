<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {        
        $this->db->select('member.id as id_pasien, member.id_rfid, member.nama, member.jenis_kelamin, member.tgl_lahir, instansi.instansi');
        $this->db->from('member');
        $this->db->join('instansi', 'member.code_instansi=instansi.id');
        $member = $this->db->get();

        if ($member) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $member->result()
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Email atau Password salah'
            ]);
        }
    }

    public function detail()
    {        
        // detail member
        $this->db->select('member.id as id_pasien, member.id_rfid, member.nama, member.jenis_kelamin, member.tgl_lahir, instansi.instansi');
        $this->db->from('member');
        $this->db->join('instansi', 'member.code_instansi=instansi.id');
        $this->db->where('member.id', $this->input->get('id'));
        $member = $this->db->get();

        // detail pengukuran berdasarkan member
        $this->db->select('*');
        $this->db->from('data-imt');
        $this->db->join('member', 'data-imt.id_member=member.id');
        $this->db->where('data-imt.id_member', $this->input->get('id'));
        $data_imt = $this->db->get();

        if ($member) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $member->row(),
                'pengukuran' => $data_imt->result(),
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
