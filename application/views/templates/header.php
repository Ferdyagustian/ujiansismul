<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Galeri Kenangan — Sistem manajemen inventaris foto kenangan">
    <title><?= isset($title) ? htmlspecialchars($title) . ' | Galeri Kenangan' : 'Galeri Kenangan' ?></title>

    <!-- Performance: preconnect Google Fonts sebelum render -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Google Fonts (bukan @import di CSS — itu render-blocking) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap">
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom Design System -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

<!-- ============================================================
     NAVBAR
     ============================================================ -->
<nav class="sv-navbar navbar navbar-expand-lg">
    <div class="sv-container">
        <a class="navbar-brand" href="<?= site_url('kenangan') ?>">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--accent)">
                <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                <path d="M2 17l10 5 10-5"/>
                <path d="M2 12l10 5 10-5"/>
            </svg>
            Galeri<span class="brand-accent">Kenangan</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav ms-auto gap-1 align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link <?= (uri_string() == '' || uri_string() == 'kenangan' || strpos(uri_string(), 'kenangan/') === 0) ? 'active' : '' ?>"
                       href="<?= site_url('kenangan') ?>">
                        <i class="bi bi-grid-3x3-gap me-1"></i>Galeri
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos(uri_string(), 'kenangan/create') === 0) ? 'active' : '' ?>"
                       href="<?= site_url('kenangan/create') ?>">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Kenangan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos(uri_string(), 'anggota') === 0) ? 'active' : '' ?>"
                       href="<?= site_url('anggota') ?>">
                        <i class="bi bi-people me-1"></i>Anggota
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main>
    <div class="sv-container">
