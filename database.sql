-- =========================================
-- Database: SneakClean (Laundry Sepatu)
-- =========================================
CREATE DATABASE IF NOT EXISTS sneakclean
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE sneakclean;

-- -----------------------------------------
-- Tabel Pelanggan
-- -----------------------------------------
CREATE TABLE IF NOT EXISTS pelanggan (
  id_pelanggan INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nama_lengkap VARCHAR(100) NOT NULL,
  no_telepon   VARCHAR(20)  NOT NULL,
  alamat       TEXT         NOT NULL,
  created_at   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_pelanggan),
  UNIQUE KEY uq_pelanggan_telepon (no_telepon)
) ENGINE=InnoDB;

-- -----------------------------------------
-- Tabel Order Laundry
-- -----------------------------------------
CREATE TABLE IF NOT EXISTS order_laundry (
  no_resi           VARCHAR(25)  NOT NULL,
  id_pelanggan      INT UNSIGNED NOT NULL,
  merk_sepatu       VARCHAR(50)  NOT NULL,
  warna_sepatu      VARCHAR(30)  NOT NULL,
  paket_treatment   ENUM('Deep Clean','Fast Clean','Unyellowing') NOT NULL,
  tanggal_masuk     DATE         NOT NULL,
  estimasi_selesai  DATE         NOT NULL,
  total_biaya       DECIMAL(10,2) NOT NULL DEFAULT 0,
  status_pengerjaan ENUM('Antre','Dicuci','Pengeringan','Selesai') NOT NULL DEFAULT 'Antre',
  created_at        TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at        TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (no_resi),
  KEY idx_order_pelanggan (id_pelanggan),
  KEY idx_order_status (status_pengerjaan),
  CONSTRAINT fk_order_pelanggan
    FOREIGN KEY (id_pelanggan) REFERENCES pelanggan (id_pelanggan)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
  CONSTRAINT chk_estimasi CHECK (estimasi_selesai >= tanggal_masuk),
  CONSTRAINT chk_biaya CHECK (total_biaya >= 0)
) ENGINE=InnoDB;

-- -----------------------------------------
-- Data contoh
-- -----------------------------------------
INSERT INTO pelanggan (nama_lengkap, no_telepon, alamat) VALUES
('Budi Santoso', '081234567890', 'Jl. Merdeka No. 10, Bandung'),
('Siti Aminah',  '082345678901', 'Jl. Melati No. 5, Bandung'),
('Rizky Pratama','083456789012', 'Jl. Kenanga No. 21, Cimahi');

INSERT INTO order_laundry
(no_resi, id_pelanggan, merk_sepatu, warna_sepatu, paket_treatment, tanggal_masuk, estimasi_selesai, total_biaya, status_pengerjaan) VALUES
('SC-20261104-001', 1, 'Nike Air Force 1', 'Putih',        'Deep Clean',  '2026-11-04', '2026-11-07', 60000,  'Antre'),
('SC-20261104-002', 2, 'Adidas Samba',     'Hitam/Putih',  'Fast Clean',  '2026-11-04', '2026-11-05', 35000,  'Dicuci'),
('SC-20261103-001', 3, 'Converse Chuck 70','Krem',         'Unyellowing', '2026-11-03', '2026-11-08', 85000,  'Pengeringan');

-- -----------------------------------------
-- Contoh query yang akan dipakai di Model
-- -----------------------------------------
-- Cari berdasarkan nomor resi (dengan data pelanggan)
-- SELECT o.*, p.nama_lengkap, p.no_telepon, p.alamat
-- FROM order_laundry o
-- JOIN pelanggan p ON p.id_pelanggan = o.id_pelanggan
-- WHERE o.no_resi = 'SC-20261104-001';

-- Update status
-- UPDATE order_laundry SET status_pengerjaan = 'Selesai' WHERE no_resi = 'SC-20261104-001';
