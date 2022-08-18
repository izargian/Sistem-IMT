<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // $this->load->helper('url');
        $this->load->library('form_validation');
        $this->session->set_flashdata('not-login', 'Gagal!');
        if (!$this->session->userdata('email') && $this->session->userdata('jenis') != 'Admin') {
            redirect('welcome');
        }
    }

    public function dashboard()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['view'] = 'admin/dashboard';
        
        $this->load->view('admin/template/template', $data);
    }


	public function data_imt_teknisi()
    {
        $this->load->model('m_imt');

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->db->select('data-imt.id, data-imt.tinggi_badan, data-imt.berat_badan, data-imt.usia, data-imt.created, member.id_rfid, member.nama, member.jenis_kelamin');
        $this->db->from('data-imt');
        $this->db->join('member', 'data-imt.id_member=member.id');
        $data_imt = $this->db->get();
        $data['data_imt'] = $data_imt->result();
        // echo json_encode($data['data_imt']);
        $data['view'] = 'admin/data-imt/index';

        $this->load->view('admin/template/template', $data);
    }   
}
