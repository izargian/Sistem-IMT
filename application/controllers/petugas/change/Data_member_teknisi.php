<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_member_teknisi extends CI_Controller
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

    public function detail_teknisi_member($id)
    {
        $this->load->model('m_imt');
        $detail = $this->m_imt->detail_member($id)->row();
        $data['detail'] = $detail;

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        // select data imt berdasarkan member
        $this->db->select('*');
        $this->db->from('data-imt');
        $this->db->join('member', 'data-imt.id_member=member.id');
        $this->db->where('data-imt.id_member', $id);
        $data_imt = $this->db->get();
        $data['data_imt'] = $data_imt->result();

        $data['view'] = 'petugas/data-member/detail_teknisi_member';

        $this->load->view('petugas/template/template', $data);
    }


    public function update_teknisi_member($id)
    {
        $this->load->model('m_imt');

        $this->load->model('m_imt');
        $data['instansi'] = $this->db->get('instansi')->result();

        $data['jenis_kelamin'] = $this->jenis_kelamin();

        $data['data_member'] = $this->db->get_where('member', array('id' => $id))->row();

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['view'] = 'petugas/data-member/update_teknisi_member';
        $this->load->view('petugas/template/template', $data);
    }

    public function edit_teknisi_member()
    {
        $this->load->model('m_imt');

        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $code_instansi = $this->input->post('code_instansi');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $id_rfid = $this->input->post('id_rfid');
        $tgl_lahir = $this->input->post('tgl_lahir');

        $data = array(
            'code_instansi' => $code_instansi,
            'nama' => $nama,
            'id_rfid' => $id_rfid,
            'tgl_lahir' => $tgl_lahir,
            'jenis_kelamin' => $jenis_kelamin,
        );



        $where = array(
            'id' => $id,
        );

        $this->m_imt->update_data($where, $data, 'member');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('teknisi/teknisi/data_member_teknisi');
    }

    public function delete_teknisi_member($id)
    {
        $cek = $this->db->get_where('data-imt', array('id_member' => $id));
        if ($cek->num_rows() > 0) {
            return $this->output->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Data member masih digunakan di Data IMT!'
                ]));
        }

        $this->db->delete('member', array('id' => $id));
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


    public function tambah_teknisi_member()
    {

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Harap isi kolom nama.',
        ]);
        $this->form_validation->set_rules('code_instansi', 'Nammaa', 'required|trim', [
            'required' => 'Harap isi kolom nama.',
        ]);
        $this->form_validation->set_rules('tgl_lahir', 'tgl_lahir', 'required|trim', [
            'required' => 'Harap isi kolom tgl_lahir.',
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis_kelamin', 'required|trim', [
            'required' => 'Harap isi kolom jenis_kelamin.',
        ]);

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();

            $this->load->model('m_imt');
            $data['data_instansi'] = $this->db->get('instansi')->result();
            $data['view'] = 'petugas/data-member/tambah_teknisi_member';


            $this->load->view('petugas/template/template', $data);
        } else {
            $data['data_instansi'] = $this->db->get('instansi')->result();

            $cek_rfid = $this->db->get_where('member', array('id_rfid' => $this->input->post('id_rfid')));
            if ($cek_rfid->num_rows() > 0) {
                $this->session->set_flashdata('errors', '
                <div class="alert alert-danger" role="alert">No ID Kartu Member sudah digunakan!</div>');
                redirect(base_url('petugas/change/data_member_teknisi/tambah_teknisi_member'));
            }
            $data = [
                'id_rfid' => $this->input->post('id_rfid'),
                'nama' => $this->input->post('nama'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'code_instansi' => $this->input->post('code_instansi'),
            ];


            $this->db->insert('member', $data);

            $this->session->set_flashdata('success-upload', 'berhasil');
            redirect(base_url('petugas/petugas/data_member_teknisi'));
        }
    }

    public function chart($id)
    {
        $this->db->select('data-imt.tinggi_badan, data-imt.berat_badan, data-imt.created');
        $this->db->from('data-imt');
        $this->db->where('id_member', $id);
        $data = $this->db->get();
        $result = $data->result();
        $berat_badan = [];
        $tinggi_badan = [];
        $tanggal = [];
        foreach ($result as $value) {
            $berat_badan[] = $value->berat_badan;
            $tinggi_badan[] = $value->tinggi_badan;
            $tanggal[] = $value->created;
        }
        echo json_encode([
            'berat_badan' => $berat_badan,
            'tinggi_badan' => $tinggi_badan,
            'tanggal' => $tanggal,
        ]);
    }

    public function jenis_kelamin()
    {
        $jenis_kelamin = [
            [
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'jenis_kelamin' => 'Perempuan',
            ],

        ];
        return $jenis_kelamin;
    }
}
