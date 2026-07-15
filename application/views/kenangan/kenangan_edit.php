<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $kategoris = ['Keluarga', 'Teman', 'Liburan', 'Sekolah', 'Pekerjaan', 'Lainnya']; ?>

<section class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Edit memory</p>
        <h1 class="mt-2 font-display text-4xl font-bold tracking-tight text-slate-950"><?= htmlspecialchars($kenangan->judul) ?></h1>
        <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">Perbarui informasi kenangan dan kelola foto yang sudah terlampir.</p>
    </div>
    <a href="<?= site_url('kenangan/detail/' . $kenangan->id_kenangan) ?>" class="btn-google-secondary">
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
        </svg>
        Kembali ke detail
    </a>
</section>

<?php if ($this->session->flashdata('error')): ?>
    <div class="status-alert status-alert--error mx-auto mb-6 max-w-4xl" role="alert">
        <span class="google-dot google-dot--red"></span>
        <?= htmlspecialchars($this->session->flashdata('error')) ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
    <div class="status-alert status-alert--success mx-auto mb-6 max-w-4xl" role="alert">
        <span class="google-dot google-dot--green"></span>
        <?= htmlspecialchars($this->session->flashdata('success')) ?>
    </div>
<?php endif; ?>

<section class="mx-auto max-w-4xl">
    <div class="surface-card p-6 sm:p-8">
        <div class="mb-8 flex items-start justify-between gap-4">
            <div>
                <h2 class="font-display text-2xl font-bold text-slate-950">Edit Data Kenangan</h2>
                <p class="mt-2 text-sm text-slate-500">Anda bisa memperbarui teks dan menambahkan foto baru kapan saja.</p>
            </div>
            <span class="soft-badge text-xs text-slate-500">Update board</span>
        </div>

        <?php if (validation_errors()): ?>
            <div class="validation-panel mb-6" role="alert">
                <?= validation_errors('<ul><li>', '</li></ul>') ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('kenangan/edit/' . $kenangan->id_kenangan) ?>" method="post" enctype="multipart/form-data" novalidate class="space-y-8">
            <div class="grid gap-6 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label for="judul" class="field-label">Judul Kenangan <span class="text-[#EA4335]">*</span></label>
                    <input type="text" id="judul" name="judul" class="field-input" value="<?= set_value('judul', $kenangan->judul) ?>" required>
                </div>

                <div>
                    <label for="kategori" class="field-label">Kategori <span class="text-[#EA4335]">*</span></label>
                    <select id="kategori" name="kategori" class="field-input" required>
                        <?php foreach ($kategoris as $k): ?>
                            <option value="<?= $k ?>" <?= set_value('kategori', $kenangan->kategori) === $k ? 'selected' : '' ?>><?= $k ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="tanggal_momen" class="field-label">Tanggal Momen <span class="text-[#EA4335]">*</span></label>
                    <input type="date" id="tanggal_momen" name="tanggal_momen" class="field-input" value="<?= set_value('tanggal_momen', $kenangan->tanggal_momen) ?>" required>
                </div>

                <div class="md:col-span-2">
                    <label for="deskripsi" class="field-label">Cerita / Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="field-input min-h-[132px]"><?= set_value('deskripsi', $kenangan->deskripsi ?? '') ?></textarea>
                </div>
            </div>

            <div>
                <div class="mb-4 flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Foto Saat Ini</h3>
                        <p class="text-sm text-slate-500">Hapus satu per satu bila diperlukan.</p>
                    </div>
                    <span class="soft-badge text-xs text-slate-500"><?= !empty($kenangan->fotos) ? count($kenangan->fotos) : 0 ?> file</span>
                </div>

                <?php if (!empty($kenangan->fotos)): ?>
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <?php foreach ($kenangan->fotos as $f): ?>
                            <div class="relative overflow-hidden rounded-3xl border border-slate-900/10 bg-white p-2 shadow-sm">
                                <img src="<?= base_url('assets/uploads/kenangan/' . $f['nama_file']) ?>" alt="Foto kenangan" class="aspect-square w-full rounded-[1.25rem] object-cover">
                                <a href="<?= site_url('kenangan/hapus_foto/' . $kenangan->id_kenangan . '/' . $f['id_foto']) ?>" class="absolute right-4 top-4 inline-flex items-center rounded-full border border-white/60 bg-white/95 px-3 py-1 text-xs font-semibold text-[#EA4335] shadow-sm backdrop-blur transition hover:bg-white" onclick="return confirm('Hapus foto ini?');">
                                    Hapus
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-5 py-8 text-center text-sm text-slate-500">
                        Tidak ada foto terlampir.
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <label for="foto" class="field-label">Tambah Foto Baru</label>
                <label class="upload-zone mt-2 block cursor-pointer" for="foto">
                    <input type="file" id="foto" name="foto[]" accept="image/jpeg,image/png,.jpg,.jpeg,.png" multiple class="hidden" onchange="previewImages(this)">
                    <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl border border-[#34A853]/20 bg-[#34A853]/10 text-[#34A853]">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V6m0 0L8.25 9.75M12 6l3.75 3.75M4.5 15.75v2.625A1.125 1.125 0 0 0 5.625 19.5h12.75A1.125 1.125 0 0 0 19.5 18.375V15.75"/>
                        </svg>
                    </span>
                    <span class="mt-4 block text-base font-semibold text-slate-800">Pilih gambar tambahan</span>
                    <span class="mt-2 block text-sm text-slate-500">Boleh lebih dari satu file dalam sekali unggah.</span>
                </label>
                <div id="imagePreviewContainer" class="mt-4 flex flex-wrap gap-3"></div>
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="btn-google-primary">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="<?= site_url('kenangan/detail/' . $kenangan->id_kenangan) ?>" class="btn-google-secondary">Batal</a>
            </div>
        </form>
    </div>
</section>

<script>
function previewImages(input) {
    const container = document.getElementById('imagePreviewContainer');
    container.innerHTML = '';
    
    if (input.files) {
        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgWrap = document.createElement('div');
                imgWrap.className = 'preview-tile';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'h-full w-full object-cover';
                
                imgWrap.appendChild(img);
                container.appendChild(imgWrap);
            }
            reader.readAsDataURL(file);
        });
    }
}
</script>
