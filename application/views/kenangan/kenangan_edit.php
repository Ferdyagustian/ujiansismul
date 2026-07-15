<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page Header -->
<div class="sv-page-header">
    <div>
        <h1 class="sv-page-title">Edit <span><?= htmlspecialchars($kenangan->judul) ?></span></h1>
        <p class="sv-page-subtitle">Perbarui data atau tambah foto kenangan</p>
    </div>
    <a href="<?= site_url('kenangan/detail/' . $kenangan->id_kenangan) ?>" class="btn-sv-ghost">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<!-- Flash Error -->
<?php if ($this->session->flashdata('error')): ?>
    <div class="sv-alert sv-alert-error" role="alert" style="max-width:640px;margin:0 auto 1.5rem;">
        <i class="bi bi-exclamation-circle-fill"></i>
        <?= htmlspecialchars($this->session->flashdata('error')) ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
    <div class="sv-alert sv-alert-success" role="alert" style="max-width:640px;margin:0 auto 1.5rem; background:rgba(16,185,129,0.1); color:#34d399; padding:1rem; border-radius:8px; border:1px solid rgba(16,185,129,0.2);">
        <i class="bi bi-check-circle-fill"></i>
        <?= htmlspecialchars($this->session->flashdata('success')) ?>
    </div>
<?php endif; ?>

<!-- Form Card -->
<div class="sv-form-card">
    <h2 class="sv-form-title">Edit Data Kenangan</h2>

    <?php if (validation_errors()): ?>
        <div class="sv-validation-errors" role="alert">
            <?= validation_errors('<ul><li>', '</li></ul>') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('kenangan/edit/' . $kenangan->id_kenangan) ?>" method="post" enctype="multipart/form-data" novalidate>

        <div class="sv-form-group">
            <label for="judul">Judul Kenangan <span style="color:#f87171">*</span></label>
            <input type="text" id="judul" name="judul" class="sv-form-control" value="<?= set_value('judul', htmlspecialchars($kenangan->judul)) ?>" required>
        </div>

        <div class="sv-form-group">
            <label for="kategori">Kategori <span style="color:#f87171">*</span></label>
            <select id="kategori" name="kategori" class="sv-form-control" required style="appearance: auto;">
                <?php
                $kategoris = ['Keluarga', 'Teman', 'Liburan', 'Sekolah', 'Pekerjaan', 'Lainnya'];
                foreach ($kategoris as $k):
                    $selected = (set_value('kategori', $kenangan->kategori) === $k) ? 'selected' : '';
                ?>
                    <option value="<?= $k ?>" <?= $selected ?>><?= $k ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="sv-form-group">
            <label for="tanggal_momen">Tanggal Momen <span style="color:#f87171">*</span></label>
            <input type="date" id="tanggal_momen" name="tanggal_momen" class="sv-form-control" value="<?= set_value('tanggal_momen', htmlspecialchars($kenangan->tanggal_momen)) ?>" required>
        </div>

        <div class="sv-form-group">
            <label for="deskripsi">Cerita / Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" class="sv-form-control" rows="3"><?= set_value('deskripsi', htmlspecialchars($kenangan->deskripsi ?? '')) ?></textarea>
        </div>

        <!-- Kelola Foto Saat Ini -->
        <div class="sv-form-group">
            <label>Foto Saat Ini</label>
            <div style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom: 1rem;">
                <?php if (!empty($kenangan->fotos)): ?>
                    <?php foreach($kenangan->fotos as $f): ?>
                        <div style="position:relative; width:120px; height:120px; border-radius:8px; overflow:hidden; border:1px solid rgba(255,255,255,0.1);">
                            <img src="<?= base_url('assets/uploads/kenangan/' . $f['nama_file']) ?>" style="width:100%; height:100%; object-fit:cover;">
                            <a href="<?= site_url('kenangan/hapus_foto/' . $kenangan->id_kenangan . '/' . $f['id_foto']) ?>" 
                               class="btn-sv-danger" 
                               style="position:absolute; top:4px; right:4px; padding:0.25rem 0.5rem; font-size:0.75rem;"
                               onclick="return confirm('Hapus foto ini?');">
                                <i class="bi bi-trash3"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color:var(--text-muted); font-size:0.875rem;">Tidak ada foto terlampir.</p>
                <?php endif; ?>
            </div>
            
            <label>Tambah Foto Lagi (Opsional)</label>
            <div class="sv-file-zone">
                <input type="file" id="foto" name="foto[]" accept="image/jpeg,image/png,.jpg,.jpeg,.png" multiple onchange="previewImages(this)">
                <div class="sv-file-zone-label" id="fileZoneLabel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    <span>Klik untuk tambah gambar baru</span>
                    <small>Bisa pilih lebih dari satu file</small>
                </div>
            </div>
            <div id="imagePreviewContainer" style="display:flex; gap:10px; margin-top:1rem; flex-wrap:wrap;"></div>
        </div>

        <!-- Actions -->
        <div class="sv-form-actions">
            <button type="submit" class="btn-sv-primary">
                <i class="bi bi-check-lg"></i> Simpan Perubahan
            </button>
            <a href="<?= site_url('kenangan/detail/' . $kenangan->id_kenangan) ?>" class="btn-sv-ghost">
                Batal
            </a>
        </div>
    </form>
</div>

<div style="padding-bottom:3rem;"></div>

<script>
function previewImages(input) {
    const container = document.getElementById('imagePreviewContainer');
    container.innerHTML = '';
    
    if (input.files) {
        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgWrap = document.createElement('div');
                imgWrap.style.width = '100px';
                imgWrap.style.height = '100px';
                imgWrap.style.borderRadius = '8px';
                imgWrap.style.overflow = 'hidden';
                imgWrap.style.border = '1px solid rgba(255,255,255,0.1)';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'cover';
                
                imgWrap.appendChild(img);
                container.appendChild(imgWrap);
            }
            reader.readAsDataURL(file);
        });
    }
}
</script>
