<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$kategoris = ['Keluarga', 'Teman', 'Liburan', 'Sekolah', 'Pekerjaan', 'Lainnya'];
$should_open_modal = !empty($show_create_modal) || !empty($open_popup_via_query);
$popup_state_class = $should_open_modal ? '' : 'hidden';
?>

<section class="grid gap-6 lg:grid-cols-[minmax(0,1.15fr)_minmax(280px,0.85fr)] lg:items-end">
    <div class="surface-card p-6 sm:p-8">
        <span class="inline-flex items-center gap-2 rounded-full border border-[#4285F4]/15 bg-[#4285F4]/8 px-3 py-1 text-xs font-bold uppercase tracking-[0.22em] text-[#174EA6]">
            <span class="google-dot google-dot--blue"></span>
            Memory canvas
        </span>
        <h1 class="mt-5 max-w-3xl font-display text-4xl font-bold tracking-tight text-slate-950 sm:text-5xl">
            Satu ruang sederhana untuk menyimpan momen yang ingin selalu diingat.
        </h1>
        <p class="mt-4 max-w-2xl text-base leading-7 text-slate-600 sm:text-lg">
            Tambahkan kenangan lewat popup singkat, lalu lihat seluruh koleksi visualnya di halaman galeri.
        </p>
        <div class="mt-8 flex flex-wrap gap-3">
            <button type="button" class="btn-google-primary" data-modal-open="create-memory-modal">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
                </svg>
                Tambah Kenangan
            </button>
            <a href="<?= site_url('galeri') ?>" class="btn-google-secondary">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.75 5.75h5.5v5.5h-5.5zm9 0h5.5v5.5h-5.5zm-9 9h5.5v5.5h-5.5zm9 0h5.5v5.5h-5.5z"/>
                </svg>
                Buka Galeri
            </a>
        </div>
    </div>

    <div class="surface-card p-6">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Snapshot</p>
        <div class="mt-5 space-y-3 text-sm text-slate-600">
            <div class="soft-badge justify-between">
                <span class="inline-flex items-center gap-2">
                    <span class="google-dot google-dot--blue"></span>
                    Total kenangan
                </span>
                <strong class="font-display text-base text-slate-950"><?= (int) $kenangan_total ?></strong>
            </div>
            <div class="soft-badge justify-between">
                <span class="inline-flex items-center gap-2">
                    <span class="google-dot google-dot--red"></span>
                    Total foto
                </span>
                <strong class="text-slate-800"><?= (int) $foto_total ?></strong>
            </div>
            <div class="soft-badge justify-between">
                <span class="inline-flex items-center gap-2">
                    <span class="google-dot google-dot--yellow"></span>
                    Kategori aktif
                </span>
                <strong class="text-slate-800"><?= (int) $kategori_total ?></strong>
            </div>
        </div>
    </div>
</section>

<?php if ($this->session->flashdata('success')): ?>
    <div class="status-alert status-alert--success mt-6" role="alert">
        <span class="google-dot google-dot--green"></span>
        <?= htmlspecialchars($this->session->flashdata('success')) ?>
    </div>
<?php endif; ?>

<?php if (!empty($form_error_message)): ?>
    <div class="status-alert status-alert--error mt-6" role="alert">
        <span class="google-dot google-dot--red"></span>
        <?= htmlspecialchars($form_error_message) ?>
    </div>
<?php endif; ?>

