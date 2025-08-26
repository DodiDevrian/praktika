<?php

class Diskusi extends CI_Controller
{
    public function __construct(){
		parent ::__construct();

		$this->load->helpers(['menuAktif']);
		$this->load->helpers('text');

        $this->load->model('m_diskusi');
        $this->load->model('m_asprak');

        if ($this->session->userdata('role')!=1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Anda Belum Melakukan <strong>Login Sebagai Admin!</strong>
				</div>');
			redirect('auth/login_admin');
		}
	}

    public function index()
    {
        $data = array(
            'title'         => 'Forum Diskusi',
            'title2'        => 'Laboratorium Teknik Informatika',
            'count_new'     => $this->m_praktikan->lists(),
            'diskusi'        => $this->m_diskusi->list(),
            'isi'           => 'admin/diskusi/v_list'
        );
        $this->load->view('admin/layout/v_wrapper', $data, FALSE);
    }

    public function jawab($id_ask)
    {
        $data = array(
            'title'         => 'Forum Diskusi',
            'title2'        => 'Laboratorium Teknik Informatika',
            'count_new'     => $this->m_praktikan->lists(),
            'diskusi'        => $this->m_diskusi->list(),
            'detail_ask'    => $this->m_diskusi->detail_ask($id_ask),
            'asprak'        => $this->m_asprak->lists(),
            'jawab'         => $this->m_diskusi->list_jawab(),
            'id'            => $id_ask,
            'isi'           => 'admin/diskusi/v_jawab'
        );
        $this->load->view('admin/layout/v_wrapper', $data, FALSE);
    }

    public function delete($id_ask)
    {
        $diskusi = $this->m_diskusi->detail_ask($id_ask);
        if ($diskusi->foto_tanya != "") {
            unlink('./upload/foto_tanya/' . $diskusi->foto_tanya);
        }

        $data = array('id_ask' => $id_ask);
        $this->m_diskusi->delete($data);

        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('admin/diskusi');
    }

    public function delete_jawab($id_ans)
    {
        $kursus = $this->m_diskusi->detail_ans($id_ans);
        if ($kursus->foto_jawab != "") {
            unlink('./upload/foto_jawab/' . $kursus->foto_jawab);
        }

        $data = array('id_ans' => $id_ans);
        $this->m_diskusi->delete_jawab($data);
        $this->session->set_flashdata('pesan', 'Jawaban Berhasil Dihapus!');

        $referred_from = $this->session->userdata('chat_diskusi');
        redirect($referred_from, 'refresh');
    }
}