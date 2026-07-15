# Galeri Kenangan (Memories Gallery)

Aplikasi "Galeri Kenangan" adalah sebuah sistem manajemen konten (CRUD) sederhana yang dirancang untuk mendokumentasikan momen-momen penting atau kenangan. Aplikasi ini dibangun dengan struktur *Model-View-Controller* (MVC) menggunakan framework **CodeIgniter 3**.

## 💻 Tech Stack

*   **Backend:** PHP 7.x/8.x dengan Framework CodeIgniter 3
*   **Database:** MySQL (MariaDB)
*   **Frontend:** HTML5, CSS3 (termasuk *custom CSS* pada `assets/css/style.css`), dan JavaScript
*   **Server:** XAMPP (Apache)

## 📖 Keterangan Program

Aplikasi ini berfokus pada manajemen data kenangan. Pengguna dapat mencatat berbagai memori dengan informasi seperti judul, kategori, tanggal momen, dan deskripsi detail. Keunggulan utama dari program ini adalah dukungan **Multiple Image Upload**, di mana pengguna dapat melampirkan lebih dari satu foto untuk satu kenangan yang sama. Seluruh file fisik gambar dikelola dengan baik; ketika data kenangan atau foto dihapus, file fisik yang ada di server (dalam folder `/assets/uploads/kenangan/`) juga akan ikut dihapus untuk menghemat ruang penyimpanan.

## 🚀 Fitur Utama

1.  **Daftar Kenangan (Read):** Menampilkan seluruh data kenangan yang telah disimpan dalam bentuk daftar atau galeri.
2.  **Tambah Kenangan (Create):** Form untuk memasukkan data kenangan baru yang dilengkapi dengan fitur *multiple upload* untuk mengunggah beberapa foto sekaligus.
3.  **Detail Kenangan:** Menampilkan informasi lengkap mengenai suatu kenangan beserta seluruh foto yang dilampirkan.
4.  **Edit Kenangan (Update):** Memperbarui informasi teks (judul, kategori, dll.), menambah foto baru, serta kemampuan untuk menghapus foto secara individual pada suatu kenangan.
5.  **Hapus Kenangan (Delete):** Menghapus data kenangan beserta seluruh relasi fotonya dari database dan menghapus file gambarnya dari direktori server secara otomatis.
6.  **Halaman Anggota Kelompok:** Halaman statis yang menampilkan daftar nama anggota pengembang proyek.

## 📂 Struktur Database

Database: `kenangan`

1.  **`tb_kenangan`**
    *   `id_kenangan` (INT, Primary Key, Auto Increment)
    *   `judul` (VARCHAR)
    *   `kategori` (VARCHAR)
    *   `tanggal_momen` (DATE)
    *   `deskripsi` (TEXT)

2.  **`tb_foto`**
    *   `id_foto` (INT, Primary Key, Auto Increment)
    *   `id_kenangan` (INT, Foreign Key)
    *   `nama_file` (VARCHAR)

## ⚙️ Panduan Instalasi (Lokal)

1. Pastikan Anda memiliki XAMPP atau web server lokal lainnya.
2. Simpan folder `ujian-sismul` di dalam direktori `htdocs` (untuk XAMPP).
3. Buka phpMyAdmin, lalu buat database baru dengan nama `kenangan`.
4. Import file `db.sql` yang ada di root folder proyek ke dalam database `kenangan`.
5. Akses aplikasi melalui browser di `http://localhost/ujian-sismul`.
