<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page Header -->
<div class="sv-page-header">
    <div>
        <h1 class="sv-page-title">Anggota <span>Kelompok</span></h1>
        <p class="sv-page-subtitle">Tim pengembang &mdash; Ujian Praktikum Sistem Multimedia, Kelas 4IA28</p>
    </div>
</div>

<!-- Anggota Grid -->
<div class="sv-anggota-grid">
    <?php foreach ($anggota as $index => $a): ?>
        <?php
            // Avatar initials dari nama depan dan belakang
            $parts    = explode(' ', trim($a['nama']));
            $initials = strtoupper(substr($parts[0], 0, 1));
            if (count($parts) > 1) {
                $initials .= strtoupper(substr(end($parts), 0, 1));
            }
        ?>
        <div class="sv-anggota-card">
            <div class="sv-anggota-avatar"><?= $initials ?></div>
            <h2 class="sv-anggota-name"><?= htmlspecialchars($a['nama']) ?></h2>
            <p class="sv-anggota-npm">NPM: <?= htmlspecialchars($a['npm']) ?> &nbsp;&middot;&nbsp; <?= htmlspecialchars($a['kelas']) ?></p>
            <span class="sv-anggota-role"><?= htmlspecialchars($a['role']) ?></span>
        </div>
    <?php endforeach; ?>
</div>

<!-- Info tambahan -->
<div style="text-align:center;padding:1.5rem 0 3rem;color:var(--text-muted);font-size:.875rem;">
    Universitas Gunadarma &nbsp;&middot;&nbsp; Teknik Informatika &nbsp;&middot;&nbsp; <?= date('Y') ?>
</div>
