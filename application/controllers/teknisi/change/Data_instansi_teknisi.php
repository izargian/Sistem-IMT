<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_instansi_teknisi extends CI_Controller
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

    public function detail_teknisi_instansi($id)
    {
        $this->load->model('m_imt');
        $where = array('id' => $id);
        $detail = $this->m_imt->detail_instansi($id);
        $data['detail'] = $detail;

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['view'] = 'teknisi/data-instansi/detail_teknisi_instansi';

        $this->load->view('teknisi/template/template', $data);
    }


    public function update_teknisi_instansi($id)
    {
        $this->load->model('m_imt');

        $where = array('id' => $id);

        $data['data_instansi'] = $this->m_imt->update_imt($where, 'instansi')->result();

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['view'] = 'teknisi/data-instansi/update_teknisi_instansi';

        $this->load->view('teknisi/template/template', $data);
    }

    public function edit_teknisi_instansi()
    {
        $this->load->model('m_imt');

        $id = $this->input->post('id');
        $instansi = $this->input->post('instansi');
        $code_instansi = $this->input->post('code_instansi');
        $alamat = $this->input->post('alamat');

        $data = array(
            'instansi' => $instansi,
            'alamat' => $alamat,
            'code_instansi' => $code_instansi,
        );


        $where = array(
            'id' => $id,
        );

        $this->m_imt->update_data($where, $data, 'instansi');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('teknisi/teknisi/data_instansi_teknisi');
    }

    public function delete_teknisi_instansi($id)
    {
        $cek_member = $this->db->get_where('member', array('code_instansi' => $id));
        $cek_user = $this->db->get_where('user', array('code_instansi' => $id));
        if ($cek_member->num_rows() > 0) {
            return $this->output->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Data instansi masih digunakan oleh member/user!'
                ]));
        }elseif($cek_user->num_rows() > 0){
            return $this->output->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Data instansi masih digunakan oleh member/user!'
                ]));
        }else{
            $this->db->delete('instansi', array('id' => $id));
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

    }


    public function tambah_teknisi_instansi()
    {

        $this->form_validation->set_rules('instansi', 'Instansi', 'required|trim', [
            'required' => 'Harap isi kolom nama.',
        ]);
        $this->form_validation->set_rules('code_instansi', 'Code', 'required|trim', [
            'required' => 'Harap isi kolom email.',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Harap isi kolom alamat.',
        ]);

        if ($this->form_validation->run() == false) {


            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();

            $data['view'] = 'teknisi/data-instansi/tambah_teknisi_instansi';

            $this->load->view('teknisi/template/template', $data);
        } else {
            // $image = $_FILES['photo']['name'];
            $data = [
                'instansi' => htmlspecialchars($this->input->post('instansi', true)),
                'code_instansi' => htmlspecialchars($this->input->post('code_instansi', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                // 'photo' => htmlspecialchars($image),

            ];

            //     $config['allowed_types'] = 'jpg|png|jpeg';
            // $config['max_size'] = '9096';
            // $config['upload_path'] = './assets/profile_picture';

            // $this->load->library('upload', $config);
            // if ( ! $this->upload->do_upload('photo')) {


            //     $gambarBaru = $this->upload->data('file_name');
            //     $this->db->set('photo', $gambarBaru);
            // } else {
            //     echo $this->db->set('photo', 'default.png');
            // }

            $this->db->insert('instansi', $data);

            $this->session->set_flashdata('success-upload', 'berhasil');
            redirect(base_url('teknisi/teknisi/data_instansi_teknisi'));
        }
    }
}
