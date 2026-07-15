<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$category_tones = [
    'Keluarga' => 'border-[#34A853]/20 bg-[#34A853]/10 text-[#137333]',
    'Teman' => 'border-[#4285F4]/20 bg-[#4285F4]/10 text-[#174EA6]',
    'Liburan' => 'border-[#FBBC05]/25 bg-[#FBBC05]/12 text-[#B06000]',
    'Sekolah' => 'border-[#EA4335]/20 bg-[#EA4335]/10 text-[#A50E0E]',
    'Pekerjaan' => 'border-slate-300 bg-slate-100 text-slate-700',
    'Lainnya' => 'border-slate-300 bg-white text-slate-700',
];
$popup_create_url = site_url() . '?popup=create';
?>

<section class="grid gap-6 lg:grid-cols-[minmax(0,1.35fr)_minmax(280px,0.65fr)] lg:items-end">
    <div class="surface-card p-6 sm:p-8">
        <span class="inline-flex items-center gap-2 rounded-full border border-[#4285F4]/15 bg-[#4285F4]/8 px-3 py-1 text-xs font-bold uppercase tracking-[0.22em] text-[#174EA6]">
            <span class="google-dot google-dot--blue"></span>
            Memory Board
        </span>
        <h1 class="mt-5 max-w-3xl font-display text-4xl font-bold tracking-tight text-slate-950 sm:text-5xl">
            Galeri Kenangan yang tampil seperti kanvas kerja modern.
        </h1>
        <p class="mt-4 max-w-2xl text-base leading-7 text-slate-600 sm:text-lg">
            Simpan foto, cerita, dan momen penting dalam satu papan visual yang rapi, ringan, dan lebih hidup.
        </p>
        <div class="mt-8 flex flex-wrap gap-3">
            <a href="<?= $popup_create_url ?>" class="btn-google-primary">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
                </svg>
                Tambah Kenangan
            </a>
            <a href="<?= site_url('anggota') ?>" class="btn-google-secondary">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2m18 0v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75M12 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"/>
                </svg>
                Lihat Tim
            </a>
        </div>
    </div>

    <div class="surface-card p-6">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Ringkasan</p>
        <div class="mt-5 space-y-3 text-sm text-slate-600">
            <div class="soft-badge justify-between">
                <span class="inline-flex items-center gap-2">
                    <span class="google-dot google-dot--blue"></span>
                    Total kenangan
                </span>
                <strong class="font-display text-base text-slate-950"><?= count($kenangan) ?></strong>
            </div>
            <div class="soft-badge justify-between">
                <span class="inline-flex items-center gap-2">
                    <span class="google-dot google-dot--yellow"></span>
                    Status galeri
                </span>
                <strong class="text-slate-800"><?= empty($kenangan) ? 'Masih kosong' : 'Aktif' ?></strong>
            </div>
            <div class="soft-badge justify-between">
                <span class="inline-flex items-center gap-2">
                    <span class="google-dot google-dot--green"></span>
                    Fokus halaman
                </span>
                <strong class="text-slate-800">Kanvas grid</strong>
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

<?php if ($this->session->flashdata('error')): ?>
    <div class="status-alert status-alert--error mt-6" role="alert">
        <span class="google-dot google-dot--red"></span>
        <?= htmlspecialchars($this->session->flashdata('error')) ?>
    </div>
<?php endif; ?>

<?php if (empty($kenangan)): ?>
    <section class="surface-card empty-dash mt-8 px-6 py-12 text-center sm:px-10">
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-3xl border border-slate-900/10 bg-white shadow-sm">
            <svg class="h-8 w-8 text-[#4285F4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 20.25h18M4.5 16.5l4.68-4.68a2.25 2.25 0 0 1 3.18 0l4.14 4.14m-1.5-1.5 1.68-1.68a2.25 2.25 0 0 1 3.18 0L21 14.25M21 6V4.5A1.5 1.5 0 0 0 19.5 3h-15A1.5 1.5 0 0 0 3 4.5V18"/>
            </svg>
        </div>
        <h2 class="mt-6 font-display text-3xl font-bold tracking-tight text-slate-950">Belum ada data kenangan</h2>
        <p class="mx-auto mt-3 max-w-xl text-base leading-7 text-slate-600">
            Mulai isi papan ini dengan foto pertama Anda. Setelah ada data, kartu kenangan akan tampil di atas canvas grid ini.
        </p>
        <div class="mt-8 flex justify-center">
            <a href="<?= $popup_create_url ?>" class="btn-google-primary">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
                </svg>
                Tambah Kenangan Pertama
            </a>
        </div>
    </section>
