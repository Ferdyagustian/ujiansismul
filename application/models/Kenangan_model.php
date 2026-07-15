<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kenangan_model extends CI_Model
{
    protected $table = 'tb_kenangan';
    protected $pk    = 'id_kenangan';
    protected $table_foto = 'tb_foto';

    // ----------------------------------------------------------------
    // READ: Ambil semua data kenangan beserta 1 foto utama (cover)
    // ----------------------------------------------------------------
    public function get_all()
    {
        $this->db->select('k.*, (SELECT nama_file FROM tb_foto f WHERE f.id_kenangan = k.id_kenangan ORDER BY id_foto ASC LIMIT 1) as foto');
        $this->db->from($this->table . ' k');
        $this->db->order_by('k.' . $this->pk, 'DESC');
        return $this->db->get()->result_array();
    }

    // ----------------------------------------------------------------
    // READ: Ambil satu data kenangan berdasarkan id, beserta semua fotonya
    // ----------------------------------------------------------------
    public function get_by_id($id)
    {
        $kenangan = $this->db->get_where($this->table, [$this->pk => $id])->row();
        
        if ($kenangan) {
            // Ambil semua foto terkait
            $fotos = $this->db->get_where($this->table_foto, ['id_kenangan' => $id])->result_array();
            $kenangan->fotos = $fotos;
            
            // Set foto pertama sebagai foto utama (jika ada) untuk fallback/compatibility
            $kenangan->foto = !empty($fotos) ? $fotos[0]['nama_file'] : null;
        }
        
        return $kenangan;
    }

    // ----------------------------------------------------------------
    // CREATE: Insert kenangan baru, kembalikan ID
    // ----------------------------------------------------------------
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id(); // Kembalikan ID yang baru dibuat
    }

    // ----------------------------------------------------------------
    // CREATE: Insert banyak foto sekaligus (batch)
    // ----------------------------------------------------------------
    public function insert_foto_batch($data_batch)
    {
        if (!empty($data_batch)) {
            return $this->db->insert_batch($this->table_foto, $data_batch);
        }
        return false;
    }

    // ----------------------------------------------------------------
    // UPDATE: Update data kenangan berdasarkan id
    // ----------------------------------------------------------------
    public function update($id, $data)
    {
        $this->db->where($this->pk, $id);
        return $this->db->update($this->table, $data);
    }

    // ----------------------------------------------------------------
    // DELETE: Hapus kenangan berdasarkan id
    // (File fisik dihapus dari controller sebelum memanggil fungsi ini)
    // ----------------------------------------------------------------
    public function delete($id)
    {
        // Data di tb_foto akan otomatis terhapus jika pakai ON DELETE CASCADE di database,
        // tapi untuk jaga-jaga kita hapus juga secara manual via Active Record
        $this->db->where('id_kenangan', $id);
        $this->db->delete($this->table_foto);

        $this->db->where($this->pk, $id);
        return $this->db->delete($this->table);
    }
    
    // ----------------------------------------------------------------
    // DELETE FOTO SPESIFIK (Opsional, untuk fitur hapus foto 1 per 1 saat edit)
    // ----------------------------------------------------------------
    public function delete_foto($id_foto)
    {
        $foto = $this->db->get_where($this->table_foto, ['id_foto' => $id_foto])->row();
        if ($foto) {
            $this->db->where('id_foto', $id_foto);
            $this->db->delete($this->table_foto);
            return $foto->nama_file; // Kembalikan nama file agar controller bisa hapus fisiknya
        }
        return false;
    }
}
