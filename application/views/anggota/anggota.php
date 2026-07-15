<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$avatar_tones = [
    'from-[#4285F4] to-[#7BAAF7]',
    'from-[#EA4335] to-[#F28B82]',
    'from-[#FBBC05] to-[#FDD663]',
    'from-[#34A853] to-[#81C995]',
];
?>

<section class="mb-8 grid gap-6 lg:grid-cols-[minmax(0,1.15fr)_minmax(280px,0.85fr)] lg:items-end">
    <div class="surface-card p-6 sm:p-8">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Team board</p>
        <h1 class="mt-2 font-display text-4xl font-bold tracking-tight text-slate-950">Anggota Kelompok 4IA28</h1>
        <p class="mt-4 max-w-2xl text-base leading-7 text-slate-600">
            Tim pengembang Galeri Kenangan untuk ujian praktikum Sistem Multimedia, dengan pembagian peran yang jelas dan tampilan kartu yang seragam.
        </p>
    </div>
    <div class="surface-card p-6">
        <div class="space-y-3 text-sm text-slate-600">
            <div class="soft-badge justify-between">
                <span class="inline-flex items-center gap-2"><span class="google-dot google-dot--blue"></span>Total anggota</span>
                <strong class="text-slate-950"><?= count($anggota) ?></strong>
            </div>
            <div class="soft-badge justify-between">
                <span class="inline-flex items-center gap-2"><span class="google-dot google-dot--green"></span>Kelas</span>
                <strong class="text-slate-950">4IA28</strong>
            </div>
        </div>
    </div>
</section>

<section class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
    <?php foreach ($anggota as $index => $a): ?>
        <?php
        $parts = explode(' ', trim($a['nama']));
        $initials = strtoupper(substr($parts[0], 0, 1));
        if (count($parts) > 1) {
            $initials .= strtoupper(substr(end($parts), 0, 1));
        }
        $tone = $avatar_tones[$index % count($avatar_tones)];
        ?>
        <article class="surface-card p-6 text-center">
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-[1.75rem] bg-gradient-to-br <?= $tone ?> font-display text-2xl font-bold text-white shadow-lg shadow-slate-200/80">
                <?= $initials ?>
            </div>
            <h2 class="mt-5 text-lg font-bold tracking-tight text-slate-950"><?= htmlspecialchars($a['nama']) ?></h2>
            <p class="mt-2 text-sm text-slate-500">NPM <?= htmlspecialchars($a['npm']) ?> · <?= htmlspecialchars($a['kelas']) ?></p>
            <div class="mt-4">
                <span class="soft-badge text-xs text-slate-600"><?= htmlspecialchars($a['role']) ?></span>
            </div>
        </article>
    <?php endforeach; ?>
</section>

<p class="pt-8 text-center text-sm text-slate-500">Universitas Gunadarma · Teknik Informatika · <?= date('Y') ?></p>