<?php else: ?>
    <section class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        <?php foreach ($kenangan as $k): ?>
            <?php $badge_class = $category_tones[$k['kategori']] ?? 'border-slate-300 bg-white text-slate-700'; ?>
            <article class="surface-card memory-card group p-0">
                <a href="<?= site_url('kenangan/detail/' . $k['id_kenangan']) ?>" class="memory-card__link block">
                <div class="memory-card__media relative aspect-[4/5] bg-slate-100">
                    <div class="memory-card__google-strip" aria-hidden="true">
                        <span class="memory-card__google-strip-seg bg-[#4285F4]"></span>
                        <span class="memory-card__google-strip-seg bg-[#EA4335]"></span>
                        <span class="memory-card__google-strip-seg bg-[#FBBC05]"></span>
                        <span class="memory-card__google-strip-seg bg-[#34A853]"></span>
                    </div>
                    <?php if (!empty($k['foto']) && file_exists('./assets/uploads/kenangan/' . $k['foto'])): ?>
                        <img src="<?= base_url('assets/uploads/kenangan/' . $k['foto']) ?>" alt="<?= htmlspecialchars($k['judul']) ?>" class="memory-card__image h-full w-full object-cover" loading="lazy">
                    <?php else: ?>
                        <div class="memory-card__placeholder flex h-full w-full flex-col items-center justify-center gap-3 bg-[radial-gradient(circle_at_top_left,_rgba(66,133,244,0.12),_transparent_55%),linear-gradient(135deg,_rgba(255,255,255,0.96),_rgba(241,245,249,0.93))] text-slate-400">
                            <svg class="h-10 w-10 text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 20.25h18M4.5 16.5l4.68-4.68a2.25 2.25 0 0 1 3.18 0l4.14 4.14m-1.5-1.5 1.68-1.68a2.25 2.25 0 0 1 3.18 0L21 14.25M21 6V4.5A1.5 1.5 0 0 0 19.5 3h-15A1.5 1.5 0 0 0 3 4.5V18"/>
                            </svg>
                            <span class="text-sm font-medium">Belum ada cover foto</span>
                        </div>
                    <?php endif; ?>

                    <div class="absolute left-4 top-6 z-20">
                        <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold <?= $badge_class ?>">
                            <?= htmlspecialchars($k['kategori']) ?>
                        </span>
                    </div>

                    <div class="memory-card__overlay absolute inset-x-0 bottom-0 z-10 p-5">
                        <div class="memory-card__panel memory-card__panel--simple rounded-xl px-4 py-4 text-white">
                            <div class="flex items-end justify-between gap-3">
                                <div>
                                    <h2 class="text-2xl font-bold tracking-tight"><?= htmlspecialchars($k['judul']) ?></h2>
                                    <p class="mt-2 inline-flex items-center gap-2 text-sm text-white/80">
                                        <svg class="h-4 w-4 text-[#8AB4F8]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V8.25A2.25 2.25 0 0 1 5.25 6h13.5A2.25 2.25 0 0 1 21 8.25v10.5A2.25 2.25 0 0 1 18.75 21H5.25A2.25 2.25 0 0 1 3 18.75ZM3 10.5h18"/>
                                        </svg>
                                        <?= htmlspecialchars($k['tanggal_momen']) ?>
                                    </p>
                                </div>
                                <span class="google-dot google-dot--red mb-1"></span>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </article>
        <?php endforeach; ?>
    </section>
<?php endif; ?>
