<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    </div>
</main>

<footer class="relative z-10 border-t border-slate-900/10 bg-white/70 backdrop-blur">
    <div class="mx-auto flex max-w-7xl flex-col gap-3 px-4 py-6 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <p>&copy; <?= date('Y') ?> Galeri Kenangan. Tugas Ujian Sistem Multimedia.</p>
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-2 rounded-full border border-slate-900/10 bg-white px-3 py-1 text-slate-600">
                <span class="google-dot google-dot--blue"></span>
                Tim 4IA28
            </span>
            <a href="<?= site_url('anggota') ?>" class="font-semibold text-[#4285F4] transition hover:text-[#3367D6]">Lihat anggota</a>
        </div>
    </div>
</footer>

</body>
</html>
