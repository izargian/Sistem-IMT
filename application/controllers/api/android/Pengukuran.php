<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengukuran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $this->db->select('data-imt.id, member.nama, member.id_rfid');
        $this->db->from('data-imt');
        $this->db->join('member', 'data-imt.id_member=member.id');
        $data_pengukuran = $this->db->get();

        if ($data_pengukuran) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $data_pengukuran->result()
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Data tidak tersedia'
            ]);
        }
    }

    public function detail()
    {
        $this->db->select('data-imt.id, data-imt.tinggi_badan, data-imt.berat_badan, data-imt.usia, data-imt.created, member.nama, member.id_rfid');
        $this->db->from('data-imt');
        $this->db->join('member', 'data-imt.id_member=member.id');
        $this->db->where('data-imt.id', $this->input->get('id'));
        $detail_pengukuran = $this->db->get();

        if ($detail_pengukuran) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $detail_pengukuran->row()
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Data tidak tersedia'
            ]);
        }
    }

    public function hapus()
    {
        $this->db->delete('data-imt', array('id' => $this->input->get('id')));
        if ($this->db->error()) {
            return $this->output->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode([
                    'status' => 'success',
                    'message' => 'Data berhasil dihapus'
                ]));
        } else {
            return $this->output->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Data gagal dihapus'
                ]));
        }
    }
}
