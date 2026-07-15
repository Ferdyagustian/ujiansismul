-- ============================================================
-- MLBB SKIN VAULT — Database Script
-- Import file ini via phpMyAdmin atau command: mysql -u root -p < db.sql
-- ============================================================

CREATE DATABASE IF NOT EXISTS `mlbb_skin_vault`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `mlbb_skin_vault`;

-- ------------------------------------------------------------
-- Tabel: tb_heroes
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `tb_heroes`;

CREATE TABLE `tb_heroes` (
  `id_hero`       INT          NOT NULL AUTO_INCREMENT,
  `nama_hero`     VARCHAR(100) NOT NULL,
  `role`          VARCHAR(50)  NOT NULL,
  `nama_skin`     VARCHAR(100) NOT NULL,
  `tipe_skin`     VARCHAR(50)  NOT NULL,
  `deskripsi`     TEXT         DEFAULT NULL,
  `gambar_splash` VARCHAR(255) DEFAULT NULL COMMENT 'Hanya nama file, contoh: chou_iori.jpg',
  PRIMARY KEY (`id_hero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Sample Data (opsional — hapus jika tidak diperlukan)
-- ------------------------------------------------------------
INSERT INTO `tb_heroes` (`nama_hero`, `role`, `nama_skin`, `tipe_skin`, `gambar_splash`) VALUES
('Chou', 'Fighter', 'Iori Yagami', 'KOF', NULL),
('Lancelot', 'Assassin', 'Heartthroble', 'Special', NULL),
('Kagura', 'Mage', 'Onmyouji Lady', 'Collector', NULL);
