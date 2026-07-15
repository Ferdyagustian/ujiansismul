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
                'npm'   => '50421004',
                'kelas' => '4IA28',
                'role'  => 'Backend Developer',
            ],
            [
                'nama'  => 'Muhammad Faqih Hakim',
                'npm'   => '50421082',
                'kelas' => '4IA28',
                'role'  => 'Frontend Developer',
            ],
            [
                'nama'  => 'Ferdy Agustian Prasetyo',
                'npm'   => '50421038',
                'kelas' => '4IA28',
                'role'  => 'Database Engineer',
            ],
            [
                'nama'  => 'Muchammad Fadhli Rochman',
                'npm'   => '50421090',
                'kelas' => '4IA28',
                'role'  => 'UI/UX Designer',
            ],
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('anggota/anggota', $data);
        $this->load->view('templates/footer');
    }
}
