<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page Header -->
<div class="sv-page-header">
    <div>
        <h1 class="sv-page-title">Galeri <span>Kenangan</span></h1>
        <p class="sv-page-subtitle">Koleksi foto &amp; momen kenangan</p>
    </div>
    <a href="<?= site_url('kenangan/create') ?>" class="btn-sv-primary">
        <i class="bi bi-plus-lg"></i> Tambah Kenangan
    </a>
</div>

<!-- Flash Messages -->
<?php if ($this->session->flashdata('success')): ?>
    <div class="sv-alert sv-alert-success" role="alert">
        <i class="bi bi-check-circle-fill"></i>
        <?= htmlspecialchars($this->session->flashdata('success')) ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="sv-alert sv-alert-error" role="alert">
        <i class="bi bi-exclamation-circle-fill"></i>
        <?= htmlspecialchars($this->session->flashdata('error')) ?>
    </div>
<?php endif; ?>

<!-- Card Grid -->
<div class="sv-grid">

    <?php if (empty($kenangan)): ?>
        <!-- Empty State -->
        <div class="sv-empty-state">
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3 20.25h18M21 12V3.75a.75.75 0 00-.75-.75H3.75a.75.75 0 00-.75.75V15M12 12.75H12.008" />
            </svg>
            <h3>Belum ada data kenangan</h3>
            <p>Mulai tambahkan foto kenangan Anda.</p>
            <a href="<?= site_url('kenangan/create') ?>" class="btn-sv-primary" style="margin-top:.5rem">
                <i class="bi bi-plus-lg"></i> Tambah Kenangan Pertama
            </a>
        </div>

    <?php else: ?>

        <?php foreach ($kenangan as $k): ?>
            <article class="sv-card">

                <!-- Foto -->
                <div class="sv-card-img-wrap">
                    <?php if ( ! empty($k['foto']) && file_exists('./assets/uploads/kenangan/' . $k['foto'])): ?>
                        <img src="<?= base_url('assets/uploads/kenangan/' . $k['foto']) ?>"
                             alt="<?= htmlspecialchars($k['judul']) ?>"
                             loading="lazy">
                    <?php else: ?>
                        <div class="sv-card-img-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909" />
                            </svg>
                            <span>No Image</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Card Body -->
                <div class="sv-card-body">
                    <h2 class="sv-card-title"><?= htmlspecialchars($k['judul']) ?></h2>
                    <p class="sv-card-subtitle text-muted" style="font-size: 0.85rem; margin-bottom: 0.25rem;">
                        <i class="bi bi-calendar3"></i> <?= htmlspecialchars($k['tanggal_momen']) ?>
                    </p>
                    <div class="sv-card-meta">
                        <span class="badge-role"><?= htmlspecialchars($k['kategori']) ?></span>
                    </div>
                    <?php if (!empty($k['deskripsi'])): ?>
                        <p class="sv-card-desc"><?= htmlspecialchars($k['deskripsi']) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Card Footer — Actions -->
                <div class="sv-card-footer" style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <a href="<?= site_url('kenangan/detail/' . $k['id_kenangan']) ?>" class="btn-sv-primary" style="flex: 1; text-align: center; font-size: .875rem; padding: .35rem 0;">
                        <i class="bi bi-eye"></i> Detail
                    </a>
                    <a href="<?= site_url('kenangan/edit/' . $k['id_kenangan']) ?>" class="btn-sv-ghost" style="flex: 1; text-align: center; font-size: .875rem; padding: .35rem 0;">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="<?= site_url('kenangan/delete/' . $k['id_kenangan']) ?>"
                       class="btn-sv-danger"
                       onclick="return confirmDelete(event, '<?= htmlspecialchars($k['judul'], ENT_QUOTES) ?>')"
                       style="flex: 1; text-align: center; font-size: .875rem; padding: .35rem 0;">
                        <i class="bi bi-trash3"></i> Hapus
                    </a>
                </div>

            </article>
        <?php endforeach; ?>

    <?php endif; ?>

</div><!-- /.sv-grid -->

<script>
function confirmDelete(event, judul) {
    const msg = 'Hapus kenangan "' + judul + '"?\n\nData dan gambar akan dihapus permanen dan tidak bisa dikembalikan.';
    if (!window.confirm(msg)) {
        event.preventDefault();
        return false;
    }
    return true;
}
</script>
