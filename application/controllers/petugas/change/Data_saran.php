<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_saran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->session->set_flashdata('not-login', 'Gagal!');
        if (!$this->session->userdata('email')) {
            redirect('welcome');
        }
    }

    public function tambah()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['status_ideal'] = $this->status_ideal();

        $data['view'] = 'petugas/data-saran/tambah';
        $this->load->view('petugas/template/template', $data);
    }

    public function insert()
    {
        // form validate
        $this->form_validation->set_rules('status_ideal', 'Satus Ideal', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        // cek form
        if ($this->form_validation->run() != true) {
            $this->session->set_flashdata('error', '
                <div class="alert alert-danger text-light" role="alert">
                    <strong>Error!</strong> Form harus diisi semua!
                </div>
            ');
            redirect(base_url('petugas/change/data_saran/tambah'));
        }

        $data = [
            'status_ideal' => $this->input->post('status_ideal'),
            'keterangan' => $this->input->post('keterangan'),
        ];
        $insert = $this->db->insert('data_saran', $data);

        if ($insert) {
            $this->session->set_flashdata('success', 'berhasil');
            redirect(base_url('petugas/petugas/data_saran'));
        } else {
            $this->session->set_flashdata('error', 'Data gagal ditambah!');
            redirect(base_url('petugas/petugas/data_saran'));
        }
    }

    public function edit($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['data_saran'] = $this->db->get_where('data_saran', ['id' => $id])->row();
        $data['status_ideal'] = $this->status_ideal();

        $data['view'] = 'petugas/data-saran/edit';
        $this->load->view('petugas/template/template', $data);
    }

    public function delete($id)
    {
        $this->db->delete('data_saran', array('id' => $id)); 
        if ($this->db->error()) {
            return $this->output->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil dihapus'
                    ]));
        }else{
            return $this->output->set_content_type('application/json')
                    ->set_status_header(500)
                    ->set_output(json_encode([
                        'status' => 'error',
                        'message' => 'Data gagal dihapus'
                    ]));
        }
    }

    public function lihat_saran()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        
        $data['data_saran'] = $this->db->get_where('data_saran', ['status_ideal' => $this->input->get('status_ideal')])->result();

        $data['view'] = 'petugas/data-saran/lihat_saran';
        $this->load->view('petugas/template/template', $data);

    }

    public function status_ideal()
    {
        $status_ideal = [
            [
                'status_ideal' => 'Kurus',
            ],
            [
                'status_ideal' => 'Normal',
            ],
            [
                'status_ideal' => 'Kegemukan',
            ],
            [
                'status_ideal' => 'Obesitas',
            ],

        ];
        return $status_ideal;
    }
}