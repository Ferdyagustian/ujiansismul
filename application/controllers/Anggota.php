<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Anggota — Controller halaman statis daftar anggota kelompok
 */
class Anggota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title']    = 'Daftar Anggota Kelompok';
        $data['anggota']  = [
            [
                'nama'  => 'Andi Maulana Firmansyah',
                'npm'   => '50422211',
                'kelas' => '4IA28',
                'role'  => 'Backend Developer',
            ],
            [
                'nama'  => 'Muhammad Faqih Hakim',
                'npm'   => '51422032',
                'kelas' => '4IA28',
                'role'  => 'Frontend Developer',
            ],
            [
                'nama'  => 'Ferdy agustian prasetyo',
                'npm'   => '50422565',
                'kelas' => '4IA28',
                'role'  => 'Database Engineer',
            ],
            [
                'nama'  => 'Muchammad Fadhli Rochman',
                'npm'   => '50422924',
                'kelas' => '4IA28',
                'role'  => 'Tester',
            ],
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('anggota/anggota', $data);
        $this->load->view('templates/footer');
    }
}