<section class="mt-8 grid gap-6 lg:grid-cols-[minmax(0,1.05fr)_minmax(320px,0.95fr)]">
    <div class="surface-card p-6 sm:p-8">
        <div class="flex items-start justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Highlights</p>
                <h2 class="mt-2 font-display text-3xl font-bold tracking-tight text-slate-950">Ringkasan kecil dari memori yang sudah terkumpul.</h2>
                <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600">Beranda dipakai untuk melihat gambaran umum, sementara galeri tetap menjadi tempat utama untuk menikmati foto.</p>
            </div>
            <span class="soft-badge w-auto text-xs text-slate-500">Quick overview</span>
        </div>

        <div class="mt-8 grid gap-4 md:grid-cols-2">
            <div class="dashboard-card">
                <span class="dashboard-card__stripe bg-[#4285F4]"></span>
                <p class="dashboard-card__label">Total memory</p>
                <strong class="dashboard-card__value"><?= (int) $kenangan_total ?></strong>
                <p class="dashboard-card__meta">Semua kenangan yang tersimpan di sistem.</p>
            </div>
            <div class="dashboard-card">
                <span class="dashboard-card__stripe bg-[#EA4335]"></span>
                <p class="dashboard-card__label">Total foto</p>
                <strong class="dashboard-card__value"><?= (int) $foto_total ?></strong>
                <p class="dashboard-card__meta">Jumlah file gambar yang sudah terunggah.</p>
            </div>
            <div class="dashboard-card">
                <span class="dashboard-card__stripe bg-[#FBBC05]"></span>
                <p class="dashboard-card__label">Kategori aktif</p>
                <strong class="dashboard-card__value"><?= (int) $kategori_total ?></strong>
                <p class="dashboard-card__meta">Kategori yang sudah memiliki isi.</p>
            </div>
            <div class="dashboard-card">
                <span class="dashboard-card__stripe bg-[#34A853]"></span>
                <p class="dashboard-card__label">Update terakhir</p>
                <strong class="dashboard-card__value dashboard-card__value--date">
                    <?= !empty($latest_tanggal) ? htmlspecialchars($latest_tanggal) : '-' ?>
                </strong>
                <p class="dashboard-card__meta">Tanggal momen terbaru yang masuk.</p>
            </div>
        </div>
    </div>

    <div class="surface-card p-6 sm:p-8">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Quick Actions</p>
        <div class="mt-5 space-y-4">
            <div class="rounded-2xl border border-slate-900/8 bg-white/72 p-4">
                <div class="flex items-center gap-3">
                    <span class="google-dot google-dot--blue"></span>
                    <h3 class="text-lg font-bold text-slate-950">Tambah Kenangan</h3>
                </div>
                <p class="mt-3 text-sm leading-6 text-slate-600">Simpan momen baru dengan form ringkas tanpa keluar dari beranda.</p>
                <button type="button" class="btn-google-primary mt-4" data-modal-open="create-memory-modal">Buka Popup</button>
            </div>
            <div class="rounded-2xl border border-slate-900/8 bg-white/72 p-4">
                <div class="flex items-center gap-3">
                    <span class="google-dot google-dot--green"></span>
                    <h3 class="text-lg font-bold text-slate-950">Buka Galeri</h3>
                </div>
                <p class="mt-3 text-sm leading-6 text-slate-600">Masuk ke halaman galeri untuk melihat semua kenangan dalam tampilan visual penuh.</p>
                <a href="<?= site_url('galeri') ?>" class="btn-google-secondary mt-4">Ke Halaman Galeri</a>
            </div>
        </div>
    </div>
</section>

