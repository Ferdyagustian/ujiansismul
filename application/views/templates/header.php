<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$uri = uri_string();
$is_home = ($uri === '' || $uri === 'kenangan');
$is_gallery = ($uri === 'galeri' || strpos($uri, 'kenangan/detail') === 0 || strpos($uri, 'kenangan/edit') === 0);
$is_anggota = (strpos($uri, 'anggota') === 0);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Galeri Kenangan untuk menyimpan foto dan momen berharga">
    <title><?= isset($title) ? htmlspecialchars($title) . ' | Galeri Kenangan' : 'Galeri Kenangan' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap">
    <script src="https://cdn.tailwindcss.com?plugins=forms,aspect-ratio"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    google: {
                        blue: '#4285F4',
                        red: '#EA4335',
                        yellow: '#FBBC05',
                        green: '#34A853',
                        ink: '#0F172A',
                        paper: '#F8FAFC'
                    }
                },
                fontFamily: {
                    sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
                    display: ['Space Grotesk', 'Plus Jakarta Sans', 'system-ui', 'sans-serif']
                },
                boxShadow: {
                    float: '0 24px 60px -28px rgba(15, 23, 42, 0.35)'
                }
            }
        }
    };
    </script>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body class="app-shell text-slate-900">
<div class="bg-canvas" aria-hidden="true"></div>
<div class="pointer-events-none fixed inset-x-0 top-[-5rem] z-0 flex justify-center gap-10 opacity-80 blur-3xl" aria-hidden="true">
    <div class="h-44 w-44 rounded-full bg-[rgba(66,133,244,0.18)]"></div>
    <div class="mt-14 h-36 w-36 rounded-full bg-[rgba(234,67,53,0.12)]"></div>
    <div class="h-40 w-40 rounded-full bg-[rgba(251,188,5,0.16)]"></div>
    <div class="mt-20 h-32 w-32 rounded-full bg-[rgba(52,168,83,0.14)]"></div>
</div>

<header class="sticky top-0 z-40 border-b border-slate-900/10 bg-white/78 backdrop-blur-xl">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 py-4 md:flex-row md:items-center md:justify-between">
            <a href="<?= site_url() ?>" class="text-slate-950">
                <span>
                    <span class="brand-word block font-display text-xl font-bold tracking-tight">
                        <span class="brand-blue">Galeri</span><span class="brand-red">Ken</span><span class="brand-yellow">ang</span><span class="brand-green">an</span>
                    </span>
                    <span class="block text-xs font-medium text-slate-500">Canvas memori digital</span>
                </span>
            </a>

            <nav class="flex flex-wrap items-center gap-2 text-sm font-semibold">
                <a href="<?= site_url() ?>" class="<?= $is_home ? 'nav-pill nav-pill-active' : 'nav-pill' ?>">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 10.5 12 3l8.25 7.5v9a1.5 1.5 0 0 1-1.5 1.5h-4.5v-6h-4.5v6h-4.5a1.5 1.5 0 0 1-1.5-1.5v-9Z"/>
                    </svg>
                    Beranda
                </a>
                <a href="<?= site_url('galeri') ?>" class="<?= $is_gallery ? 'nav-pill nav-pill-active' : 'nav-pill' ?>">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.75 5.75h5.5v5.5h-5.5zm9 0h5.5v5.5h-5.5zm-9 9h5.5v5.5h-5.5zm9 0h5.5v5.5h-5.5z"/>
                    </svg>
                    Galeri
                </a>
                <a href="<?= site_url('anggota') ?>" class="<?= $is_anggota ? 'nav-pill nav-pill-active' : 'nav-pill' ?>">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2m18 0v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75M12 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"/>
                    </svg>
                    Anggota
                </a>
            </nav>
        </div>
    </div>
</header>

<main class="relative z-10">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
