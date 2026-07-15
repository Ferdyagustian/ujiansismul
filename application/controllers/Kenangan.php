<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kenangan extends CI_Controller
{
    private $upload_path    = './assets/uploads/kenangan/';
    private $allowed_types  = 'jpg|jpeg|png';
    private $max_size       = 2048; // KB
    private $file_input     = 'foto';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kenangan_model', 'kenangan');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title']    = 'Galeri Kenangan';
        $data['kenangan'] = $this->kenangan->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('kenangan/kenangan_list', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id = NULL)
    {
        if ($id === NULL) redirect('kenangan');

        $kenangan = $this->kenangan->get_by_id($id);
        if ( ! $kenangan) {
            $this->session->set_flashdata('error', 'Data kenangan tidak ditemukan.');
            redirect('kenangan');
        }

        $data['title']    = $kenangan->judul . ' — Detail';
        $data['kenangan'] = $kenangan;

        $this->load->view('templates/header', $data);
        $this->load->view('kenangan/kenangan_detail', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Kenangan';

        $this->form_validation->set_rules('judul',         'Judul',         'required|max_length[100]|trim');
        $this->form_validation->set_rules('kategori',      'Kategori',      'required|max_length[50]|trim');
        $this->form_validation->set_rules('tanggal_momen', 'Tanggal Momen', 'required|trim');
        $this->form_validation->set_rules('deskripsi',     'Deskripsi',     'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('kenangan/kenangan_create', $data);
            $this->load->view('templates/footer');
            return;
        }

        // Cek apakah ada file yang diupload (meski multiple, kita cek index 0)
        if (empty($_FILES[$this->file_input]['name'][0])) {
            $this->session->set_flashdata('error', 'Minimal satu foto wajib diunggah.');
            redirect('kenangan/create');
            return;
        }

        // Insert text data first to get ID
        $id_kenangan = $this->kenangan->insert([
            'judul'         => $this->input->post('judul', TRUE),
            'kategori'      => $this->input->post('kategori', TRUE),
            'tanggal_momen' => $this->input->post('tanggal_momen', TRUE),
            'deskripsi'     => $this->input->post('deskripsi', TRUE),
        ]);

        // Proses multiple upload
        $uploaded_files = $this->_do_upload_multiple();
        
        if (!empty($uploaded_files)) {
            $batch_data = [];
            foreach ($uploaded_files as $file) {
                $batch_data[] = [
                    'id_kenangan' => $id_kenangan,
                    'nama_file'   => $file
                ];
            }
            $this->kenangan->insert_foto_batch($batch_data);
        }

        $this->session->set_flashdata('success', 'Kenangan berhasil ditambahkan!');
        redirect('kenangan');
    }

    public function edit($id = NULL)
    {
        if ($id === NULL) redirect('kenangan');

        $kenangan = $this->kenangan->get_by_id($id);
        if ( ! $kenangan) {
            $this->session->set_flashdata('error', 'Data kenangan tidak ditemukan.');
            redirect('kenangan');
        }

        $data['title']    = 'Edit Kenangan';
        $data['kenangan'] = $kenangan;

        $this->form_validation->set_rules('judul',         'Judul',         'required|max_length[100]|trim');
        $this->form_validation->set_rules('kategori',      'Kategori',      'required|max_length[50]|trim');
        $this->form_validation->set_rules('tanggal_momen', 'Tanggal Momen', 'required|trim');
        $this->form_validation->set_rules('deskripsi',     'Deskripsi',     'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('kenangan/kenangan_edit', $data);
            $this->load->view('templates/footer');
            return;
        }

        $update_data = [
            'judul'         => $this->input->post('judul', TRUE),
            'kategori'      => $this->input->post('kategori', TRUE),
            'tanggal_momen' => $this->input->post('tanggal_momen', TRUE),
            'deskripsi'     => $this->input->post('deskripsi', TRUE),
        ];
        
        $this->kenangan->update($id, $update_data);

        // Jika user mengunggah foto tambahan
        if (!empty($_FILES[$this->file_input]['name'][0])) {
            $uploaded_files = $this->_do_upload_multiple();
            if (!empty($uploaded_files)) {
                $batch_data = [];
                foreach ($uploaded_files as $file) {
                    $batch_data[] = [
                        'id_kenangan' => $id,
                        'nama_file'   => $file
                    ];
                }
                $this->kenangan->insert_foto_batch($batch_data);
            }
        }

        $this->session->set_flashdata('success', 'Data kenangan berhasil diperbarui!');
        redirect('kenangan/detail/' . $id);
    }

    // Fitur hapus satu spesifik foto saat edit
    public function hapus_foto($id_kenangan, $id_foto)
    {
        $file_name = $this->kenangan->delete_foto($id_foto);
        if ($file_name) {
            $file_path = $this->upload_path . $file_name;
            if (file_exists($file_path)) unlink($file_path);
            $this->session->set_flashdata('success', 'Foto berhasil dihapus.');
        }
        redirect('kenangan/edit/' . $id_kenangan);
    }

    public function delete($id = NULL)
    {
        if ($id === NULL) redirect('kenangan');

        $kenangan = $this->kenangan->get_by_id($id);
        if ( ! $kenangan) {
            $this->session->set_flashdata('error', 'Data kenangan tidak ditemukan.');
            redirect('kenangan');
        }

        // Hapus semua file fisik foto
        if (!empty($kenangan->fotos)) {
            foreach ($kenangan->fotos as $f) {
                $file_path = $this->upload_path . $f['nama_file'];
                if (file_exists($file_path)) unlink($file_path);
            }
        }

        $this->kenangan->delete($id);
        $this->session->set_flashdata('success', 'Kenangan berhasil dihapus!');
        redirect('kenangan');
    }

    private function _do_upload_multiple()
    {
        $config = [
            'upload_path'      => $this->upload_path,
            'allowed_types'    => $this->allowed_types,
            'max_size'         => $this->max_size,
            'encrypt_name'     => TRUE,
            'file_ext_tolower' => TRUE,
        ];
        $this->load->library('upload', $config);

        $uploaded_files = [];
        $files = $_FILES[$this->file_input];
        $file_count = count($files['name']);

        for ($i = 0; $i < $file_count; $i++) {
            if (!empty($files['name'][$i])) {
                $_FILES['single_file']['name']     = $files['name'][$i];
                $_FILES['single_file']['type']     = $files['type'][$i];
                $_FILES['single_file']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['single_file']['error']    = $files['error'][$i];
                $_FILES['single_file']['size']     = $files['size'][$i];
                
                if ($this->upload->do_upload('single_file')) {
                    $uploaded_files[] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', strip_tags($this->upload->display_errors()));
                }
            }
        }

        return $uploaded_files;
    }
}
