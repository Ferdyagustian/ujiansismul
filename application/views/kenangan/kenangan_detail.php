<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page Header -->
<div class="sv-page-header">
    <div>
        <h1 class="sv-page-title">Detail <span>Kenangan</span></h1>
        <p class="sv-page-subtitle">Informasi lengkap foto &amp; momen</p>
    </div>
    <a href="<?= site_url('kenangan') ?>" class="btn-sv-ghost">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="sv-grid" style="grid-template-columns: 1fr; max-width: 800px; margin: 0 auto;">
    <article class="sv-card" style="padding: 1.5rem;">
        
        <?php if (!empty($kenangan->fotos)): ?>
            <!-- Menampilkan multiple foto -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
                <?php foreach($kenangan->fotos as $f): ?>
                    <div style="border-radius: var(--radius-md); overflow: hidden; background: #1a1a1a;">
                        <img src="<?= base_url('assets/uploads/kenangan/' . $f['nama_file']) ?>"
                             alt="<?= htmlspecialchars($kenangan->judul) ?>"
                             style="width: 100%; height: 250px; object-fit: cover; display: block; transition: transform 0.3s;"
                             onmouseover="this.style.transform='scale(1.05)'"
                             onmouseout="this.style.transform='scale(1)'">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Fallback if no images -->
            <div class="sv-card-img-placeholder" style="aspect-ratio: 16/9; margin-bottom: 1.5rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909" />
                </svg>
                <span>No Image</span>
            </div>
        <?php endif; ?>

        <h2 style="font-size: 1.75rem; font-weight: 700; color: var(--text); margin-bottom: 0.5rem;">
            <?= htmlspecialchars($kenangan->judul) ?>
        </h2>
        
        <div style="display: flex; gap: 0.75rem; margin-bottom: 1rem; flex-wrap: wrap;">
            <span class="badge-role"><i class="bi bi-tag-fill me-1"></i><?= htmlspecialchars($kenangan->kategori) ?></span>
            <span class="badge-info" style="background: rgba(255,255,255,0.1); color: var(--text); border: 1px solid rgba(255,255,255,0.2);">
                <i class="bi bi-calendar3 me-1"></i><?= htmlspecialchars($kenangan->tanggal_momen) ?>
            </span>
            <span class="badge-info" style="background: rgba(255,255,255,0.1); color: var(--text); border: 1px solid rgba(255,255,255,0.2);">
                <i class="bi bi-images me-1"></i><?= count($kenangan->fotos) ?> Foto
            </span>
        </div>

        <?php if (!empty($kenangan->deskripsi)): ?>
            <div style="background: rgba(0,0,0,0.2); padding: 1rem; border-radius: var(--radius-md); border: 1px solid rgba(255,255,255,0.05); color: var(--text-secondary); line-height: 1.6;">
                <?= nl2br(htmlspecialchars($kenangan->deskripsi)) ?>
            </div>
        <?php endif; ?>

        <div style="margin-top: 1.5rem; display: flex; gap: 1rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1.5rem;">
            <a href="<?= site_url('kenangan/edit/' . $kenangan->id_kenangan) ?>" class="btn-sv-primary">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
            <a href="<?= site_url('kenangan/delete/' . $kenangan->id_kenangan) ?>" 
               class="btn-sv-danger"
               onclick="return confirm('Hapus kenangan beserta semua fotonya?');">
                <i class="bi bi-trash3"></i> Hapus
            </a>
        </div>
    </article>
</div>

<div style="padding-bottom:3rem;"></div>
