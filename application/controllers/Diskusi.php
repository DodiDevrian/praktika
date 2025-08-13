<?php

class Diskusi extends CI_Controller
{
    public function __construct(){
		parent ::__construct();

		$this->load->helpers(['menuAktif']);
		$this->load->helpers('text');

        $this->load->library('pagination');

        $this->load->model('m_diskusi');
        $this->load->model('m_kursus');
        $this->load->model('m_asprak');
	}

    public function index()
    {
        $config['base_url'] = site_url('diskusi/index'); //site url
        $config['total_rows'] = $this->db->count_all('tbl_ask'); //total row
        $config['per_page'] = 10;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['first_link']		= 'First';
		$config['last_link']		= 'Last';
		$config['next_link']		= 'Next';
		$config['prev_link']		= 'Prev';
		$config['full_tag_open']	= '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']	= '</ul></nav></div>';

		$config['num_tag_open']		= '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']	= '</span></li>';

		$config['cur_tag_open']		= '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']	= '</span></li>';

		$config['next_tag_open']	= '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']	= '<span aria-hidden="true">&raquo</span></span></li>';

		$config['prev_tag_open']	= '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']	= '</span>Next</li>';

		$config['first_tag_open']	= '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close']	= '</span></li>';

		$config['last_tag_open']	= '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']	= '</span></li>';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['diskusi'] = $this->m_diskusi->lists($config["per_page"], $data['page'])->result();
        $data['pagination'] = $this->pagination->create_links();
        $data['kursus'] = $this->m_kursus->lists();
        $data['title'] = 'Forum Diskusi';
        $data['title2'] = 'Laboratorium Teknik Informatika';

        $this->load->view('layout/v_head', $data);
        $this->load->view('layout/v_header');
        $this->load->view('layout/v_nav');
        $this->load->view('diskusi/v_diskusi', $data);
        $this->load->view('layout/v_footer');
    }

    public function me()
    {

        $config['base_url'] = site_url('diskusi/me/index'); //site url
        $config['total_rows'] = $this->db->count_all('tbl_ask'); //total row
        $config['per_page'] = 10;
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['first_link']		= 'First';
		$config['last_link']		= 'Last';
		$config['next_link']		= 'Next';
		$config['prev_link']		= 'Prev';
		$config['full_tag_open']	= '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']	= '</ul></nav></div>';

		$config['num_tag_open']		= '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']	= '</span></li>';

		$config['cur_tag_open']		= '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']	= '</span></li>';

		$config['next_tag_open']	= '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']	= '<span aria-hidden="true">&raquo</span></span></li>';

		$config['prev_tag_open']	= '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']	= '</span>Next</li>';

		$config['first_tag_open']	= '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close']	= '</span></li>';

		$config['last_tag_open']	= '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']	= '</span></li>';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['diskusi'] = $this->m_diskusi->lists($config["per_page"], $data['page'])->result();
        $data['pagination'] = $this->pagination->create_links();
        $data['kursus'] = $this->m_kursus->lists();
        $data['title'] = 'Forum Diskusi';
        $data['title2'] = 'Laboratorium Teknik Informatika';

        $this->load->view('layout/v_head', $data);
        $this->load->view('layout/v_header');
        $this->load->view('layout/v_nav');
        $this->load->view('diskusi/v_diskusi_me', $data);
        $this->load->view('layout/v_footer');
    }

    public function detail_diskusi($id_kursus)
    {
        $data = array(
            'title'         => 'Forum Diskusi',
            'title2'        => 'Laboratorium Teknik Informatika',
            'kursus'        => $this->m_kursus->lists(),
            'detail_asprak' => $this->m_asprak->detail_asprak($id_kursus),
            'detail_kursus' => $this->m_kursus->detail_kursus($id_kursus),
            'diskusi'       => $this->m_diskusi->list(),
            'id'            => $this->uri->segment(3),
            'isi'           => 'diskusi/v_detail_diskusi'
        );
        $this->load->view('layout/v_wrapper', $data, FALSE);
    }

    public function detail_diskusi_me($id_kursus)
    {
        $data = array(
            'title'         => 'Forum Diskusi',
            'title2'        => 'Laboratorium Teknik Informatika',
            'kursus'        => $this->m_kursus->lists(),
            'detail_asprak' => $this->m_asprak->detail_asprak($id_kursus),
            'detail_kursus' => $this->m_kursus->detail_kursus($id_kursus),
            'diskusi'       => $this->m_diskusi->list(),
            'id'            => $this->uri->segment(3),
            'isi'           => 'diskusi/v_detail_diskusi_me'
        );
        $this->load->view('layout/v_wrapper', $data, FALSE);
    }

    public function add_chat_user(){
        // Load library form_validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('tanya', 'Diskusi', 'required', [
            'required'    => 'Mohon untuk mengisi kolom diskusi'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal
            $this->session->set_flashdata('error', validation_errors('<div class="alert alert-danger">', '</div>'));
            $referred_from = $this->session->userdata('chat_diskusi');
            redirect($referred_from, 'refresh');
            return;
        }

        if ($this->form_validation->run() == TRUE) {
            
            $config['upload_path']      = './upload/foto_tanya/';
            $config['allowed_types']    = 'jpg|png|jpeg|gif';
            $config['max_size']         = 20000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto_tanya')) {
                $kursus = $this->input->post('kursus');
                list($id_kursus, $id_asprak) = explode('|', $kursus);
                
                $data = array(
                    'id_user'           => $this->input->post('id_user'),
                    'id_kursus'         => $id_kursus,
                    'id_asprak'         => $id_asprak,
                    'tanya'             => html_escape($this->input->post('tanya'))
                );

                $this->m_diskusi->add_chat_user($data);
                $this->session->set_flashdata('pesan', 'Diskusi Berhasil Ditambahkan!');

                $referred_from = $this->session->userdata('chat_diskusi');
                redirect($referred_from, 'refresh');
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './upload/foto_tanya/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $kursus = $this->input->post('kursus');
                list($id_kursus, $id_asprak) = explode('|', $kursus);

                $data = array(
                    'id_user'       => $this->input->post('id_user'),
                    'id_kursus'     => $id_kursus,
                    'id_asprak'     => $id_asprak,
                    'tanya'             => html_escape($this->input->post('tanya')),
                    'foto_tanya'    => $upload_data['uploads']['file_name']
                );

                $this->m_diskusi->add_chat_user($data);
                $this->session->set_flashdata('pesan', 'Diskusi Berhasil Ditambahkan!');

                $referred_from = $this->session->userdata('chat_diskusi');
                redirect($referred_from, 'refresh');
            }
        }
    }

    public function jawab($id_ask){
        $data = array(
            'title'         => 'Forum Diskusi',
            'title2'        => 'Laboratorium Teknik Informatika',
            'kursus'        => $this->m_kursus->lists(),
            'detail_ask'    => $this->m_diskusi->detail_ask($id_ask),
            'diskusi'       => $this->m_diskusi->list(),
            'jawab'         => $this->m_diskusi->list_jawab(),
            'like'          => $this->m_diskusi->list_like(),
            'report'          => $this->m_diskusi->list_report(),
            'id'            => $id_ask,
            'isi'           => 'diskusi/v_jawab'
        );
        $this->load->view('layout/v_wrapper', $data, FALSE);
    }

    public function add_ans_user(){
        // Load library form_validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('jawab', 'Diskusi', 'required', [
            'required'    => 'Mohon untuk mengisi kolom diskusi'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal
            $this->session->set_flashdata('error', validation_errors('<div class="alert alert-danger">', '</div>'));
            $referred_from = $this->session->userdata('chat_diskusi');
            redirect($referred_from, 'refresh');
            return;
        }

        if ($this->form_validation->run() == TRUE) {
            
            $config['upload_path']      = './upload/foto_jawab/';
            $config['allowed_types']    = 'jpg|png|jpeg|gif';
            $config['max_size']         = 20000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto_jawab')) {
                $data = array(
                    'id_user'           => $this->input->post('id_user'),
                    'id_ask'            => $this->input->post('id_ask'),
                    'asprak_jawab'      => 'no',
                    'jawab'             => html_escape($this->input->post('jawab'))
                );

                $this->m_diskusi->add_ans_user($data);
                $this->session->set_flashdata('pesan', 'Jawaban Berhasil Ditambahkan!');

                $referred_from = $this->session->userdata('chat_diskusi');
                redirect($referred_from, 'refresh');
            } else {

                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './upload/foto_jawab/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'id_user'       => $this->input->post('id_user'),
                    'id_ask'            => $this->input->post('id_ask'),
                    'asprak_jawab'      => 'no',
                    'jawab'             => html_escape($this->input->post('jawab')),
                    'foto_jawab'    => $upload_data['uploads']['file_name']
                );

                $this->m_diskusi->add_ans_user($data);
                $this->session->set_flashdata('pesan', 'Diskusi Berhasil Ditambahkan!');

                $referred_from = $this->session->userdata('chat_diskusi');
                redirect($referred_from, 'refresh');
            }
        }
    }

    public function like_jawab ($id_ans)
    {
        $data = array(
            'like_dislike'  => 'like',
            'id_ans'        => $id_ans,
            'id_user_like'       => $this->session->userdata('id_user')
        );

        $this->m_diskusi->like_jawab($data);
        $this->session->set_flashdata('pesan', 'Berhasil Memenyukai jawaban!');

        $referred_from = $this->session->userdata('chat_diskusi');
        redirect($referred_from, 'refresh');
    }

    public function unlike($id_like)
    {
        $data = array('id_like' => $id_like);
        $this->m_diskusi->unlike($data);
        $this->session->set_flashdata('pesan', 'Soal Berhasil Dihapus!');
        
        $referred_from = $this->session->userdata('chat_diskusi');
        redirect($referred_from, 'refresh');
    }

    public function report ($id_ans)
    {
        $data = array(
            'id_ans'        => $id_ans,
            'report'        => $this->input->post('report'),
            'id_user_report'  => $this->session->userdata('id_user')
        );

        $this->m_diskusi->report($data);
        $this->session->set_flashdata('pesan', 'Berhasil Melakukan Report!');

        $referred_from = $this->session->userdata('chat_diskusi');
        redirect($referred_from, 'refresh');
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