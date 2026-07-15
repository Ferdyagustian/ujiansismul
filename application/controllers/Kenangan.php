<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kenangan extends CI_Controller
{
    private $upload_path;
    private $allowed_types  = 'jpg|jpeg|png';
    private $max_size       = 2048; // KB
    private $file_input     = 'foto';
    private $last_upload_error = NULL;

    public function __construct()
    {
        parent::__construct();
        $this->upload_path = FCPATH . 'assets/uploads/kenangan/';
        $this->load->model('Kenangan_model', 'kenangan');
        $this->load->library('form_validation');
        $this->_ensure_upload_dir();
    }

    public function index()
    {
        $this->_render_home();
    }

    public function gallery()
    {
        $data['title']    = 'Galeri Kenangan';
        $data['kenangan'] = $this->kenangan->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('kenangan/kenangan_list', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id = NULL)
    {
        if ($id === NULL) redirect('galeri');

        $kenangan = $this->kenangan->get_by_id($id);
        if ( ! $kenangan) {
            $this->session->set_flashdata('error', 'Data kenangan tidak ditemukan.');
            redirect('galeri');
        }

        $data['title']    = $kenangan->judul . ' — Detail';
        $data['kenangan'] = $kenangan;

        $this->load->view('templates/header', $data);
        $this->load->view('kenangan/kenangan_detail', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        if ($this->input->method(TRUE) !== 'POST') {
            redirect(site_url() . '?popup=create');
        }

        $data = $this->_build_home_data();
        $data['show_create_modal'] = TRUE;

        $this->form_validation->set_rules('judul',         'Judul',         'required|max_length[100]|trim');
        $this->form_validation->set_rules('kategori',      'Kategori',      'required|max_length[50]|trim');
        $this->form_validation->set_rules('tanggal_momen', 'Tanggal Momen', 'required|trim');
        $this->form_validation->set_rules('deskripsi',     'Deskripsi',     'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->_render_home($data);
            return;
        }

        if (empty($_FILES[$this->file_input]['name'][0])) {
            $data['form_error_message'] = 'Minimal satu foto wajib diunggah.';
            $this->_render_home($data);
            return;
        }

        $id_kenangan = $this->kenangan->insert([
            'judul'         => $this->input->post('judul', TRUE),
            'kategori'      => $this->input->post('kategori', TRUE),
            'tanggal_momen' => $this->input->post('tanggal_momen', TRUE),
            'deskripsi'     => $this->input->post('deskripsi', TRUE),
        ]);

        $uploaded_files = $this->_do_upload_multiple();

        if (empty($uploaded_files)) {
            $this->kenangan->delete($id_kenangan);
            $data['form_error_message'] = $this->last_upload_error ?: 'Upload foto gagal. Silakan coba lagi.';
            $this->_render_home($data);
            return;
        }
        
        $batch_data = [];
        foreach ($uploaded_files as $file) {
            $batch_data[] = [
                'id_kenangan' => $id_kenangan,
                'nama_file'   => $file
            ];
        }
        $this->kenangan->insert_foto_batch($batch_data);

        $this->session->set_flashdata('success', 'Kenangan berhasil ditambahkan!');
        redirect('galeri');
    }

    public function edit($id = NULL)
    {
        if ($id === NULL) redirect('galeri');

        $kenangan = $this->kenangan->get_by_id($id);
        if ( ! $kenangan) {
            $this->session->set_flashdata('error', 'Data kenangan tidak ditemukan.');
            redirect('galeri');
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
        if ($id === NULL) redirect('galeri');

        $kenangan = $this->kenangan->get_by_id($id);
        if ( ! $kenangan) {
            $this->session->set_flashdata('error', 'Data kenangan tidak ditemukan.');
            redirect('galeri');
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
        redirect('galeri');
    }

    private function _build_home_data()
    {
        $stats = $this->kenangan->get_dashboard_stats();

        return [
            'title' => 'Beranda',
            'kenangan_total' => $stats['kenangan_total'],
            'foto_total' => $stats['foto_total'],
            'kategori_total' => $stats['kategori_total'],
            'latest_tanggal' => $stats['latest_tanggal'],
            'show_create_modal' => FALSE,
            'open_popup_via_query' => ($this->input->get('popup', TRUE) === 'create'),
        ];
    }

    private function _render_home($data = [])
    {
        $payload = array_merge($this->_build_home_data(), $data);

        $this->load->view('templates/header', $payload);
        $this->load->view('kenangan/home', $payload);
        $this->load->view('templates/footer');
    }

    private function _do_upload_multiple()
    {
        $this->last_upload_error = NULL;

        if (!$this->_ensure_upload_dir()) {
            $this->last_upload_error = 'Folder upload tidak valid atau tidak bisa dibuat.';
            $this->session->set_flashdata('error', $this->last_upload_error);
            return [];
        }

        $config = [
            'upload_path'      => $this->upload_path,
            'allowed_types'    => $this->allowed_types,
            'max_size'         => $this->max_size,
            'encrypt_name'     => TRUE,
            'file_ext_tolower' => TRUE,
        ];
        $this->load->library('upload');
        $this->upload->initialize($config);

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
                    $this->last_upload_error = trim(strip_tags($this->upload->display_errors()));
                    $this->session->set_flashdata('error', $this->last_upload_error);
                }
            }
        }

        return $uploaded_files;
    }

    private function _ensure_upload_dir()
    {
        $upload_root = dirname($this->upload_path);

        if (!is_dir($upload_root)) {
            if (!@mkdir($upload_root, 0777, TRUE) && !is_dir($upload_root)) {
                return FALSE;
            }
        }

        if (!@mkdir($this->upload_path, 0755, TRUE) && !is_dir($this->upload_path)) {
            if (!is_dir($this->upload_path)) {
                return FALSE;
            }
        }

        @chmod($upload_root, 0777);
        @chmod($this->upload_path, 0777);

        return is_writable($this->upload_path);
    }
}
