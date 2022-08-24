<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_user_teknisi extends CI_Controller
{

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

    public function role()
    {
        $role = [
            ['jenis' => 'Petugas'],
            ['jenis' => 'Teknisi'],
            ['jenis' => 'Pemerintah'],
            ['jenis' => 'Admin'],
        ];
        return $role;
    }

    public function update_teknisi_user($id)
    {
        $this->load->model('m_imt');

        $where = array('id' => $id);

        $data['data_user'] = $this->m_imt->update_imt($where, 'user')->result();
        $data['role'] = $this->role();
        $data['instansi'] = $this->db->get('instansi')->result();

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['view'] = 'pemerintah/data-user/update_teknisi_user';

        $this->load->view('pemerintah/template/template', $data);
    }

    public function edit_teknisi_user()
    {
        $this->load->model('m_imt');

        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $code_instansi = $this->input->post('code_instansi');
        $jenis = $this->input->post('jenis');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $alamat = $this->input->post('alamat');

        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '9096';
        $config['upload_path'] = './assets/profile_picture';

        $this->load->library('upload', $config);
        //berhasil
        if ($this->upload->do_upload('photo')) {
            $cek_gambar = $this->db->get_where('user', array('id' => $id));
            if ($cek_gambar->num_rows() > 0) {
                $data = $cek_gambar->row();
                $gambarLama = $data->photo;
                unlink(FCPATH . '/assets/profile_picture/' . $gambarLama);
            }
            $gambarBaru = $this->upload->data('file_name');
            $this->db->set('photo', $gambarBaru);

            if ($password == "") {
                $data = array(
                    'code_instansi' => $code_instansi,
                    'nama' => $nama,
                    'email' => $email,
                    'alamat' => $alamat,
                    'jenis' => $jenis,
                    'photo' => $gambarBaru,
                );
            }else{
                $data = array(
                    'code_instansi' => $code_instansi,
                    'nama' => $nama,
                    'email' => $email,
                    'password' => $password,
                    'alamat' => $alamat,
                    'jenis' => $jenis,
                    'photo' => $gambarBaru,
                );
            }
        } else {
            echo $this->upload->display_errors();
            if ($password == "") {
                $data = array(
                    'code_instansi' => $code_instansi,
                    'nama' => $nama,
                    'email' => $email,
                    'alamat' => $alamat,
                    'jenis' => $jenis,
                );
            }else{
                $data = array(
                    'code_instansi' => $code_instansi,
                    'nama' => $nama,
                    'email' => $email,
                    'password' => $password,
                    'alamat' => $alamat,
                    'jenis' => $jenis,
                );
            }
        }

        $where = array(
            'id' => $id,
        );

        $this->m_imt->update_data($where, $data, 'user');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('pemerintah/pemerintah/dashboard');
    }
}