<?php

class M_imt extends CI_Model
{
    public function tampil_data_pengukuran()
    {
        return $this->db->get('pengukuran');
    }

    public function tampil_data()
    {
        return $this->db->get('member');
    }

    public function userByCode($code)
    {
        $this->db->select('id');
        $this->db->from('user');
        $this->db->where('code_alat', $code);

        $query = $this->db->get();
        return $query;
    }

    public function tampil_data_user()
    {
        return $this->db->get('user');
    }

    public function tampil_data_member()
    {
        $this->db->select('member.id, member.id_rfid, member.nama, member.jenis_kelamin, member.tgl_lahir, instansi.instansi');
        $this->db->from('member');
        $this->db->join('instansi', 'member.code_instansi=instansi.id');
        return $this->db->get();
    }

    public function tampil_data_instansi()
    {
        return $this->db->get('instansi');
    }

    public function detail_imt($id = null)
    {
        $query = $this->db->get_where('data-imt', array('id' => $id))->row();
        return $query;
    }

    public function detail_user($id = null)
    {
        $query = $this->db->get_where('user', array('id' => $id))->row();
        return $query;
    }

    public function detail_instansi($id = null)
    {
        $query = $this->db->get_where('instansi', array('id' => $id))->row();
        return $query;
    }

    public function detail_member($id = null)
    {
        $this->db->select('*');
        $this->db->from('member');
        $this->db->join('instansi', 'member.code_instansi=instansi.id');
        $this->db->where('member.id', $id);

        $query = $this->db->get();
        return $query;
    }

    public function delete_imt($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_imt($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
