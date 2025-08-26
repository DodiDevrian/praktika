<?php

class Diskusi extends CI_Controller
{
    public function __construct(){
		parent ::__construct();

		$this->load->helpers(['menuAktif']);
		$this->load->helpers('text');

        $this->load->model('m_diskusi');
        $this->load->model('m_asprak');

        if ($this->session->userdata('role')!=4) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Anda Belum Melakukan <strong>Login Sebagai Admin!</strong>
				</div>');
			redirect('auth/login');
		}
	}

    public function index()
    {
        $data = array(
            'title'         => 'Forum Diskusi',
            'title2'        => 'Laboratorium Teknik Informatika',
            'diskusi'        => $this->m_diskusi->list(),
            'asprak'   => $this->m_asprak->lists(),
            'isi'           => 'asprak/diskusi/v_list'
        );
        $this->load->view('asprak/layout/v_wrapper', $data, FALSE);
    }

    public function jawab($id_ask)
    {
        $data = array(
            'title'         => 'Forum Diskusi',
            'title2'        => 'Laboratorium Teknik Informatika',
            'diskusi'        => $this->m_diskusi->list(),
            'detail_ask'    => $this->m_diskusi->detail_ask($id_ask),
            'asprak'        => $this->m_asprak->lists(),
            'jawab'         => $this->m_diskusi->list_jawab(),
            'id'            => $id_ask,
            'isi'           => 'asprak/diskusi/v_jawab'
        );
        $this->load->view('asprak/layout/v_wrapper', $data, FALSE);
    }

    public function edit($id_diskusi)
    {
        $config['upload_path']      = './upload/foto_diskusi_asprak/';
        $config['allowed_types']    = 'jpg|png|jpeg|gif';
        $config['max_size']         = 20000;
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto_diskusi_asprak')) {
            $data = array(
                'id_diskusi'      => $id_diskusi,
                'diskusi_asprak'     => $this->input->post('diskusi_asprak')
            );
            $this->m_diskusi->edit($data);
            $this->session->set_flashdata('pesan', 'Jawaban Berhasil Diubah!');
            redirect('asisten/diskusi');

        } else {
            $upload_data = array('uploads' => $this->upload->data());
            $config['image_library'] = 'gd2';
            $config['source_image'] = './upload/foto_diskusi_asprak/' . $upload_data['uploads']['file_name'];
            $this->load->library('image_lib', $config);

            $jawab = $this->m_diskusi->detail($id_diskusi);
            if ($jawab->foto_diskusi_asprak != "") {
                unlink('./upload/foto_diskusi_asprak/' . $jawab->foto_diskusi_asprak);
            }

            $data = array(
                'id_diskusi'      => $id_diskusi,
                'diskusi_asprak'     => $this->input->post('diskusi_asprak'),
                'foto_diskusi_asprak'    => $upload_data['uploads']['file_name']
            );

            $this->m_diskusi->edit($data);
            $this->session->set_flashdata('pesan', 'Jawaban dan Gambar Berhasil Diubah!');
            redirect('asisten/diskusi');
        }
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
                    'asprak_jawab'      => 'yes',
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
                    'asprak_jawab'      => 'yes',
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

    public function delete($id_ask)
    {
        $diskusi = $this->m_diskusi->detail_ask($id_ask);
        if ($diskusi->foto_tanya != "") {
            unlink('./upload/foto_tanya/' . $diskusi->foto_tanya);
        }

        $data = array('id_ask' => $id_ask);
        $this->m_diskusi->delete($data);

        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('asisten/diskusi');
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