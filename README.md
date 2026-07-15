# Galeri Kenangan (CodeIgniter 3)

## 1. Konteks dan Peran
Aplikasi web CRUD berbasis **CodeIgniter 3 (CI3)** untuk mencatat dan menyimpan galeri kenangan, dibangun dengan standar terstruktur sesuai konsep MVC. Aplikasi ini menangani unggahan banyak foto (multiple upload) untuk setiap kenangan, dengan struktur database relasional (satu kenangan memiliki banyak foto).

## 2. Deskripsi Proyek
*   **Nama Aplikasi:** Galeri Kenangan
*   **Tema:** Sistem manajemen galeri digital untuk mendata momen kenangan beserta foto-fotonya.
*   **Fokus Utama:** Operasi CRUD (Create, Read, Update, Delete) yang fungsional dengan fitur **Multiple Image Upload** (menyimpan file fisik gambar ke server dan nama filenya ke database) serta manajemen file gambar saat proses Update dan Delete.

## 3. Spesifikasi Teknis & Stack
*   **Backend:** PHP dengan Framework CodeIgniter 3.
*   **Database:** MySQL.
*   **Frontend:** HTML5, CSS3, dengan tata letak galeri untuk menampilkan foto-foto kenangan.

## 4. Struktur Database (`db.sql`)
Sistem menggunakan dua tabel utama:
*   `tb_kenangan`
    *   `id_kenangan` (INT, Primary Key, Auto Increment)
    *   `judul` (VARCHAR)
    *   `kategori` (VARCHAR)
    *   `tanggal_momen` (DATE)
    *   `deskripsi` (TEXT)
*   `tb_foto`
    *   `id_foto` (INT, Primary Key, Auto Increment)
    *   `id_kenangan` (INT, Foreign Key ke `tb_kenangan`)
    *   `nama_file` (VARCHAR) - menyimpan nama file gambar yang diunggah.

## 5. Fitur-fitur Utama (Berdasarkan Controller & Model)
1.  **Halaman Daftar Anggota Kelompok:**
    *   Controller `Anggota.php` untuk menampilkan daftar anggota.
2.  **Fungsi READ (Galeri):**
    *   Controller `Kenangan.php` menampilkan daftar kenangan. Mengambil 1 foto utama sebagai cover dari tabel `tb_foto`.
3.  **Fungsi CREATE (Upload Foto Multiple):**
    *   Menambahkan kenangan baru dengan fitur unggah banyak foto sekaligus.
    *   Memvalidasi file foto (JPG/PNG, ukuran maksimal) dan menyimpannya di `/assets/uploads/kenangan/`.
    *   Menyimpan data teks ke `tb_kenangan` dan sekumpulan nama file ke `tb_foto`.
4.  **Fungsi UPDATE dan Hapus Foto Parsial:**
    *   Memperbarui data teks (judul, kategori, dsb).
    *   Dapat menambahkan foto baru ke kenangan yang sudah ada.
    *   Dapat menghapus foto tertentu satu per satu dari kenangan (menghapus record database dan menggunakan fungsi `unlink()` untuk file fisik).
5.  **Fungsi DELETE (Hapus Data & Semua File Terkait):**
    *   Saat kenangan dihapus, sistem akan mengidentifikasi semua file foto yang terkait di database.
    *   Menghapus semua file fisik menggunakan fungsi `unlink()` untuk membersihkan server, sebelum menghapus data dari database.
