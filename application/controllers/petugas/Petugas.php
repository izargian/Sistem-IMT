<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->session->set_flashdata('not-login', 'Gagal!');
        if (!$this->session->userdata('email') && $this->session->userdata('jenis') != 'Petugas') {
            redirect('welcome');
        }
    }

    public function dashboard()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['total_pengukuran'] = $this->db->get('data-imt')->num_rows();
        $data['total_member'] = $this->db->get('member')->num_rows();
        $data['total_instansi'] = $this->db->get('instansi')->num_rows();
        $data['total_user'] = $this->db->get('user')->num_rows();

        $data['view'] = 'petugas/dashboard';
        // echo json_encode($this->session->userdata('jenis'));
        $this->load->view('petugas/template/template', $data);
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

        $data['view'] = 'petugas/data-imt/index';
        // echo json_encode($data['data_imt']);
        $this->load->view('petugas/template/template', $data);
    }

    public function data_member_teknisi()
    {
        $this->load->model('m_imt');

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['data_member'] = $this->m_imt->tampil_data_member()->result();

        $data['view'] = 'petugas/data-member/index';

        $this->load->view('petugas/template/template', $data);
    }

    public function tambah_data_imt()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $sql_berat_badan = $this->db->get('pengukuran_berat_badan')->result();
        $sql_tinggi_badan = $this->db->get('pengukuran_tinggi_badan')->result();
        $sql_rfid = $this->db->get('rfid')->result();
        $berat_badan = [];
        foreach ($sql_berat_badan as $value) {
            $berat_badan = $value->value;
        }
        $tinggi_badan = [];
        foreach ($sql_tinggi_badan as $values) {
            $tinggi_badan = $values->value;
        }
        $rfid = [];
        foreach ($sql_rfid as $values) {
            $rfid = $values->value;
        }
        $data['berat_badan'] = $berat_badan;
        $data['tinggi_badan'] = $tinggi_badan;
        $data['rfid'] = $rfid;

        $data['view'] = 'petugas/data-imt/tambah';
        $this->load->view('petugas/template/template', $data);
    }

    public function insert()
    {
        $cek = $this->db->get_where('member', array('id_rfid' => $this->input->post('rf_id')));
        if ($cek->num_rows() > 0) {

            // form validate
            $this->form_validation->set_rules('berat_badan', 'Berat badan', 'required');
            $this->form_validation->set_rules('tinggi_badan', 'Tinggi Badan', 'required');
            $this->form_validation->set_rules('rf_id', 'Rfid', 'required');

            // cek form
            if ($this->form_validation->run() != true) {
                $this->session->set_flashdata('error', '
                    <div class="alert alert-danger text-light" role="alert">
                        <strong>Error!</strong> Form harus diisi semua!
                    </div>
                ');
                redirect(base_url('petugas/petugas/tambah_data_imt'));
            }

            $cek_member = $this->db->get_where('member', array('id_rfid' => $this->input->post('rf_id')));
            if ($cek_member->num_rows() > 0) {
                $id_member = $cek_member->row();
                $data = [
                    'id_member' => $id_member->id,
                    'tinggi_badan' => $this->input->post('tinggi_badan'),
                    'berat_badan' => $this->input->post('berat_badan'),
                    'usia' => '20',
                    'created' => date('Y-m-d'),
                ];
                $insert = $this->db->insert('data-imt', $data);
            } else {
                $data = [
                    'id_rfid' => $this->input->post('rf_id'),
                    'nama' => $this->input->post('nama'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'code_instansi' => $this->input->post('code_instansi'),
                ];
                $this->db->insert('member', $data);
                $id_member = $this->db->insert_id();
                $data_member = [
                    'id_member' => $id_member,
                    'tinggi_badan' => $this->input->post('tinggi_badan'),
                    'berat_badan' => $this->input->post('berat_badan'),
                    'usia' => '20',
                    'created' => date('Y-m-d'),
                ];
                $insert = $this->db->insert('data-imt', $data_member);
            }

            if ($insert) {
                $this->session->set_flashdata('success', 'Data berhasil ditambah!');
                redirect(base_url('petugas/petugas/data_imt_teknisi'));
            } else {
                $this->session->set_flashdata('error', 'Data gagal ditambah!');
                redirect(base_url('petugas/petugas/tambah_data_imt'));
            }
        } else {
            $this->form_validation->set_rules('berat_badan', 'Berat badan', 'required');
            $this->form_validation->set_rules('tinggi_badan', 'Tinggi Badan', 'required');
            $this->form_validation->set_rules('rf_id', 'Rfid', 'required');
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
            $this->form_validation->set_rules('code_instansi', 'Code Instansi', 'required');

            if ($this->form_validation->run() != true) {
                $this->session->set_flashdata('error', '
                    <div class="alert alert-danger text-light" role="alert">
                        <strong>Error!</strong> Form harus diisi semua!
                    </div>
                ');
                redirect(base_url('petugas/petugas/tambah_data_imt'));
            }
            
            $cek_member = $this->db->get_where('member', array('id_rfid' => $this->input->post('rf_id')));
            if ($cek_member->num_rows() > 0) {
                $id_member = $cek_member->row();
                $data = [
                    'id_member' => $id_member->id,
                    'tinggi_badan' => $this->input->post('tinggi_badan'),
                    'berat_badan' => $this->input->post('berat_badan'),
                    'usia' => '20',
                    'created' => date('Y-m-d'),
                ];
                $insert = $this->db->insert('data-imt', $data);
            } else {
                $data = [
                    'id_rfid' => $this->input->post('rf_id'),
                    'nama' => $this->input->post('nama'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'code_instansi' => $this->input->post('code_instansi'),
                ];
                $this->db->insert('member', $data);
                $id_member = $this->db->insert_id();
                $data_member = [
                    'id_member' => $id_member,
                    'tinggi_badan' => $this->input->post('tinggi_badan'),
                    'berat_badan' => $this->input->post('berat_badan'),
                    'usia' => '20',
                    'created' => date('Y-m-d'),
                ];
                $insert = $this->db->insert('data-imt', $data_member);
            }

            if ($insert) {
                $this->session->set_flashdata('success', 'Data berhasil ditambah!');
                redirect(base_url('petugas/petugas/data_imt_teknisi'));
            } else {
                $this->session->set_flashdata('error', 'Data gagal ditambah!');
                redirect(base_url('petugas/petugas/tambah_data_imt'));
            }
        }
    }

    public function data_saran()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['data_saran'] = $this->db->get('data_saran')->result();

        $data['view'] = 'petugas/data-saran/index';
        $this->load->view('petugas/template/template', $data);
    }
}
