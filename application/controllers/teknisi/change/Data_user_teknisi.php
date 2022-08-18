<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_user_teknisi extends CI_Controller {

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

    public function detail_teknisi_user($id)
    {
        $this->load->model('m_imt');
        $where = array('id' => $id);
        $detail = $this->m_imt->detail_user($id);
        $data['detail'] = $detail;

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['view'] = 'teknisi/data-user/detail_teknisi_user';

        $this->load->view('teknisi/template/template', $data);
    }


    public function update_teknisi_user($id)
    {
        $this->load->model('m_imt');

        $where = array('id' => $id);

        $data['data_user'] = $this->m_imt->update_imt($where, 'user')->result();

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['view'] = 'teknisi/data-user/update_teknisi_user';

        $this->load->view('teknisi/template/template', $data);
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
         $gambar = $_FILES['photo']['name'];

        $data = array(
            'code_instansi' => $code_instansi,
            'nama' => $nama,
            'email' => $email,
            'password' => $password,
            'alamat' => $alamat,
            'jenis' => $jenis,
        );

        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '9096';
        $config['upload_path'] = './assets/profile_picture';

        $this->load->library('upload', $config);
        //berhasil
        if ($this->upload->do_upload('photo')) {
            $gambarLama = $data['user']['photo'];
            if ($gambarLama != 'default.jpg') {
                unlink(FCPATH . '/assets/profile_picture/' . $gambarLama);
            }
            $gambarBaru = $this->upload->data('file_name');
            $this->db->set('photo', $gambarBaru);
        } else {
            echo $this->upload->display_errors();
        }


        $where = array(
            'id' => $id,
        );

        $this->m_imt->update_data($where, $data, 'user');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('teknisi/teknisi/data_user_teknisi');
    }

    public function delete_teknisi_user($id)
    {
        $this->load->model('m_imt');
        $where = array('id' => $id);
        $this->m_imt->delete_imt($where, 'user');
        $this->session->set_flashdata('imt-delete', 'berhasil');
        redirect('teknisi/teknisi/data_user_teknisi');
    }


    public function tambah_teknisi_user()
    {
        
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Harap isi kolom nama.',
        ]);
        $this->form_validation->set_rules('code_instansi', 'Nammaa', 'required|trim', [
            'required' => 'Harap isi kolom nama.',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim', [
            'required' => 'Harap isi kolom email.',
        ]);
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim', [
            'required' => 'Harap isi kolom jenis.',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Harap isi kolom password.',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Harap isi kolom Instansi.',
        ]);

        if ($this->form_validation->run() == false) {

            
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['instansi'] = $this->db->get('instansi')->result();

        $data['view'] = 'teknisi/data-user/tambah_teknisi_user';

        $this->load->view('teknisi/template/template', $data);

        } else {
            // $image = $_FILES['photo']['name'];
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'code_instansi' => htmlspecialchars($this->input->post('code_instansi', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'jenis' => htmlspecialchars($this->input->post('jenis', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'password' => htmlspecialchars($this->input->post('password', true)),
                // 'photo' => htmlspecialchars($image),
                
            ];


            $this->db->insert('user', $data);
           
            $this->session->set_flashdata('success-upload', 'berhasil');
            redirect(base_url('teknisi/teknisi/data_user_teknisi'));
        }
    }
}
