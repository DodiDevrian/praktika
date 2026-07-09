<?php

class Home extends CI_Controller
{
    public function __construct(){
		parent ::__construct();

		$this->load->helpers(['menuAktif']);
		$this->load->helpers('text');

        $this->load->model('m_home');
        $this->load->model('m_kursus');
        $this->load->model('m_asprak');
		$this->load->model('m_praktikan');
	}
    
    public function index()
    {
        $data = array(
            'title'                 => 'Kursus Online',
            'title2'                => 'Laboratorium Teknik Informatika',
            'kursus_terakhir'       => $this->m_home->kursus_terakhir(),
            'asprak_terakhir'       => $this->m_home->asprak_terakhir(),
            'slider_terakhir'       => $this->m_home->slider_terakhir(),
            'materi'        => $this->m_kursus->lists_materi(),
            'materi_button' => $this->m_kursus->lists_materi_button(),
            'isi'                   => 'v_home'
        );
        $this->load->view('layout/v_wrapper', $data, FALSE);
    }
}
