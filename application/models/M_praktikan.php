<?php

class M_praktikan extends CI_Model
{
    public function lists()
    {
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->order_by('id_user', 'DESC');

        return $this->db->get()->result();
    }

    public function detail($id_user)
    {
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('id_user', $id_user);

        return $this->db->get()->row();
    }

    public function add($data)
    {
        $this->db->insert('tbl_user', $data);
    }

    public function edit($data)
    {
        $this->db->where('id_user', $data['id_user']);
        $this->db->update('tbl_user', $data);
    }

    public function delete($data)
    {
        $this->db->where('id_user', $data['id_user']);
        $this->db->delete('tbl_user', $data);
    }

    public function add_keypretest($data)
    {
        $this->db->insert('tbl_keypretest', $data);
    }

    public function edit_keypretest($data)
    {
        $this->db->where('id_keypretest', $data['id_keypretest']);
        $this->db->update('tbl_keypretest', $data);
    }
}
