<?php

class Posttest extends CI_Controller
{
    public function __construct(){
		parent ::__construct();

		$this->load->helpers(['menuAktif']);
		$this->load->helpers('text');

        $this->load->model('m_kursus');
        $this->load->model('m_materi');
        $this->load->model('m_dosen');
        $this->load->model('m_posttest');

        if ($this->agent->is_referral())
        {
            echo $this->agent->referrer();
        }

        if ($this->session->userdata('role')!=2) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Anda Belum Melakukan <strong>Login Sebagai Admin!</strong>
				</div>');
			redirect('auth/login_admin');
		}
	}

    public function index()
    {
        $data = array(
            'title'   => 'Post-Test',
            'title2'  => 'Laboratorium Teknik Informatika',
            'dosen'        => $this->m_dosen->lists(),
            'kursus'   => $this->m_kursus->lists(),
            'posttest'   => $this->m_posttest->lists(),
            'count_new'     => $this->m_praktikan->lists(),
            'isi'     => 'dosen/posttest/v_list'
        );
        $this->load->view('dosen/layout/v_wrapper', $data, FALSE);
    }

    public function soal($id_kursus){
        
        $data = array(
            'title'         => 'Soal Post-Test',
            'title2'        => 'Laboratorium Teknik Informatika',
            'dosen'        => $this->m_dosen->lists(),
            'count_new'     => $this->m_praktikan->lists(),
            'kursus'     => $this->m_kursus->detail_kursus($id_kursus),
            'posttest'       => $this->m_posttest->lists_soal(),
            'kunci_list'    => $this->m_posttest->list_kunci(),
            'kunci'       => $this->m_posttest->kunci($id_kursus),
            // 'keypretest'    => $this->m_pretest->keypretest(),
            'id'            => $this->uri->segment(4),
            'isi'           => 'dosen/posttest/v_list'
        );
        $this->load->view('dosen/layout/v_wrapper', $data, FALSE);
    }

    public function hasil($id_kursus)
    {
        $data = array(
            'title' => 'Hasil Posttest',
            'title2' => 'Laboratorium Teknik Informatika',
            'count_new'     => $this->m_praktikan->lists(),
            'dosen'        => $this->m_dosen->lists(),
            'kursus'   => $this->m_kursus->lists(),
            'detail_kursus' => $this->m_kursus->detail_kursus($id_kursus),
            'posttest'     => $this->m_posttest->do_posttest(),
            'id'            => $id_kursus,
            'isi'   => 'dosen/posttest/v_hasil'
        );
        $this->load->view('dosen/layout/v_wrapper', $data, FALSE);
    }

}