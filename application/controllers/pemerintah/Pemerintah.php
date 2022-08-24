<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemerintah extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // $this->load->helper('url');
        $this->load->library('form_validation');
        $this->session->set_flashdata('not-login', 'Gagal!');
        if (!$this->session->userdata('email')) {
            redirect('welcome');
        }
    }

    public function dashboard()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['view'] = 'pemerintah/dashboard';
        
        $this->load->view('pemerintah/template/template', $data);
    }


	public function data_imt_pemerintah()
    {
        $this->load->model('m_imt');

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->db->select('data-imt.id, data-imt.tinggi_badan, data-imt.berat_badan, data-imt.usia, data-imt.created, member.id_rfid, member.nama, member.jenis_kelamin');
        $this->db->from('data-imt');
        $this->db->join('member', 'data-imt.id_member=member.id');
        $data_imt = $this->db->get();
        $data['data_imt'] = $data_imt->result();

        $data['view'] = 'pemerintah/data-imt/index';

        $this->load->view('pemerintah/template/template', $data);
    }

   
}
