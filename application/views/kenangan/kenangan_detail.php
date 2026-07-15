<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $foto_count = !empty($kenangan->fotos) ? count($kenangan->fotos) : 0; ?>

<section class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Memory detail</p>
        <h1 class="mt-2 font-display text-4xl font-bold tracking-tight text-slate-950"><?= htmlspecialchars($kenangan->judul) ?></h1>
        <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">Lihat semua foto yang terhubung dengan momen ini beserta deskripsinya.</p>
    </div>
    <a href="<?= site_url('galeri') ?>" class="btn-google-secondary">
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
        </svg>
        Kembali ke galeri
    </a>
</section>

<section class="grid gap-6 xl:grid-cols-[minmax(0,1.15fr)_360px]">
    <article class="surface-card overflow-hidden p-6 sm:p-8">
        <?php if (!empty($kenangan->fotos)): ?>
            <div class="grid gap-4 sm:grid-cols-2">
                <?php foreach ($kenangan->fotos as $f): ?>
                    <div class="overflow-hidden rounded-[1.75rem] border border-slate-900/10 bg-slate-100">
                        <img src="<?= base_url('assets/uploads/kenangan/' . $f['nama_file']) ?>" alt="<?= htmlspecialchars($kenangan->judul) ?>" class="h-72 w-full object-cover transition duration-300 hover:scale-[1.03]">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="flex aspect-[16/9] items-center justify-center rounded-[1.75rem] border border-dashed border-slate-300 bg-slate-50 text-slate-400">
                <div class="text-center">
                    <svg class="mx-auto h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 20.25h18M4.5 16.5l4.68-4.68a2.25 2.25 0 0 1 3.18 0l4.14 4.14m-1.5-1.5 1.68-1.68a2.25 2.25 0 0 1 3.18 0L21 14.25M21 6V4.5A1.5 1.5 0 0 0 19.5 3h-15A1.5 1.5 0 0 0 3 4.5V18"/>
                    </svg>
                    <p class="mt-3 text-sm font-medium">Belum ada foto pada kenangan ini.</p>
                </div>
            </div>
        <?php endif; ?>
    </article>

    <aside class="surface-card p-6 sm:p-8">
        <div class="flex flex-wrap gap-2">
            <span class="inline-flex items-center rounded-full border border-[#4285F4]/20 bg-[#4285F4]/10 px-3 py-1 text-xs font-semibold text-[#174EA6]">
                <?= htmlspecialchars($kenangan->kategori) ?>
            </span>
            <span class="soft-badge text-xs text-slate-500"><?= htmlspecialchars($kenangan->tanggal_momen) ?></span>
            <span class="soft-badge text-xs text-slate-500"><?= $foto_count ?> foto</span>
        </div>

        <h2 class="mt-6 font-display text-3xl font-bold tracking-tight text-slate-950"><?= htmlspecialchars($kenangan->judul) ?></h2>

        <div class="detail-desc-box mt-6 rounded-[1.5rem] border border-slate-900/8 bg-slate-50 px-5 py-4 text-sm leading-7 text-slate-600">
            <?php if (!empty($kenangan->deskripsi)): ?>
                <?= nl2br(htmlspecialchars($kenangan->deskripsi)) ?>
            <?php else: ?>
                Belum ada deskripsi tambahan untuk kenangan ini.
            <?php endif; ?>
        </div>

        <div class="mt-6 space-y-3 text-sm text-slate-600">
            <div class="soft-badge justify-between">
                <span class="inline-flex items-center gap-2">
                    <span class="google-dot google-dot--yellow"></span>
                    Tanggal momen
                </span>
                <strong class="text-slate-900"><?= htmlspecialchars($kenangan->tanggal_momen) ?></strong>
            </div>
            <div class="soft-badge justify-between">
                <span class="inline-flex items-center gap-2">
                    <span class="google-dot google-dot--green"></span>
                    Jumlah foto
                </span>
                <strong class="text-slate-900"><?= $foto_count ?></strong>
            </div>
        </div>

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="<?= site_url('kenangan/edit/' . $kenangan->id_kenangan) ?>" class="btn-google-primary">Edit Kenangan</a>
            <a href="<?= site_url('kenangan/delete/' . $kenangan->id_kenangan) ?>" class="btn-google-danger" onclick="return confirm('Hapus kenangan beserta semua fotonya?');">Hapus</a>
        </div>
    </aside>
</section>
