<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instansi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {        
        $this->db->select('instansi.id as id_instansi, instansi.instansi, instansi.alamat, instansi.code_instansi');
        $this->db->from('instansi');
        $instansi = $this->db->get();

        if ($instansi) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $instansi->result()
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
