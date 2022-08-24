<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_imt_teknisi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // $this->load->helper('url');
        $this->load->library('form_validation');
        $this->session->set_flashdata('not-login', 'Gagal!');
        if (!$this->session->userdata('email')) {
            redirect('login');
        }
    }

    public function detail_teknisi_imt($id)
    {
        $this->load->model('m_imt');
        $where = array('id' => $id);
        $detail = $this->m_imt->detail_member($id);
        $data['detail'] = $detail;

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['data_pengukuran'] = $this->m_imt->tampil_data_pengukuran()->result();

        $data['view'] = 'pemerintah/data-imt/detail_teknisi_imt';

        $this->load->view('pemerintah/template/template', $data);
    }
    
    public function update_teknisi_imt($id)
    {
        $this->load->model('m_imt');

        $where = array('id' => $id);

        $this->db->select('data-imt.id, data-imt.tinggi_badan, data-imt.berat_badan, data-imt.usia, data-imt.created, member.id_rfid, member.nama, member.jenis_kelamin');
        $this->db->from('data-imt');
        $this->db->join('member', 'data-imt.id_member=member.id');
        $this->db->where('data-imt.id', $id);
        $data_imt = $this->db->get();
        $data['data_imt'] = $data_imt->row();

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['view'] = 'pemerintah/data-imt/update_teknisi_imt';

        $this->load->view('pemerintah/template/template', $data);
    }

    public function teknisi_imt_edit()
    {
        $this->load->model('m_imt');

        $data = array(
            'tinggi_badan' => $this->input->post('tinggi_badan'),
            'berat_badan' => $this->input->post('berat_badan'),
            'usia' => $this->input->post('usia'),
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('data-imt', $data);

        $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Berhasil ubah data IMT</div>');        
        redirect('pemerintah/pemerintah/data_imt_pemerintah');
    }

    public function delete_teknisi_imt($id)
    {
        $this->db->delete('data-imt', array('id' => $id)); 
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
}