<div id="create-memory-modal" class="modal-shell <?= $popup_state_class ?>" aria-hidden="<?= $should_open_modal ? 'false' : 'true' ?>">
    <div class="modal-backdrop" data-modal-close="create-memory-modal"></div>
    <div class="modal-panel modal-panel--compact surface-card">
        <div class="flex items-start justify-between gap-4 p-5 pb-0 sm:p-6 sm:pb-0">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-[#4285F4]/15 bg-[#4285F4]/8 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.2em] text-[#174EA6]">
                    <span class="google-dot google-dot--blue"></span>
                    New memory
                </div>
                <h2 class="mt-3 font-display text-2xl font-bold tracking-tight text-slate-950">Tambah Kenangan</h2>
                <p class="mt-1.5 text-sm leading-6 text-slate-500">Isi singkat, unggah foto, lalu simpan momennya.</p>
            </div>
            <button type="button" class="modal-close" data-modal-close="create-memory-modal" aria-label="Tutup popup">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="px-5 pb-5 pt-5 sm:px-6 sm:pb-6">
            <?php if (validation_errors()): ?>
                <div class="validation-panel mb-5" role="alert">
                    <?= validation_errors('<ul><li>', '</li></ul>') ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('kenangan/create') ?>" method="post" enctype="multipart/form-data" novalidate class="space-y-5">
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label for="judul" class="field-label field-label--blue">Judul Kenangan <span class="text-[#EA4335]">*</span></label>
                        <input type="text" id="judul" name="judul" class="field-input field-input--compact" placeholder="Contoh: Liburan ke Bali" value="<?= set_value('judul') ?>" required>
                    </div>

                    <div>
                        <label for="kategori" class="field-label field-label--red">Kategori <span class="text-[#EA4335]">*</span></label>
                        <select id="kategori" name="kategori" class="field-input field-input--compact" required>
                            <option value="" disabled <?= set_value('kategori') === '' ? 'selected' : '' ?>>Pilih kategori</option>
                            <?php foreach ($kategoris as $k): ?>
                                <option value="<?= $k ?>" <?= set_value('kategori') === $k ? 'selected' : '' ?>><?= $k ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="tanggal_momen" class="field-label field-label--yellow">Tanggal Momen <span class="text-[#EA4335]">*</span></label>
                        <input type="date" id="tanggal_momen" name="tanggal_momen" class="field-input field-input--compact" value="<?= set_value('tanggal_momen') ?>" required>
                    </div>

                    <div class="md:col-span-2">
                        <label for="deskripsi" class="field-label field-label--green">Cerita / Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" class="field-input field-input--compact min-h-[104px]" placeholder="Ceritakan singkat momen ini..."><?= set_value('deskripsi') ?></textarea>
                    </div>
                </div>

                <div>
                    <label for="foto" class="field-label">Foto <span class="text-[#EA4335]">*</span></label>
                    <label class="upload-zone upload-zone--compact mt-2 block cursor-pointer" for="foto">
                        <input type="file" id="foto" name="foto[]" accept="image/jpeg,image/png,.jpg,.jpeg,.png" multiple class="hidden" onchange="previewImages(this)">
                        <span class="mx-auto flex h-10 w-10 items-center justify-center rounded-2xl border border-[#4285F4]/20 bg-[#4285F4]/10 text-[#4285F4]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V6m0 0L8.25 9.75M12 6l3.75 3.75M4.5 15.75v2.625A1.125 1.125 0 0 0 5.625 19.5h12.75A1.125 1.125 0 0 0 19.5 18.375V15.75"/>
                            </svg>
                        </span>
                        <span class="mt-3 block text-sm font-semibold text-slate-800">Pilih gambar</span>
                        <span class="mt-1.5 block text-xs text-slate-500">JPG/PNG, maksimal 2 MB per file.</span>
                    </label>
                    <div id="imagePreviewContainer" class="mt-3 flex flex-wrap gap-2.5"></div>
                </div>

                <div class="flex flex-wrap gap-2 pt-1">
                    <button type="submit" class="btn-google-primary">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                        </svg>
                        Simpan
                    </button>
                    <button type="button" class="btn-google-secondary" data-modal-close="create-memory-modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
            };
            reader.readAsDataURL(file);
        });
    }
}

(function() {
    const modal = document.getElementById('create-memory-modal');
    if (!modal) return;

    const openModal = () => {
        modal.classList.remove('hidden');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('modal-open');
    };

    const closeModal = () => {
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');
    };

    document.querySelectorAll('[data-modal-open="create-memory-modal"]').forEach(button => {
        button.addEventListener('click', openModal);
    });

    document.querySelectorAll('[data-modal-close="create-memory-modal"]').forEach(button => {
        button.addEventListener('click', closeModal);
    });

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape' && modal.getAttribute('aria-hidden') === 'false') {
            closeModal();
        }
    });

    if (modal.getAttribute('aria-hidden') === 'false') {
        document.body.classList.add('modal-open');
    }
})();
</script>
