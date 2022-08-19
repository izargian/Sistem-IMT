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
        $data['role'] = $this->role();
        $data['instansi'] = $this->db->get('instansi')->result();

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

            $data = array(
                'code_instansi' => $code_instansi,
                'nama' => $nama,
                'email' => $email,
                'password' => $password,
                'alamat' => $alamat,
                'jenis' => $jenis,
                'photo' => $gambarBaru,
            );
        } else {
            echo $this->upload->display_errors();
            $data = array(
                'code_instansi' => $code_instansi,
                'nama' => $nama,
                'email' => $email,
                'password' => $password,
                'alamat' => $alamat,
                'jenis' => $jenis,
            );
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
        $cek_gambar = $this->db->get_where('user', array('id' => $id))->row();
        if ($cek_gambar->photo != null) {
            unlink(FCPATH . '/assets/profile_picture/' . $cek_gambar->photo );
        }

        $this->db->delete('user', array('id' => $id));
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


    public function tambah_teknisi_user()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi!',
        ]);
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim', [
            'required' => 'Jenis user harus dipilih!',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim', [
            'required' => 'Email harus diisi!',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password harus diisi!',
        ]);
        $this->form_validation->set_rules('code_instansi', 'Code_instansi', 'required|trim', [
            'required' => 'Instansi harus dipilih!',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat harus diisi!',
        ]);

        if ($this->form_validation->run() == false) {

            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();

            $data['instansi'] = $this->db->get('instansi')->result();
            $data['role'] = $this->role();

            $data['view'] = 'teknisi/data-user/tambah_teknisi_user';

            $this->load->view('teknisi/template/template', $data);
        } else {

            $config['upload_path'] = "./assets/profile_picture";
            $config['allowed_types'] = 'gif|jpg|png';
            $config['ancrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload("photo")) {
                $data = array('upload_data' => $this->upload->data());
                $avatar = $data['upload_data']['file_name'];
                $data = [
                    'nama' => $this->input->post('nama'),
                    'jenis' => $this->input->post('jenis'),
                    'email' => $this->input->post('email'),
                    'alamat' => $this->input->post('alamat'),
                    'password' => md5($this->input->post('password')),
                    'code_instansi' => $this->input->post('code_instansi'),
                    'photo' => $avatar,
                ];
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'jenis' => $this->input->post('jenis'),
                    'email' => $this->input->post('email'),
                    'alamat' => $this->input->post('alamat'),
                    'password' => md5($this->input->post('password')),
                    'code_instansi' => $this->input->post('code_instansi'),
                ];
            }

            $this->db->insert('user', $data);
            $this->session->set_flashdata('success-upload', 'berhasil');
            redirect(base_url('teknisi/teknisi/data_user_teknisi'));
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
}
