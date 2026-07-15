-- 1. Buat database baru 'kenangan' jika belum ada
CREATE DATABASE IF NOT EXISTS kenangan;
USE kenangan;

-- 2. Buat tabel utama tb_kenangan
CREATE TABLE IF NOT EXISTS tb_kenangan (
    id_kenangan INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(100) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    tanggal_momen DATE NOT NULL,
    deskripsi TEXT
);

-- 3. Buat tabel tb_foto untuk menyimpan banyak gambar
CREATE TABLE IF NOT EXISTS tb_foto (
    id_foto INT AUTO_INCREMENT PRIMARY KEY,
    id_kenangan INT NOT NULL,
    nama_file VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_kenangan) REFERENCES tb_kenangan(id_kenangan) ON DELETE CASCADE
);
