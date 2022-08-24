<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teknisi extends CI_Controller {

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

        $data['total_pengukuran'] = $this->db->get('data-imt')->num_rows();
        $data['total_member'] = $this->db->get('member')->num_rows();
        $data['total_instansi'] = $this->db->get('instansi')->num_rows();
        $data['total_user'] = $this->db->get('user')->num_rows();

        $data['view'] = 'teknisi/dashboard';
        
        $this->load->view('teknisi/template/template', $data);
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

        $data['view'] = 'teknisi/data-imt/index';

        $this->load->view('teknisi/template/template', $data);
    }
	
    public function data_user_teknisi()
    {
        $this->load->model('m_imt');

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['data_user'] = $this->db->get_where('user', array('id !=' => $this->session->userdata('id')))->result();

        $data['view'] = 'teknisi/data-user/index';
        $this->load->view('teknisi/template/template', $data);
    }
    
    public function data_instansi_teknisi()
    {
        $this->load->model('m_imt');

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['data_instansi'] = $this->m_imt->tampil_data_instansi()->result();

        $data['view'] = 'teknisi/data-instansi/index';

        $this->load->view('teknisi/template/template', $data);
    }
    
    public function data_member_teknisi()
    {
        $this->load->model('m_imt');

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['data_member'] = $this->m_imt->tampil_data_member()->result();
        
        $data['view'] = 'teknisi/data-member/index';

        $this->load->view('teknisi/template/template', $data);
    }

	

    

    public function detail_teknisi_imt($id)
    {
        $this->load->model('m_imt');
        $where = array('id_skpi' => $id);
        $detail = $this->m_imt->detail_imt($id);
        $data['detail'] = $detail;
        $this->load->view('teknisi/detail_teknisi_imt', $data);
    }


    public function update_teknisi_imt($id)
    {
        $this->load->model('m_imt');
        $where = array('id_skpi' => $id);
        $data['data_skpi'] = $this->m_imt->update_imt($where, 'mahasiswa')->result();
        $this->load->view('teknisi/update_teknisi_imt', $data);
    }

    public function teknisi_imt_edit()
    {
        $this->load->model('m_imt');

        $id = $this->input->post('id_skpi');
        $tgl_upload = $this->input->post('tgl_upload');
        $nim = $this->input->post('nim');
        $nama_file = $this->input->post('nama_file');
        $nama_prestasi = $this->input->post('nama_prestasi');
        $gambar = $_FILES['image']['name'];

        $data = array(
            'tgl_upload' => $tgl_upload,
            'nim' => $nim,
            'nama_prestasi' => $nama_prestasi,
            'nama_file' => $nama_file,
        );

        $config['allowed_types'] = 'jpg|png|gif|jfif';
        $config['max_size'] = '9096';
        $config['upload_path'] = './assets/profile_picture';

        $this->load->library('upload', $config);
        //berhasil
        if ($this->upload->do_upload('image')) {
            $gambarLama = $data['user']['image'];
            if ($gambarLama != 'default.jpg') {
                unlink(FCPATH . '/assets/profile_picture/' . $gambarLama);
            }
            $gambarBaru = $this->upload->data('file_name');
            $this->db->set('image', $gambarBaru);
        } else {
            echo $this->upload->display_errors();
        }

        $where = array(
            'id_skpi' => $id,
        );

        $this->m_imt->update_data($where, $data, 'mahasiswa');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('teknisi');
    }

    public function delete_teknisi_imt($id)
    {
        $this->load->model('m_imt');
        $where = array('id_skpi' => $id);
        $this->m_imt->delete_imt($where, 'mahasiswa');
        $this->session->set_flashdata('skpi-delete', 'berhasil');
        redirect('teknisi');
    }


    public function tambah_teknisi_imt()
    {
        $this->form_validation->set_rules('nim', 'nim', 'required|trim|min_length[9]', [
            'required' => 'Harap NIM mahsiswa anda.',
            'min_length' => 'NIM terlalu pendek.',
        ]);
        $this->form_validation->set_rules('nama_prestasi', 'nama_prestasi', 'required|trim', [
            'required' => 'Harap isi kolom Prestasi.',
        ]);
        $this->form_validation->set_rules('nama_file', 'nama_file', 'required|trim', [
            'required' => 'Harap isi kolom File.',
        ]);

        if ($this->form_validation->run() == false) {

            $this->load->view('teknisi/tambah_teknisi_imt');

        } else {
            $image = $_FILES['image']['name'];
            $data = [
                'nim' => htmlspecialchars($this->input->post('nim', true)),
                'nama_prestasi' => htmlspecialchars($this->input->post('nama_prestasi', true)),
                'nama_file' => htmlspecialchars($this->input->post('nama_file', true)),
                'image' => htmlspecialchars($image),
                
            ];

            $config['allowed_types'] = 'jpg|png|gif|jfif';
        $config['max_size'] = '9096';
        $config['upload_path'] = './assets/profile_picture';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('image')) {
           
            
            $gambarBaru = $this->upload->data('file_name');
            $this->db->set('image', $gambarBaru);
        } else {
            echo $this->upload->display_errors();
        }

            $this->db->insert('mahasiswa', $data);
           
            $this->session->set_flashdata('success-upload', 'berhasil');
            redirect(base_url('teknisi'));
        }
    }
}
