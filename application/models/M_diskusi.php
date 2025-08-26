<?php

class M_diskusi extends CI_Model
{
    public function list()
    {
        $this->db->select('*');
        $this->db->from('tbl_ask');
        $this->db->join('tbl_asprak', 'tbl_asprak.id_asprak = tbl_ask.id_asprak', 'left');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_ask.id_user', 'left');
        $this->db->join('tbl_kursus', 'tbl_kursus.id_kursus = tbl_ask.id_kursus', 'left');
        $this->db->order_by('id_ask', 'DESC');
    
        return $this->db->get()->result();
    }

    public function list_jawab()
    {
        $this->db->select('*');
        $this->db->from('tbl_ans');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_ans.id_user', 'left');
        $this->db->order_by('id_ans', 'DESC');

        return $this->db->get()->result();
    }

    public function list_like()
    {
        $this->db->select('*');
        $this->db->from('tbl_like');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_like.id_user_like', 'left');
        $this->db->join('tbl_ans', 'tbl_ans.id_ans = tbl_like.id_ans', 'left');
        $this->db->order_by('id_like', 'DESC');

        return $this->db->get()->result();
    }
    
    public function lists($limit, $start)
    {
        $this->db->join('tbl_asprak', 'tbl_asprak.id_asprak = tbl_ask.id_asprak', 'left');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_ask.id_user', 'left');
        $this->db->join('tbl_kursus', 'tbl_kursus.id_kursus = tbl_ask.id_kursus', 'left');
        $this->db->order_by('id_ask', 'DESC');
        $query = $this->db->get('tbl_ask', $limit, $start);
        return $query;

    }

    public function list_report()
    {
        $this->db->select('*');
        $this->db->from('tbl_report');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_report.id_user_report', 'left');
        $this->db->join('tbl_ans', 'tbl_ans.id_ans = tbl_report.id_ans', 'left');
        $this->db->order_by('id_report', 'DESC');

        return $this->db->get()->result();
    }

    public function listsById($id_kursus, $limit, $start)
    {
        // $this->db->join('tbl_asprak', 'tbl_asprak.id_asprak = tbl_diskusi.id_asprak', 'left');
        // $this->db->join('tbl_user', 'tbl_user.id_user = tbl_diskusi.id_user', 'left');
        // $this->db->join('tbl_kursus', 'tbl_kursus.id_kursus = tbl_diskusi.id_kursus', 'left');
        // $this->db->order_by('id_diskusi', 'DESC');

        $query = $this->db->get_where("tbl_diskusi",array('id_kursus' => $id_kursus),$limit, $start);
        // $query = $this->db->get('tbl_diskusi', $limit, $start);
        return $query;

    }

    public function add_chat_user($data)
    {
        $this->db->insert('tbl_ask', $data);
    }

    public function add_ans_user($data)
    {
        $this->db->insert('tbl_ans', $data);
    }

    public function detail_ask($id_ask)
    {
        $this->db->select('*');
        $this->db->from('tbl_ask');
        $this->db->join('tbl_asprak', 'tbl_asprak.id_asprak = tbl_ask.id_asprak', 'left');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_ask.id_user', 'left');
        $this->db->join('tbl_kursus', 'tbl_kursus.id_kursus = tbl_ask.id_kursus', 'left');
        $this->db->where('id_ask', $id_ask);

        return $this->db->get()->row();
    }

    public function detail_ans($id_ans)
    {
        $this->db->select('*');
        $this->db->from('tbl_ans');
        $this->db->where('id_ans', $id_ans);

        return $this->db->get()->row();
    }

    public function like_jawab($data)
    {
        $this->db->insert('tbl_like', $data);
    }

    public function unlike($data)
    {
        $this->db->where('id_like', $data['id_like']);
        $this->db->delete('tbl_like', $data);
    }

    public function report($data)
    {
        $this->db->insert('tbl_report', $data);
    }

    public function edit($data)
    {
        $this->db->where('id_diskusi', $data['id_diskusi']);
        $this->db->update('tbl_diskusi', $data);
    }

    public function delete($data)
    {
        $this->db->where('id_diskusi', $data['id_diskusi']);
        $this->db->delete('tbl_diskusi', $data);
    }

    public function delete_jawab($data)
    {
        $this->db->where('id_ans', $data['id_ans']);
        $this->db->delete('tbl_ans', $data);
    }

    public function get_keyword($keyword){
		$this->db->select('*');
		$this->db->from('tbl_ask');
        $this->db->join('tbl_asprak', 'tbl_asprak.id_asprak = tbl_ask.id_asprak', 'left');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_ask.id_user', 'left');
        $this->db->join('tbl_kursus', 'tbl_kursus.id_kursus = tbl_ask.id_kursus', 'left');
		$this->db->like('tanya',$keyword);
		
		return $this->db->get()->result();
	}
}