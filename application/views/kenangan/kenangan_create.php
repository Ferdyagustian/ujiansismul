<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page Header -->
<div class="sv-page-header">
    <div>
        <h1 class="sv-page-title">Tambah <span>Kenangan</span></h1>
        <p class="sv-page-subtitle">Simpan momen berharga Anda di Galeri Kenangan</p>
    </div>
    <a href="<?= site_url('kenangan') ?>" class="btn-sv-ghost">
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

<!-- Form Card -->
<div class="sv-form-card">
    <h2 class="sv-form-title">Data Foto &amp; Momen</h2>

    <!-- Validation Errors -->
    <?php if (validation_errors()): ?>
        <div class="sv-validation-errors" role="alert">
            <?= validation_errors('<ul><li>', '</li></ul>') ?>
        </div>
    <?php endif; ?>

    <!-- Form -->
    <form action="<?= site_url('kenangan/create') ?>" method="post" enctype="multipart/form-data" novalidate>

        <div class="sv-form-group">
            <label for="judul">Judul Kenangan <span style="color:#f87171">*</span></label>
            <input type="text" id="judul" name="judul" class="sv-form-control" placeholder="cth: Liburan ke Bali" value="<?= set_value('judul') ?>" required>
        </div>

        <div class="sv-form-group">
            <label for="kategori">Kategori <span style="color:#f87171">*</span></label>
            <select id="kategori" name="kategori" class="sv-form-control" required style="appearance: auto;">
                <option value="" disabled selected>Pilih Kategori</option>
                <?php
                $kategoris = ['Keluarga', 'Teman', 'Liburan', 'Sekolah', 'Pekerjaan', 'Lainnya'];
                foreach ($kategoris as $k):
                ?>
                    <option value="<?= $k ?>" <?= set_value('kategori') === $k ? 'selected' : '' ?>><?= $k ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="sv-form-group">
            <label for="tanggal_momen">Tanggal Momen <span style="color:#f87171">*</span></label>
            <input type="date" id="tanggal_momen" name="tanggal_momen" class="sv-form-control" value="<?= set_value('tanggal_momen') ?>" required>
        </div>

        <div class="sv-form-group">
            <label for="deskripsi">Cerita / Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" class="sv-form-control" rows="3" placeholder="Ceritakan kisah di balik momen ini..."><?= set_value('deskripsi') ?></textarea>
        </div>

        <div class="sv-form-group">
            <label>Foto <span style="color:#f87171">*</span></label>
            <div class="sv-file-zone" id="fileZone">
                <input type="file" id="foto" name="foto[]" accept="image/jpeg,image/png,.jpg,.jpeg,.png" multiple onchange="previewImages(this)">
                <div class="sv-file-zone-label" id="fileZoneLabel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    <span>Klik untuk pilih beberapa gambar (Bisa Block/Pilih Banyak)</span>
                    <small>JPG / PNG &mdash; Maks. 2 MB per file</small>
                </div>
            </div>

            <div id="imagePreviewContainer" style="display:flex; gap:10px; margin-top:1rem; flex-wrap:wrap;"></div>
        </div>

        <!-- Actions -->
        <div class="sv-form-actions">
            <button type="submit" class="btn-sv-primary">
                <i class="bi bi-check-lg"></i> Simpan Kenangan
            </button>
            <a href="<?= site_url('kenangan') ?>" class="btn-sv-ghost">
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
